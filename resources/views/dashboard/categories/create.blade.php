@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Categories</h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Categories</li>
            </ol>
        </nav>
    </div>

    <div class="tile mb-4">
        <form action="{{ route('dashboard.categories.store') }}" method="post">
            @csrf
            @method('post')

            @include('dashboard.partials._errors')

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>

        </form>
    </div> <!-- end of tile -->
@endsection
