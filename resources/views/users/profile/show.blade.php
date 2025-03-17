@extends('layouts.app')

@section('header')
    <title>{{ env('APP_NAME', Auth::user()->name . ' - eCommerce') }}</title>
    <meta name="keywords" content="here you can see your profile details in eCommerce">
    <link href="{{ asset('css/users/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 100px">
        <button type="button" class="btn btn-info edit_photo" data-toggle="modal" data-target="#photoModal">
            edit photo
        </button>
        
        <button type="button" class="btn btn-info edit_profile" data-toggle="modal" data-target="#profileModal">
            edit profile
        </button>
    </div>


    {{-- edit modal photo --}}
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit photo</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" style="display: none" id="success_photo">

                    </div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
                        <div class="card-header">Edit</div>
                        <div class="card-body">
                            <form method="POST" id="photoForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">photo</label>
                                    <input type="file" name="photo" class="form-control photo"
                                        aria-describedby="emailHelp">

                                    <small style="color: red" id="photo_err">

                                    </small>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_photo" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- edit modal profile --}}
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit profile</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" id="success">

                    </div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">
                        <div class="card-header">Edit</div>
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control input" id="input_name" aria-describedby="emailHelp">

                                    <small style="color: red" id="name_err">

                                    </small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control input" id="input_email">

                                    <small style="color: red" id="email_err">

                                    </small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">password</label>
                                    <input type="password" name="password" class="form-control input" id="input_password">

                                    <small style="color: red" id="password_err">

                                    </small>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-secondary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal item --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">warning</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h5 style="color: red">Are you want to delete this item ?</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="submit" id="delete_item" itemId='' class="btn btn-danger"
                        data-dismiss="modal">delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal item --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">edit item</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-success text-center" id="update"></div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 24rem;">

                        <div class="card-body">
                            <form id="update_form">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">

                                    <small style="color: red" class="name_err">

                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">description</label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        id="exampleInputPassword1">

                                    <small style="color: red" class="description_err">

                                    </small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">condition</label>
                                    <select name="condition" id="condition" class="form-control">
                                        <option value=""> ... </option>
                                        <option value="new" id="new"> new </option>
                                        <option value="used" id="used"> used </option>
                                    </select>

                                    <small style="color: red" class="condition_err">

                                    </small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option value=""> ... </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" class="category{{ $category->id }}">
                                                {{ $category->name }} </option>
                                        @endforeach


                                    </select>

                                    <small style="color: red" class="category_id_err">

                                    </small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">price</label>
                                    <input type="text" name="price" id="price" class="form-control"
                                        id="exampleInputPassword1">

                                    <small style="color: red" class="price_err">

                                    </small>

                                </div>

                                <input type="text" name="id" id="id" style="display: none"
                                    class="form-control" id="exampleInputPassword1">
                                <input type="text" name="filename" id="filename" style="display: none"
                                    class="form-control" id="exampleInputPassword1">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control"
                                        id="exampleInputPassword1">


                                    <small style="color: red" class="photo-err">

                                    </small>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="submit" id="update_item" itemID='' class="btn btn-danger">save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- ajax vanilla js requests --}}
