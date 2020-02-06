<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_movies')->only('index');
        $this->middleware('permission:create_movies')->only(['create', 'store']);
        $this->middleware('permission:update_movies')->only(['edit', 'update']);
        $this->middleware('permission:delete_movies')->only('destroy');
    }

    public function index()
    {
        $categories = Category::all();
        $movies = Movie::whenSearch(\request()->search)
                ->whenCategory(\request()->category)
                ->with('categories')
                ->paginate(5);
        return view('dashboard.movies.index', compact('movies', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $movie = Movie::create([]);
        return view('dashboard.movies.create', compact('movie', 'categories'));
    }

    public function store(Request $request)
    {
        $movie = Movie::findOrFail($request->movie_id);
        $movie->update([
            'name'      => $request->name,
            'path'      => $request->file('movie')->store('movies')
        ]);

        // Encode the movie using job from the queue in the background
        $this->dispatch(new StreamMovie($movie));

        return $movie;
    }

    public function show(Movie $movie)
    {
        return $movie;
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('dashboard.movies.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, Movie $movie)
    {
        if ($request->type == 'publish') {
            $request->validate([
                'name'          => 'required|unique:movies,name,' . $movie->id,
                'description'   => 'required',
                'poster'        => 'required|image',
                'image'         => 'required|image',
                'year'          => 'required',
                'categories'    => 'required|array|min:1',
                'rating'        => 'required',
            ]);
        } else {
            $request->validate([
                'name'          => 'required|unique:movies,name,' . $movie->id,
                'description'   => 'required',
                'poster'        => 'sometimes|nullable|image',
                'image'         => 'sometimes|nullable|image',
                'year'          => 'required',
                'categories'    => 'required|array|min:1',
                'rating'        => 'required',
            ]);
        }

        $request_data = $request->except(['poster', 'image']);

        if($request->poster) {

            $this->remove_previous_image('poster', $movie);

            $poster = Image::make($request->poster)
                    ->resize(255, 378)
                    ->encode('jpg');

            Storage::disk('local')->put('public/images/'. $request->poster->hashName(), (string) $poster, 'public');

            $request_data['poster'] = $request->poster->hashName();
        }

        if ($request->image) {

            $this->remove_previous_image('image', $movie);

            $image = Image::make($request->image)
                ->encode('jpg', 50);
            Storage::disk('local')->put('public/images/'. $request->image->hashName(), (string) $image, 'public');
            $request_data['image'] = $request->image->hashName();

        }

        $movie->update($request_data);
        $movie->categories()->sync($request->categories);

        session()->flash('success', 'Movies updated successfully');
        return redirect()->route('dashboard.movies.index');
    }

    public function destroy(Movie $movie)
    {
        Storage::disk('local')->delete('public/images/' . $movie->poster);
        Storage::disk('local')->delete('public/images/' . $movie->image);

        Storage::disk('local')->deleteDirectory('public/movies/' . $movie->id);
        Storage::disk('local')->delete($movie->path);
        $movie->delete();
        session()->flash('success', 'Movies deleted successfully');
        return redirect()->route('dashboard.movies.index');
    }

    private function remove_previous_image($imageType, $movie)
    {
        if($imageType == 'poster') {
            if($movie->poster != null) {
                Storage::disk('local')->delete('public/images/'. $movie->poster);
            }
        } else {
            if ($imageType == 'image') {
                if ($movie->image != null) {
                    Storage::disk('local')->delete('public/images/' . $movie->image);
                }
            }
        }
    }
}
