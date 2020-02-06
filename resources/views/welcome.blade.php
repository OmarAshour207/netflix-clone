@extends('layouts.app')

@section('content')
    <section id="banner">

        @include('layouts._nav')

        <div class="movies owl-carousel owl-theme">
            @foreach($latestMovies as $movie)
                <!-- Movie 1 -->
                <div class="movie text-white d-flex justify-content-center align-items-center">
                    <div class="movie__bg" style="background: linear-gradient(rgba(0,0,0, 0.6), rgba(0,0,0, 0.6)), url({{ $movie->image_path }}) center/cover no-repeat"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="d-flex justify-content-between">
                                    <h1 class="movive__name fw-300"> {{ $movie->name }} </h1>
                                    <span class="movie__year align-self-center"> {{ $movie->year }} </span>
                                </div>

                                <div class="d-flex movie__rating my-1">
                                    <div class="d-flex">
                                        @for($i = 0;$i < $movie->rating;$i++)
                                            <i class="fa fa-star text-primary mr-2"></i>
                                        @endfor
                                    </div>
                                    <span class="align-self-center"> {{ $movie->rating }} </span>

                                </div>

                                <p class="movie__description my-2">
                                    {{ $movie->description }}
                                </p>

                                <div class="movie__cta my-4">
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary text-capitalize mr-0 mr-md-2" title=""><i class="fa fa-play"></i> Watch Now</a>
                                    @auth()
                                        <a href="" class="btn btn-outline-light text-capitalize" id="movie__fav-btn" title="">
                                            <span class="far fa-heart movie__fav-icon {{ $movie->is_favoured ? 'fw-900' : '' }} movie-{{ $movie->id }}"
                                                  data-movie-id = "{{ $movie->id }}"
                                                  data-url = "{{ route('movies.toggle_favourite', $movie->id) }}"
                                            ></span>
                                            Add To Favourite
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-light text-capitalize" title=""><i class="far fa-heart"></i> Add To Favourite</a>
                                    @endauth

                                </div>
                            </div>

                            <div class="col-6 mx-auto col-md-4 col-lg-3 ml-md-auto mr-md-0">
                                <img src="{{ $movie->poster_path }}" class="img-fluid" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    @foreach($categories as $category)
        <section class="listing py-2">
            <div class="container">
                <div class="row my-4">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="listing__title text-white fw-300"> {{ ucfirst($category->name) }} </h3>
                        <a href="{{ route('movies.index', ['category_name'    => $category->name]) }}" class="align-self-center text-capitalize text-primary"> See All </a>
                    </div>
                </div>

                <div class="movies owl-carousel owl-theme">
                    @foreach($category->movies as $movie)
                        <div class="movie p-0">

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
                                        <i class="far fa-heart {{ $movie->is_favoured ? 'fw-900' : '' }} fa-1x align-self-center movie__fav-icon movie-{{ $movie->id }}"
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
                </div>
            </div>
        </section>
    @endforeach


@endsection
