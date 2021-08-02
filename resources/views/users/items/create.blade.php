@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME', 'create - item - zikolaravelecommerce') }}</title>
<meta name="keywords" content="here you can create your item in zikolaravelecommerce" >
<link href="{{ asset('css/users/items/create.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <form method="POST" action="{{ route('items.insert') }}" enctype="multipart/form-data">
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
                    <label for="exampleInputPassword1">description</label>
                    <input type="text" name="description" class="form-control" id="exampleInputPassword1">
                    @error('description')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">condition</label>
                    <select name="condition" class="form-control">
                        <option value=""> ... </option>
                        <option value="new"> new </option>
                        <option value="used"> used </option>
                    </select>
                    @error('condition')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">category</label>
                    <select name="category_id" class="form-control">
                        <option value=""> ... </option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                        
                        
                    </select>
                    @error('category')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">brands</label>
                    <select name="brand_id" class="form-control">
                        <option value=""> ... </option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}"> {{$brand->name}} </option>
                        @endforeach
                        
                        
                    </select>
                    @error('brand')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputPassword1">
                    @error('price')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">photo</label>
                    <input type="file" name="photo" class="form-control" id="exampleInputPassword1">
                    @error('photo')
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
