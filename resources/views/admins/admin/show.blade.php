@extends('layouts.adminApp')
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    <a href="{{url('admins/create')}}" class="btn btn-info">add admin</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> number </th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        @foreach ($admins as $i=>$admin)
            <tbody>
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        <a href="{{url('admins/edit/' . $admin->id)}}" class="btn btn-primary">
                            edit
                        </a>

                        <a href="{{url('admins/delete/' . $admin->id)}}" class="btn btn-danger">
                            delete
                        </a>
                    </td>
                </tr>
                
            </tbody>
        @endforeach
        
    </table>
@endsection
