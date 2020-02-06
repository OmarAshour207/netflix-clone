@extends('layouts.dashboard.app')

@push('styles')
    <style>
        #movie__upload-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            border: 1px solid black;
            cursor: pointer;
        }
    </style>

@endpush

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Movies </h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}"> Home </a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.movies.index') }}"> Movies </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Movies </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">

                <div id="movie__upload-wrapper"
                     onclick="document.getElementById('movie__file-input').click()"
                     style="display: {{ $errors->any() ? 'none' : 'flex' }};"
                >
                    <i class="fa fa-video-camera fa-2x"></i>
                    <p> Click to Upload </p>
                    <input
                        type="file"
                        name=""
                        id="movie__file-input"
                        data-url="{{ route('dashboard.movies.store') }}"
                        data-movie-id="{{ $movie->id }}"
                        style="display: none;">
                </div>

                <form
                    id="movie__properties"
                    action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type'   => 'publish']) }}"
                    method="post"
                    enctype="multipart/form-data"
                    style="display: {{ $errors->any() ? 'block' : 'none' }};">
                    @csrf
                    @method('put')

                    @include('dashboard.partials._errors')

                    <div class="form-group" style="display: {{ $errors->any() ? 'none' : 'block' }};">
                        <label id="movie_upload-text"> Uploading... </label>
                        <div class="progress">
                            <div class="progress-bar" id="movie__upload-progress" role="progressbar"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label id="name"> Name </label>
                        <input type="text" name="name" id="movie__name" class="form-control" value="{{ old('name', $movie->name) }}">
                    </div>

                    <div class="form-group">
                        <label id="description"> Description </label>
                        <input type="text" name="description" class="form-control"  value="{{ old('description', $movie->description) }}">
                    </div>

                    <div class="form-group">
                        <label id="poster"> Poster </label>
                        <input type="file" name="poster" class="form-control">
                    </div>

                    <div class="form-group">
                        <label id="image"> Image </label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label id="year"> Year </label>
                        <input type="text" name="year" class="form-control"  value="{{ old('year', $movie->year) }}">
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
                        <input type="number" min="1" name="rating" class="form-control" value=" {{ old('rating', $movie->rating) }} ">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="movie__submit-btn" style="display: {{ $errors->any() ? 'block' : 'none' }};">
                            <i class="fa fa-plus"></i> Publish
                        </button>
                    </div>

                </form>
            </div> <!-- end of tile -->
        </div>
    </div>
@endsection
