@extends('layouts.adminApp')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <form method="POST" action="{{ url('admins/language/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    @error('name')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">abbr</label>
                    <input type="text" name="abbr" class="form-control" id="exampleInputPassword1">
                    @error('abbr')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">direction</label>
                    <select name="direction" class="form-control">
                        <option value=""> ... </option>
                        <option value="rtl"> from right to left </option>
                        <option value="ltr"> from left to right </option>
                    </select>
                    @error('direction')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection