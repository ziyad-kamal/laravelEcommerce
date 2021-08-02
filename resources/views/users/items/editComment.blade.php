@extends('layouts.app')

@section('header')
    <title>{{ env('APP_NAME', 'edit - comment - zikolaravelecommerce') }}</title>
    <meta name="keywords" content="here you can edit your comment">
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @error('comment')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    <div class="row">
        <div class="col-md-3 user">
            <div>{{ Auth::user()->name }}</div>

            <img src={{ asset('images/users/' . Auth::user()->photo) }} class="rounded-circle" />
        </div>

        <div class="col-md-9 comment">
            <form method="POST" action="{{ url('comments/update/' . $comment->id) }}">
                @csrf
                <div class="form-group">
                    <label>edit comment</label>
                    <textarea type="text" rows='3' class="form-control submit_comment" 
                        name="comment">{{$comment->comment}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    comment
                </button>
            </form>
        </div>
    </div>
@endsection
