@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Settings </h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Social Login </li>
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
                            <label> {{ ucfirst( $social_site ) }} Client ID </label>
                            <input type="text" name="{{ $social_site }}_client_id" class="form-control" value="{{ setting($social_site .'_client_id') }}">
                        </div>

                        {{-- facebook client secret --}}
                        <div class="form-group">
                            <label> {{ ucfirst( $social_site ) }} Client Secret </label>
                            <input type="text" name="{{ $social_site }}_client_secret" class="form-control" value="{{ setting($social_site .'_client_secret') }}">
                        </div>

                        {{-- facebook redirect url --}}
                        <div class="form-group">
                            <label> {{ ucfirst( $social_site ) }} Redirect URl </label>
                            <input type="text" name="{{ $social_site }}_redirect_url" class="form-control" value="{{ setting($social_site .'_redirect_url') }}">
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
