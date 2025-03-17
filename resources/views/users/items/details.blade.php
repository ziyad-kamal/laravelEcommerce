@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME', $item->name . ' - details - eCommerce') }}</title>
<meta name="keywords" content="here you can see all details about your item in eCommerce" >
<link href="{{ asset('css/users/items/details.css') }}" rel="stylesheet">
@endsection

@section('content')
    {{--#################       item details    ########################--}}
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            {{Session::get('success')}}
        </div>
    @endif
    
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{Session::get('error')}}</div>
    @endif

    @if (isset($msg))
    <div class="alert alert-success text-center">
            {{$msg}}
    </div>
    @endif

    @if (isset($error))
    <div class="alert alert-danger text-center">
            {{$error}}
    </div>
    @endif

    @error('comment')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror

    {{--#################       item details     ########################--}}
    <div class="card mb-3 card_item " >
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img" alt="..." />
            </div>
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item active">
                        item information
                    </li>
                    <li class="list-group-item">
                        <span class="name"> name </span>:
                        {{ $item->name }}
                    </li>
                    <li class="list-group-item">
                        <span class="name" style="margin-left:14px"> rate </span>:
                        {{ $item->rate == 0 ? 'no rate': $item->rate }} 
                    </li>
                    <li class="list-group-item">
                        <span class="description">

                            description
                        </span>
                        :{{ $item->description }}
                    </li>
                    <li class="list-group-item">
                        <span class="status-details"> status </span>:
                        {{ $item->condition }}
                    </li>
                    <li class="list-group-item">
                        <span class="price-details"> price </span>: $
                        {{ $item->price }}
                    </li>
                    <li class="list-group-item">
                        <span class="date-details"> date </span>:
                        {{ $item->date }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-success" id="buy" 
        style="height: 50px; width:200px; margin-top:20px;">

        <h2>Buy ${{ $item->price }}</h2> 
    </button>
    <div id="checkout" style="margin-top: 40px">

    </div>
    </div>
      

    <hr style="width: 75%"/>

        {{--#################       comment form   ########################--}}
    <div class="d-flex justify-content-center">
        <div class=" user">
            <div style="font-weight: bold">{{ Auth::user()->name }}</div>

            <img src={{ asset('images/users/' . Auth::user()->photo) }} class="rounded-circle" />
        </div>

        <div class=" comment">
            <form method="POST" action="{{ url('comments/post/'.$item->id) }}">
                @csrf
                <div class="form-group">
                    <label>Add comment</label>
                    <textarea type="text" rows='3' class="form-control submit_comment" 
                        aria-describedby="emailHelp" name="comment">
                    </textarea>
                        
                </div>

                <button type="submit" class="btn btn-primary">
                    comment
                </button>
            </form>
        </div>
    </div>

    <hr style="width: 75%" class="hr"/>

    {{--#################       comments     ########################--}}
    <div id="more">
        @include('users.items.comments')
    </div>
    
    <div id="load" style="margin-top: 30px" class="d-flex justify-content-center"  style="display: none">
        <img src="{{asset('images/items/200.gif')}}" />
        
    </div>

@endsection
@section('script')
{{-- load more comments (infinite scroll) --}}
    <script>
        function loadMore(page){
            $.ajax({
                type: "get",
                url : '?page='+page,   
                data: {
                    'ajax':1
                },
                beforeSend:function(){
                    $('#load').show()
                }
                
            }).done(function(response){
                let comments = response.html
                if(comments == ''){
                    $('#load').text('no more comments')
                    return
                }

                $('#more').append(comments)
                $('#load').hide()
            }) 
        }

        let page=1;
        $(window).scroll(function () { 
            if($(window).scrollTop()+$(window).height() >= $(document).height()){
                page++
                loadMore(page)
            }
        });
        
        //ajax checkout 
        let buy=$('#buy')
        buy.on('click',function(e){
            e.preventDefault();
            $.ajax({
            type    : "get",
            url     : "{{url('items/get/checkout')}}",
            data    : {
                'price'  : "{{$item->price}}",
                'item_slug': "{{$item->slug}}"
            },
            success: function (response,status) {
                if(status == 'success'){
                    buy.hide()
                    $('#checkout').append(response.form)
                }
                
            }
        });
        })
    </script>
@endsection

