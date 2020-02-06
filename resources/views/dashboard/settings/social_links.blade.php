@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Settings </h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Social Links </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form action="{{ route('dashboard.settings.store') }}" method="post">
                    @csrf
                    @method('post')

                    @include('dashboard.partials._errors')

                    @php
                        $social_sites = ['facebook', 'google'];
                    @endphp

                    @foreach($social_sites as $social_site)

                        {{-- facebook client id --}}
                        <div class="form-group">
                            <label> {{ ucfirst( $social_site ) }} Link </label>
                            <input type="text" name="{{ $social_site }}_link" class="form-control" value="{{ setting($social_site .'_link') }}">
                        </div>

                        <hr>
                        <hr>

                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add
                        </button>
                    </div>

                </form>
            </div> <!-- end of tile -->
        </div>
    </div>
@endsection
