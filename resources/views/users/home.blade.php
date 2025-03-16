@extends('layouts.app')

@section('header')
    <title>{{ env('APP_NAME', 'home - eCommerce') }}</title>
    <meta name="keywords" content="here you can see home page in eCommerce">
    <link href="{{ asset('css/users/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <a href="{{ url('/') }}">
                <div class="carousel-inner">
                    <div class="sale">25% Discount</div>
                    <div class="carousel-item active">
                        <img src="{{ asset('images/items/iphone111.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h3>iphone 11</h3>
                            <h4>$1200</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/items/iphone1111.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h3>iphone 10</h3>
                            <h4>$1000</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/items/apple11.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h3>mac book air</h3>
                            <h4>$1450</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <h2 class="text-center product_rec">Product Recommendation</h2>

    <div class="row">
        <div class="col item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone12.jpg') }}" class="card-img-top" alt="loading">
                </a>

                <ul class="list-group text-center home">
                    <li class="list-group-item  ">
                        <h4>
                            <span class="name">iphone 11</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item ">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 90%"></div>
                            </div>
                        </div>
                        <span class="price">$1500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item ">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone10.jpg') }}" class="card-img-top" alt="loading">
                </a>

                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name">iphone 10</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item ">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 95%"></div>
                            </div>
                        </div>
                        <span class="price">$1200</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone9.jpg') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name">iphone 9</span>
                            <span class="condition">used</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 85%"></div>
                            </div>
                        </div>
                        <span class="price">$500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone8.jpg') }}" class="card-img-top" alt="loading">
                </a>

                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name">iphone 8</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 80%"></div>
                            </div>
                        </div>
                        <span class="price">$700</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col  item ">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/apple11.jpg') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name" title="macbook air">mac book.. </span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 100%"></div>
                            </div>
                        </div>
                        <span class="price">$1000</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/macbook.jpg') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name" title="macbook air">macbook.. </span>
                            <span class="condition">used</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 100%"></div>
                            </div>
                        </div>
                        <span class="price">$400</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