@section('script')
    <script>
        /*
            "use strict"
            //ajax update profile
            let success=document.getElementById('success');
            success.style.display='none';
            let save_btn=document.getElementById('save');
            save_btn.disabled=true;
            let input=document.getElementsByClassName('input')
            input[0].onkeyup=function(){
                if(input[0].value !== "{{ Auth::user()->name }}"){
                    save_btn.disabled=false;
                    save_btn.className='btn btn-primary';
                }else{
                    save_btn.disabled=true;
                    save_btn.className='btn btn-secondary';
                }
            }
            input[1].onkeyup=function(){
                if(input[1].value !== "{{ Auth::user()->email }}"){
                    save_btn.disabled=false;
                    save_btn.className='btn btn-primary';
                }else{
                    save_btn.disabled=true;
                    save_btn.className='btn btn-secondary';
                }
            }
            let confirm=document.getElementById('confirm_err')
                input[3].onkeyup=function(){
                    if(input[2].value == input[3].value){
                        save_btn.disabled=false;
                        save_btn.className='btn btn-primary';
                        
                        confirm.textContent=''
                    }else{
                        save_btn.disabled=true;
                        save_btn.className='btn btn-secondary';
                        
                        confirm.textContent="passwords don't match"
                    }
                }
            
            let save_submit=document.getElementById('save');
            save_submit.onclick=function(){
                //validation
                let name_err     = document.getElementById('name_err')
                let email_err    = document.getElementById('email_err')
                let password_err = document.getElementById('password_err')
                
                name_err.textContent     = '';
                email_err.textContent    = '';
                password_err.textContent = '';
                
                let input_name       = document.getElementById('input_name').value
                let input_email      = document.getElementById('input_email').value
                let input_password   = document.getElementById('input_password').value
                let confirm_password = document.getElementById('confirm_password').value
                
                if(input_name.length < 3 ){
                    name_err.textContent='you should enter at least 3 characters'
                }
                if(input_email.length < 3 ){
                    email_err.textContent='you should enter at least 3 characters'
                }else if(! input_email.includes('@') ){
                    email_err.textContent='invalid email'
                }
                if(input_password.length < 6 ){
                    password_err.textContent='you should enter at least 6 characters'
                }
                //ajax request
                let update_request = new XMLHttpRequest();
                update_request.onreadystatechange=function(){
                    if(this.readyState === 4 && this.status === 200){
                        
                        let res=JSON.parse(this.responseText);
                        success.style.display = '';
                        success.textContent   = res.success;
                        let name        = document.getElementsByClassName('user_name')[0];
                        let email       = document.getElementsByClassName('user_email')[0];
                        
                        name.textContent  = input_name;
                        email.textContent = input_email;
                    }
                }
                
                let data={
                    'name'            : input_name,
                    'email'           : input_email,
                    'password'        : input_password,
                    'confirm_password': confirm_password
                }
                update_request.open('post',"{{ route('update.profile') }}");
                update_request.setRequestHeader('content-type','application/json');
                update_request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                update_request.send( JSON.stringify(data));
            }
            //ajax update photo
            let save_photo=document.getElementById('save_photo')
            save_photo.onclick=function(){
                let photo_request=new XMLHttpRequest();
                photo_request.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        let response =JSON.parse( this.responseText)
                        let image=document.getElementsByClassName('image-profile')[0]
                        
                        image.src='/images/users/'+response.photo 
                    }
                }
                let photo_form=document.getElementById('photoForm')
                let formData=new FormData(photo_form)
                photo_request.open('post',"{{ url('profile/update/photo') }}");
                photo_request.send( formData);
            }
    */
        //ajax jquery requests 
        $(function() {


            // ajax update profile
            let success = $('#success')
            success.hide();
            let save_btn = $('#save')
            save_btn.hide();
            $('.input').on('change', function() {
                save_btn.show();
            })
            $('#save').on('click', function(e) {
                e.preventDefault();
                $("#name_err").text('');
                $("#email_err").text('');
                $("#password_err").text('');
                $.ajax({
                    method: 'post',
                    url: "{{ route('update.profile') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'name': $("input[name='name']").val(),
                        'email': $("input[name='email']").val(),
                        'password': $("input[name='password']").val(),
                        'photo_id': 0
                    },
                    success: function(data, status) {
                        if (status == 'success') {
                            success.show();
                            success.text(data.success)
                            $('.user_name').text($("#input_name").val())
                            $('#email').text($("input[name='email']").val())
                        }
                    },
                    error: function(res) {
                        success.hide();
                        let response = $.parseJSON(res.responseText);
                        $.each(response.errors, function(key, value) {
                            $("#" + key + "_err").text(value[0]);
                        })
                    },
                    cache: false
                })
            })

            // ajax update photo
            let save = $('#save_photo')
            save.hide();
            $('.photo').on('change', function() {
                save.show();
            })
            let successId = $('#success_photo');
            successId.hide();
            $('#save_photo').on('click', function(e) {
                e.preventDefault();
                $("#photo_err").text('');
                let formData = new FormData($('#photoForm')[0]);
                formData.append('id', 1)
                $.ajax({
                    method: "post",
                    url: "{{ url('profile/update/photo') }}",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data, status) {
                        if (status == 'success') {
                            successId.show();
                            successId.text(data.success);
                            $('.image-profile').attr('src',
                                '/images/users/' + data.photo)
                        }
                    },
                    error: function(res) {
                        successId.hide();
                        let response = $.parseJSON(res.responseText);
                        $.each(response.errors, function(key, value) {
                            $("#" + key + "_err").text(value[0]);
                        })
                    },
                });
            })
            // ajax delete item
            $('.delete').on('click', function() {
                let item_id = $(this).attr('item_id');
                $('#delete_item').attr('itemId', item_id);
            })

            let delete_msg = $('.deleteMsg');

            $('#delete_item').on('click', function(e) {
                e.preventDefault();

                let itemId = $(this).attr('itemId');
                $.ajax({
                    method: "delete",
                    url: "{{ url('items/delete') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': itemId
                    },

                    success: function(data, status) {
                        if (status == 'success') {
                            delete_msg.show();
                            delete_msg.text(data.success);

                            $(".item" + data.item_id).remove();

                        }
                    },
                    error: function(res) {
                        let error_id = $('#delete_error')
                        error_id.text(res.responseJSON.error);
                        error_id.show();
                    }
                });
            })
            // ajax edit item
            $('.edit').on('click', function() {
                let items_id = $(this).attr('items_id');
                $('edit_item').attr('itemID', items_id);
                $.ajax({
                    method: "get",
                    url: "{{ url('items/edit') }}",
                    data: {
                        'id': items_id
                    },
                    success: function(data, status) {
                        if (status == 'success') {
                            $('#edit_item').attr('itemID', data.item.id)
                            $('#name').attr('value', data.item.name);
                            $('#description').attr('value', data.item.description);
                            $('#category').attr('value', data.item.category_id);
                            $('#price').attr('value', data.item.price);
                            $('#id ').attr('value', data.item.id);
                            $('#filename ').attr('value', data.item.photo);

                            let condition = data.item.condition;
                            if (condition == 'new') {
                                $('#new').attr('selected', 'selected');
                            }
                            if (condition == 'used') {
                                $('#used').attr('selected', 'selected');
                            }
                            let category_id = data.item.category_id;
                            $('.category' + category_id).attr('selected', 'selected');
                        }
                    },

                });
            })

            //ajax update item
            let successMsgs = $('#update');
            successMsgs.hide();
            $('#update_item').on('click', function(e) {
                e.preventDefault();
                $(".photo_err").text('');
                $(".name_err").text('');
                $(".description_err").text('');
                $(".price_err").text('');
                $(".condition_err").text('');
                $(".category_id_err").text('');

                let formData = new FormData($('#update_form')[0]);
                formData.append('photo_id', 1);
                $.ajax({
                    method: "post",
                    url: "{{ url('items/update') }}",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data, status) {
                        if (status == 'success') {
                            successMsgs.show();
                            successMsgs.text('you updated item successfully');

                            $('.item_image').attr('src',
                                '/images/items/' + data.item.photo)

                            $('#item_status').text(data.item.condition)
                            $('#item_price').text(data.item.price)
                            $('#item_name').text(data.item.name)
                        }
                    },
                    error: function(res) {
                        successMsgs.hide();
                        let response = $.parseJSON(res.responseText);
                        $.each(response.errors, function(key, value) {
                            $("." + key + "_err").text(value[0]);
                        })
                    },
                });
            })
        })
    </script>
@endsection

{{-- profile details --}}

<div class="card mb-3 card_profile" style="margin-top: 100px">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset('/images/users/' . Auth::user()->photo) }}" class="card-img image-profile"
                alt="..." />
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item active">
                    <h4>information</h4>
                </li>
                <li class="list-group-item items_list">
                    <span class="name_profile">name</span>:
                    <span id="name" class="user_name">{{ Auth::user()->name }}</span>
                </li>

                <li class="list-group-item items_list ">
                    <span class="email">email</span>:
                    <span id="email" class="user_email">{{ Auth::user()->email }}</span>
                </li>

                <li class="list-group-item items_list">
                    <span class="created_at"> created at</span>:
                    {{ Auth::user()->created_at }}
                </li>
            </ul>
        </div>
    </div>
</div>




@endsection
