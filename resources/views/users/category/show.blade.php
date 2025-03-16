@extends('layouts.app')

@section('header')
    <title>{{ env('APP_NAME',$category->name . ' - items - eCommerce') }}</title>
    <meta name="keywords" content="here you can all items related to this category" >
    <link rel="stylesheet" href="{{asset('css/users/category/show.css')}}">
@endsection

@section('content')
<h1 class="text-center">{{ $category->name }}</h1>
<div class="row">
    @foreach ($category_items as $item)
        
    <div class="col item"><div class="card" style="width: 14rem;">
        <a href="{{asset('')}}">
            <img src="{{asset('images/items/iphone12.jpg')}}" class="card-img-top" alt="loading">
        </a>
        
        <ul class="list-group text-center">
            <li class="list-group-item"> 
                <h4>
                    <span class="name">iphone 11</span>  
                    <span class="condition">new</span>
                </h4>
            </li>
    
            <li class="list-group-item">
                <div class="stars_wrapper">
                    <div class="stars_outer">
                        <div class="{{'stars_inner id'}}" style="width: 90%"></div>
                    </div>
                </div>
                <span class="price">$1500</span> 
            </li>
            <li class="list-group-item">
                <a href="{{asset('items/details/')}}" class="btn btn-success">
                    Details
                </a>
            </li>
        </ul>
    </div></div>
    <script>
        var items_id          ="{{$item->id}}",
            item_rate         ="{{$item->rate}}",
            item_rate_perc    =(item_rate/5)*100,
            item_rate_rounded =Math.round(item_rate_perc)+'%';
            

        document.querySelector('.id'+items_id).style.width=item_rate_rounded;
    </script>
        
    @endforeach
</div>
@endsection