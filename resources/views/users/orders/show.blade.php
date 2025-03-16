@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME',  'orders - eCommerce') }}</title>
<meta name="keywords" content="here you can see your orders in eCommerce" >
<link rel="stylesheet" href="{{asset('css/users/orders.css')}}">
@endsection

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{Session::get('success')}}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{Session::get('error')}}</div>
    @endif

    <table class="table table-striped" style="margin-top: 110px">
        <thead>
            <tr>
               
                <th scope="col">name</th>
                <th scope="col">review</th>
                <th scope="col">price</th>
                <th scope="col">photo</th>
                <th scope="col">control</th>
                
            </tr>
        </thead>
        @foreach ($orders as $order)
        <tbody>
            <tr>
                
                <td>{{$order->items->name}}</td>
                <td>
                    @if ($order->rating == 0)
                        <form action="{{url('items/rate') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$order->items->id}}" name="item_id"/>
                            <input type="hidden" value="{{$order->id}}" name="order_id"/>
                            <div class="form-group">
                                <label for="exampleInputPassword1">rate this item</label>
                                <select name="rate" class="form-control">
                                    <option value = "1"> 1 (very bad) </option>
                                    <option value = "2"> 2 (bad)     </option>
                                    <option value = "3"> 3 (good)     </option>
                                    <option value = "4"> 4 (very good)</option>
                                    <option value = "5"> 5 (excellent)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </form>
                        
                        @else
                        <div> thank you for rating</div>
                    
                        
                    @endif
                    
                </td>
                <td>{{$order->items->price}}</td>
                <td>
                    <img src="{{asset('images/items/'.$order->items->photo)}}" />
                    
                
                </td>
                <td>
                    <a class="btn btn-danger" href="{{url('orders/cancel/'.$order->id)}}">
                        cancel
                    </a>
                </td>
            </tr>
            
        </tbody>
        @endforeach
        
    </table>
@endsection
