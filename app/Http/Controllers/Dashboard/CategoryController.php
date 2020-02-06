<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only('index');
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only('destroy');
    }

    public function index()
    {
        $categories = Category::whenSearch(request()->search)
                ->withCount('movies')
                ->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:categories,name'
        ]);

        Category::create($request->all());
        session()->flash('success', 'Data Added Successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required|unique:categories,name,'. $category->id,
        ]);
        $category->update($request->all());
        session()->flash('success', 'Data Updated successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.categories.index');
    }
}
