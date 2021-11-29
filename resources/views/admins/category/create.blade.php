@extends('layouts.adminApp')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <div class="card text-white bg-dark mb-3" style="max-width: 34rem;">
        <div class="card-header">{{__('titles.add category')}}</div>
        <div class="card-body">
            <form method="POST" action="{{ url(lang_prefix().'/admins/category/store') }}" >
                @csrf
                {{--  autoload from app\helpers\general   --}}
                @if (show_language()->count() > 0)
                    
                    @foreach (show_language() as $i=> $lang)
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                {{__('titles.name')}}  ({{__('titles.'. $lang->abbr) }})
                            </label>
                            <input type="text" name="category[{{$i}}][name]" class="form-control" 
                                aria-describedby="emailHelp">
                            @error("category.$i.name")
                                <small style="color: red">
                                    {{$message}}
                                </small>
                            @enderror
        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                {{__('titles.description')}} ({{__('titles.' . $lang->abbr)}})
                            </label>
                            <textarea type="text" name="category[{{$i}}][description]" class="form-control" ></textarea>
                            @error("category.$i.description")
                                <small style="color: red">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <input type="text" name="category[{{$i}}][abbr]" style="display: none" value="{{$lang->abbr}}" class="form-control" >
                    @endforeach
                
                @endif
                

                <button type="submit" class="btn btn-primary">{{__('titles.add')}}</button>
            </form>

        </div>
    </div>
@endsection