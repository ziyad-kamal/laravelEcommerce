@extends('layouts.adminApp')
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    <a href="{{url('admins/category/create')}}" class="btn btn-info">{{__('titles.add category')}}</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> {{__('titles.number')}} </th>
                <th scope="col">{{__('titles.name')}}</th>
                <th scope="col">{{__('titles.description')}}</th>
                <th scope="col">{{__('titles.control')}}</th>
            </tr>
        </thead>
        @foreach ($category as $cate)
            <tbody>
                <tr>
                    <th scope="row">{{$cate->id}}</th>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->description}}</td>
                    <td>
                        <a href="{{url('admins/category/edit/' . $cate->id)}}" class="btn btn-primary">
                            {{__('titles.edit')}}
                        </a>

                        <a href="{{url('admins/category/delete/' . $cate->id)}}" class="btn btn-danger">
                            {{__('titles.delete')}}
                        </a>
                    </td>
                </tr>
                
            </tbody>
        @endforeach
        
    </table>
@endsection
