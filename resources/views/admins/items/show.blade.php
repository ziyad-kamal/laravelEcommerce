@extends('layouts.AdminApp')
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    <a href="{{url('admins/items/create')}}" class="btn btn-info">add Item</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> number </th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        @foreach ($items as $i=>$item)
            <tbody>
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <a href="{{url('admins/items/edit/' . $item->id)}}" class="btn btn-primary">
                            edit
                        </a>

                        <a href="{{url('admins/items/delete/' . $item->id)}}" class="btn btn-danger">
                            delete
                        </a>
                    </td>
                </tr>
                
            </tbody>
        @endforeach
        
    </table>
    {{$items->links()}}
@endsection
