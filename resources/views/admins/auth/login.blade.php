@extends('layouts.login')
@section('content')
    <div class="card text-white bg-info mb-3" style="max-width: 26rem;">
        <div class="card-header">admin login</div>
        <div class="card-body">
            <form action="{{url('admins/login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small ></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    <small ></small>
                </div>
                
                <button type="submit" class="btn btn-success">login</button>
            </form>
        </div>
    </div>
@endsection
