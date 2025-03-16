@extends('layouts.adminApp')
@section('content')
<a href="{{url('admins/language/create')}}" class="btn btn-info">add language</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> number </th>
                <th scope="col">name</th>
                <th scope="col">direction</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        @foreach ($language as $lang)
            <tbody>
                <tr>
                    <th scope="row">{{$lang->id}}</th>
                    <td>{{$lang->name}}</td>
                    <td>{{$lang->direction}}</td>
                    <td>
                        
                    </td>
                </tr>
                
            </tbody>
        @endforeach
        
    </table>
@endsection