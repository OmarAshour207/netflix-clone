@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Users </h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.movies.index') }}">movies</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Movie - <span style="font-weight: bold"> {{ $movie->name }} </span></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'update']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('dashboard.partials._errors')

                    <div class="form-group">
                        <label id="name"> Name </label>
                        <input type="text" name="name" id="movie__name" class="form-control" value="{{ $movie->name }}">
                    </div>

                    <div class="form-group">
                        <label id="description"> Description </label>
                        <input type="text" name="description" class="form-control"  value="{{ $movie->description }}">
                    </div>

                    <div class="form-group">
                        <label id="poster"> Poster </label>
                        <input type="file" name="poster" class="form-control">
                        <img src="{{ $movie->poster_path }}" alt="Movie Poster" style="width: 255px; height: 378px; margin-top: 10px">
                    </div>

                    <div class="form-group">
                        <label id="image"> Image </label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ $movie->image_path }}" alt="Movie Image" style="height: 300px; width: 300px; margin-top: 10px">
                    </div>

                    <div class="form-group">
                        <label id="year"> Year </label>
                        <input type="text" name="year" class="form-control"  value="{{ $movie->year }}">
                    </div>

                    <div class="form-group">
                        <label></label>
                        <select name="categories[]" class="form-control select2" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $movie->categories->pluck('id')->toArray()) ? 'selected' : '' }}> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="rating"> Rating </label>
                        <input type="number" min="1" name="rating" class="form-control" value="{{ $movie->rating }}">
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </div>

                </form>
            </div> <!-- end of tile -->
        </div>
    </div>
@endsection
