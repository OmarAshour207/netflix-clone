@extends('layouts.app')

@section('content')
    <section class="listing text-white" style="height: 100vh;padding: 8% 0;">
        @include('layouts._nav')
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="fw-300"> {{ request()->category_name ?? 'Favourite ' }}  Movies </h2>
                </div>
            </div>

            <div class="row {{ request()->favourite ? 'favourite' : '' }}">
                @if ($movies->count() > 0)
                    @foreach($movies as $movie)
                        <div class="movie p-0 my-3">

                            <img src="{{ $movie->poster_path }}" alt="" title="" class="img-fluid">

                            <div class="movie__details text-white">

                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 movie__name"> {{ $movie->name }} </p>
                                    <p class="mb-0 movie__year align-self-center"> {{ $movie->year }} </p>
                                </div>

                                <div class="d-flex movie__rating">
                                    <div class="mr-2">
                                        @for($i = 0;$i < $movie->rating;$i++)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                        @endfor
                                    </div>
                                    <span> {{ $movie->rating }} </span>
                                </div>

                                <div class="movie__views">
                                    <p> Views: {{ $movie->views }} </p>
                                </div>

                                <div class="d-flex movie__cta">
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary text-capitalize flex-fill mr-2"> <i class="fa fa-play"></i> Watch Now </a>
                                    @auth()
                                        <i class="far fa-heart fa-1x align-self-center movie__fav-icon movie-{{ $movie->id }} {{ $movie->is_favoured ? 'fw-900' : '' }}"
                                           data-url = "{{ route('movies.toggle_favourite', $movie->id) }}"
                                           data-movie-id = "{{ $movie->id }}"
                                        >
                                        </i>
                                    @else
                                        <a href="{{ route('login') }}" title="" class="text-white align-self-center"> <i class="far fa-heart fa-1x align-self-center movie__fav-icon"></i></a>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col">
                        <h5 class="fw-300">
                            Sorry there is no favourite movies
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
