@extends('layouts.Adminapp')

@section('header')
    <title>{{ env('APP_NAME', 'create - item - eCommerce') }}</title>
    <meta name="keywords" content="here you can create your item in eCommerce" >
    <link href="{{ asset('css/users/items/create.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <form method="POST" action="{{ url('admins/items/update/'.$items->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="1" name="photo_id"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" name="name" value="{{$items->name}}" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    @error('name')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">description</label>
                    <input type="text" name="description" value="{{$items->description}}" class="form-control" id="exampleInputPassword1">
                    @error('description')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">condition</label>
                    <select name="condition" class="form-control">
                        <option value="" > ... </option>
                        <option value="new" {{$items->condition == 'new' ? 'selected' :null}}> new </option>
                        <option value="used" {{$items->condition == 'used' ? 'selected' :null}}> used </option>
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
                            <option value="{{$category->id}}" {{$items->category_id == $category->id ? 'selected' :null}}> {{$category->name}} </option>
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
                            <option value="{{$brand->id}}" {{$items->brand_id == $brand->id ? 'selected' :null}}> {{$brand->name}} </option>
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
                    <input type="text" name="price" value="{{$items->price}}" class="form-control" id="exampleInputPassword1">
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
