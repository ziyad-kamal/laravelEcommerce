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
                        <img src="{{ asset('images/items/images-1.webp') }}" class="d-block w-100" alt="..." style="height: 500px">
                        <div class="carousel-caption ">
                            <h3>hp laptop</h3>
                            <h4>$1200</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/items/cheapgaminglaptops-2048px-8004-2x1-1.webp') }}" style="height: 500px" class="d-block w-100" alt="...">
                        <div class="carousel-caption ">
                            <h3>asus laptop</h3>
                            <h4>$1000</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/items/asus-vivobook-s14.webp') }}" class="d-block w-100" alt="..." style="height: 500px">
                        <div class="carousel-caption ">
                            <h3>asus-vivobook</h3>
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
                    <img src="{{ asset('images/items/iphone 14.jpg') }}" class="card-img-top" alt="loading">
                </a>

                <ul class="list-group text-center home">
                    <li class="list-group-item  ">
                        <h4>
                            <span class="name">iphone 14</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item ">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 90%"></div>
                            </div>
                        </div>
                        <span class="price">$500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/iphone 14-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item ">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone 15.png') }}" class="card-img-top" alt="loading">
                </a>

                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name">iphone 15</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item ">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 95%"></div>
                            </div>
                        </div>
                        <span class="price">$1000</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/iphone 15-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/iphone 16.png') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name">iphone 16</span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 85%"></div>
                            </div>
                        </div>
                        <span class="price">$1500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/iphone 16-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/apple lap.png') }}" class="card-img-top" alt="loading">
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
                        <span class="price">$3500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/macbook-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col  item ">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/hp 1.png') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name" title="macbook air">hp laptop 1 </span>
                            <span class="condition">new</span>
                        </h4>
                    </li>

                    <li class="list-group-item">
                        <div class="stars_wrapper">
                            <div class="stars_outer">
                                <div class="{{ 'stars_inner id' }}" style="width: 100%"></div>
                            </div>
                        </div>
                        <span class="price">$500</span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ asset('items/details/hp laptop 1-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col  item">
            <div class="card" style="width: 14rem;">
                <a href="{{ asset('') }}">
                    <img src="{{ asset('images/items/hp 3.png') }}" class="card-img-top" alt="loading">
                </a>
                <ul class="list-group text-center home">
                    <li class="list-group-item">
                        <h4>
                            <span class="name" title="macbook air">hp 3 </span>
                            <span class="condition">used</span>
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
                        <a href="{{ asset('items/details/hp 3-1') }}" class="btn btn-success">
                            Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
