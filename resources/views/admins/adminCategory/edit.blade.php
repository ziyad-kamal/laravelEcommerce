@extends('layouts.adminApp')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    <div class="card text-white bg-dark mb-3" style="max-width: 34rem;">
        <div class="card-header">{{__('titles.edit category')}}({{ __('titles.' . $category->translation_lang) }})</div>
        <div class="card-body">
            <form method="POST" action="{{ url(lang_prefix().'/admins/category/update/' . $category->id) }}">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('titles.name')}} ({{ __('titles.' . $category->translation_lang) }})</label>
                    <input type="text" name="category[0][name]" value="{{ $category->name }}" class="form-control"
                        aria-describedby="emailHelp">
                    @error('category.0.name')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('titles.description')}}
                        ({{ __('titles.' . $category->translation_lang) }})</label>
                    <textarea type="text" name="category[0][description]"
                        class="form-control"> {{ $category->description }} </textarea>
                    @error('category.0.description')
                        <small style="color: red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <input type="text" name="category[0][translation_lang]" style="display: none"
                    value="{{ $category->translation_lang }}" class="form-control">

                <button type="submit" class="btn btn-primary">{{__('titles.edit')}}</button>
            </form>

        </div>
    </div>
    @if (isset($category->categories))
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($category->categories as $i => $lang)
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="profile-tab{{$i}}" data-toggle="tab" href="#profile{{$i}}" 
            role="tab" aria-controls="{{$i}}" aria-selected="false">
            edit category({{ __('titles.' . $lang->translation_lang) }})</a>
        </li>
        @endforeach
    </ul>
    @endif
    @if (isset($category->categories))
    <div class="tab-content" id="myTabContent">
        @foreach ($category->categories as $i => $lang)
            
                <div class="tab-pane fade " id="profile{{$i}}"
                role="tabpanel" aria-labelledby="{{$i}}">
                    <div class="card text-white bg-dark mb-3" style="max-width: 34rem;">
                        
                        <div class="card-body">
                            <form method="POST" action="{{ url(lang_prefix() . 'admins/category/update/' . $lang->id) }}">
                                @csrf
                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name ({{ __('titles.' . $lang->translation_lang) }})</label>
                                    <input type="text" name="category[0][name]" value="{{ $lang->name }}" class="form-control"
                                        aria-describedby="emailHelp">
                                    @error('category.0.name')
                                        <small style="color: red">
                                            {{ $message }}
                                        </small>
                                    @enderror
                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">description
                                        ({{ __('titles.' . $lang->translation_lang) }})</label>
                                    <textarea type="text" name="category[0][description]"
                                        class="form-control"> {{ $lang->description }} </textarea>
                                    @error('category.0.description')
                                        <small style="color: red">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <input type="text" name="category[0][translation_lang]" style="display: none"
                                    value="{{ $lang->translation_lang }}" class="form-control">
                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                
                        </div>
                    </div>
                </div>
            
        @endforeach
    </div>
    @endif



    @if (isset($lang_diff))
    <ul class="nav nav-tabs" style="margin-top: 30px" id="myTab" role="tablist">
        @foreach ($lang_diff as $i => $lang)
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="profile-tab{{$i}}" data-toggle="tab" href="#profile{{$i}}" 
            role="tab" aria-controls="{{$i}}" aria-selected="false">
            add new language({{ __('titles.' . $lang) }})</a>
        </li>
        @endforeach
    </ul>
    @endif
    @if (isset($lang_diff))
    <div class="tab-content" id="myTabContent">
        @foreach ($lang_diff as $i => $lang)
            
                <div class="tab-pane fade " id="profile{{$i}}"
                role="tabpanel" aria-labelledby="{{$i}}">
                    <div class="card text-white bg-dark mb-3" style="max-width: 34rem;">
                        
                        <div class="card-body">
                            {{--  lang_prefix autoload from app\helper\general --}}
                            <form method="POST" action="{{ url(lang_prefix() . '/admins/category/add/new_lang' ) }}">
                                @csrf
                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name ({{ __('titles.' . $lang) }})</label>
                                    <input type="text" name="category[0][name]"  class="form-control"
                                        aria-describedby="emailHelp">
                                    @error('category.0.name')
                                        <small style="color: red">
                                            {{ $message }}
                                        </small>
                                    @enderror
                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">description
                                        ({{ __('titles.' . $lang) }})</label>
                                    <textarea type="text" name="category[0][description]"
                                        class="form-control">  </textarea>
                                    @error('category.0.description')
                                        <small style="color: red">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <input type="hidden" name='category[0][category_id]' value="{{$category->id}}">
                                <input type="hidden" name="category[0][translation_lang]"
                                    value="{{ $lang}}" class="form-control">
                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                
                        </div>
                    </div>
                </div>
            
        @endforeach
    </div>
    @endif

@endsection
