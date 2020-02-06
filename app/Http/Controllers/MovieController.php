<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $movies = Movie::whenSearch(\request()->search)->get();
            return $movies;
        }

        $movies = Movie::whenFavourite(\request()->favourite)
            ->whenSearch(\request()->search)
            ->whenCategory(\request()->category_name)
            ->paginate(5);


        return view('movies.index', compact('movies'));
    } // end of index function

    public function show(Movie $movie)
    {
        $related_movies = Movie::where('id', '!=', $movie->id)
            ->whereHas('categories', function($query) use ($movie){
                return $query->whereIn('category_id', $movie->categories->pluck('id')->toArray());
            })
            ->limit(10)
            ->get();
        return view('movies.show', compact('movie', 'related_movies'));
    }// end of show

    public function incrementViews(Movie $movie)
    {
        $movie->increment('views');
    }// end of incrementViews

    public function toggleFavourite(Movie $movie)
    {
        if ($movie->is_favoured) {
            $movie->users()->detach(auth()->user()->id);
        } else {
            $movie->users()->attach(auth()->user()->id);
        }
    } // end of toggle

} // end of controller
