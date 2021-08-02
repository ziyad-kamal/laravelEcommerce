@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME',  'categories - zikolaravelecommerce') }}</title>
<link rel="stylesheet" href="{{asset('css/users/category/index.css')}}">
<meta name="keywords" content="here you can see all categories in zikolaravelecommerce" >
@endsection

@section('content')
    <table class="table table-striped">
        <thead class="bg-info">
            <tr>
                <th scope="col">category number</th>
                <th scope="col">name</th>
                <th scope="col">photo</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>
                        <a href="{{url('category/show/items/'.$category->id)}}" style="font-weight: bold"> {{ $category->name }} </a>
                    </td>
                    <td><img src="{{asset('images/category/'.$category->photo)}}" alt=""></td>
                </tr>
            @endforeach




        </tbody>
    </table>
@endsection
