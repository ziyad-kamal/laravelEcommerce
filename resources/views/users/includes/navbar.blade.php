<nav class="navbar navbar-expand-lg navbar-light " style="z-index: 1001">
    <div class="container">
        <i class="fas fa-align-left"></i>
            <a class="navbar-brand" href="{{url('/')}}">eCommerce</a>
            
            <i class="fas fa-arrow-left"></i>
            
            <form class="form-inline my-2 my-lg-0 form-search"  id="search_submit" method="POST" action="{{url('items/get')}}">

                @csrf
                <input class="form-control mr-sm-2 search" name="search" 
                type="search" placeholder="Search for items" id="search">
                <div class="card   search_guest " style="display: none">
                    <ul class="list-group list-group-flush " >
                        
                    </ul>
                </div>

                <button class="btn btn-light my-2 my-sm-0 search-button" type="submit">
                    Search
                </button>
            </form>
            
        <div class="navbar_right">
            @auth
                <i class="fas fa-bell" id="bell">
                    <span id="notifs_count" class="rounded-circle" style="display: none"></span>
                </i>
            @else
                <a class="navbar_link login"  href="{{ route('login') }}">{{ __('Login') }}</a>
            
                <a class="navbar_link register" style="margin-left: 7px" href="{{ route('register') }}">{{ __('Register') }}</a>
                <i class="fas fa-search search_icon"></i>
            @endauth

            
        @auth
            <i class="fas fa-search search_icon_auth"></i>
            <ul class="list-unstyled">
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ ucfirst(substr(Auth::user()->name,0,1)) }}
                    </a>
    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endauth
        </div>
        
        <div class="card notif " style="width: 26rem;display:none " id="notif"  >
            
        </div>
    </div>
</nav>

@section('script_notify')
    <script>

         //responsive sidebar
        let content         = $('#more_items');
            
            
        if (window.location.pathname == '/items/get') {
            let filter = $('.filter');
            console.log(filter)
            $('body').on('click','.fa-align-left', function () {
                content.toggle();
                $('#load').toggle();
                console.log(1)
                filter.toggle();
                
            });
        }else{
            let sidebar_wrapper = $('.sidebar_wrapper');
            console.log(2)
            $(window).on('resize', function () {
                if($(window).width() >= 768){
                    content.show();
                }
                
                if($(window).width() <= 768){
                    sidebar_wrapper.hide();
                }
            });

            $('body').on('click','.fa-align-left', function () {
                content.toggle();
                console.log(2)
                sidebar_wrapper.toggle();
                
            });
        }
        
            
            //responsive navbar 
            let form_inline  = $('.form-inline'),
                navbar_brand = $('.navbar-brand'),
                fa_align     = $('.fa-align-left'),
                fa_search    = $('.fa-search'),
                arrow        = $('.fa-arrow-left'),
                navbar_link  = $('.navbar_link');

            $('body').on('click','.fa-search', function () {
                form_inline.removeClass('form-search');
                $('.fa-search').hide();
                navbar_brand.hide();
                arrow.show();
                fa_align.hide();
                navbar_link.hide();
            });

            arrow.on('click', function () {
                form_inline.addClass('form-search');
                fa_search.show();
                navbar_brand.show();
                $(this).hide();
                fa_align.show();
                navbar_link.show();
            });
    </script>
    @auth
        <script>
    
            //ajax vanilla js requests
            "use strict";
            
            //ajax get notifications
            function notify(){
                let agaxRequest=new XMLHttpRequest();
                
                agaxRequest.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        let res=JSON.parse(this.responseText);
                        let notifications_count= res.notifications_not_readed_count;
                        let notifs_count=document.getElementById('notifs_count');

                        if(notifications_count != 0){
                            notifs_count.style.display=''
                            notifs_count.textContent = notifications_count;
                        }

                        let show_notif=document.getElementById('notif');
                        let bell=document.getElementById('bell');

                        bell.onclick=function(){
                            show_notif.style.display='';
                            
                            let comments=res.view;
                            
                            show_notif.innerHTML=comments;
                        }
                                
                        document.onclick=function(){
                            if(window.event.srcElement.id != 'bell'){
                                show_notif.style.display = 'none';
                            }
                        }
                        
                    }

                    if(this.readyState == 4){
                        repeat_notifs();
                    }
                }
                
                agaxRequest.open('GET',"{{url('notifications/show')}}");
                agaxRequest.send();
            }


            //ajax update notifications
                function update_notifs(){
                    
                    let Request=new XMLHttpRequest();

                    Request.onreadystatechange=function(){
                        
                        if(this.readyState == 4 && this.status == 200){
                            let notifs_count=document.getElementById('notifs_count');
                            notifs_count.textContent='';
                            
                        }
                    }

                    Request.open('POST',"{{url('notifications/update')}}");
                    Request.setRequestHeader('content-type','application/x-www-form-urlencoded')
                    Request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                    Request.send();
                }

                let bell=document.getElementById('bell')
                let navbar=document.getElementsByClassName('navbar')[0]
                
                bell.addEventListener('click',function(){
                    let notifs_count_element = document.getElementById('notifs_count'),
                        notifs_count         = notifs_count_element.textContent

                    notifs_count_element.style.display='none';
                    
                    if(notifs_count > 0){
                        update_notifs()
                    }
                })

                window.onload=function(){
                    notify()
                        
                }

                function repeat_notifs(){
                    setTimeout(function(){notify()},3000)
                }
            



            //jquery ajax requests

            //ajax get notifications
            /*function notify(){
                
                $.ajax({
                    type   : "get",
                    url    : "{{url('notifications/show')}}",
                    success:function(data,status){
                        
                        if(status=='success'){
                            let unreaded_notifications_count= data.notifications_not_readed_count;
                            if(unreaded_notifications_count != 0){
                                $('#notification').text(unreaded_notifications_count);
                                
                            }
                            
                            let comments=data.all_notifications
                            
                            $('#bell').on('click',function(e){
                                $('.notif').show();
                                $('.no_notif').show();

                                e.stopPropagation();

                                let newHTML = [];
                                for (let i = 0; i < comments.length; i++) {
                                    
                                    newHTML.push(
                                        '<a class="item_link" href="items/details/'+comments[i].item_id+'">'+
                                            '<li class="list-group-item comments">'+
                                                '<img class="rounded-circle user_image" src="/images/users/'+comments[i].users.photo+'"/>'
                                                +'<span class="user_name">'+comments[i].users.name+'</span>'+' commented on your item:' 
                                                +'<span class="comm">'
                                                    +comments[i].comment 
                                                +'</span>'  + 
                                            '</li>'+
                                        '</a>'
                                    );
                                }
                                
                                $(".com").html(newHTML.join(""));
                                
                                let header=$('.header')
                                if( comments.length == 0 ){
                                    $('.notif').attr('class','card no_notif');
                                    header.text('no Notifications');
                                }else{
                                    $('.no_notif').attr('class','card notif');
                                    header.text('Notifications');
                                }
                            })

                            $(document).on('click',function(){
                                $('.notif').hide()
                                $('.no_notif').hide()
                            })
                        }
                    },
                    complete:function(){
                        update()
                    }
                });
            }
            function update(){
                setTimeout(function(){notify()},5000)
            }

            $(function(){
                notify()

                //ajax update notifications
                $('#bell').on('click',function(){
                    let notifications_count=$('.notifications_count').text()
                    
                    if(notifications_count > 0){
                            $.ajax({
                                type: "post",
                                url : "{{url('notifications/update')}}",
                                data: {
                                    "_token"     : "{{ csrf_token() }}",
                                    
                                },
                                success: function () {
                                    $('#notification').text('');
                                }
                            });
                    }
                })
                
            })
            */
        </script>
    @endauth


    <script>
        //ajax show search results 
        $(function(){
            $('#search').on('keyup',function(){
                let keyword=$(this).val()
                
                $.ajax({
                    type: "post",
                    url : "{{url('items/show/results')}}",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'search':keyword
                    },
                    success: function (data,status) {
                        
                        if(status=='success'){
                            var search_results=$('.search_guest');
                            
                            search_results.show()

                            let items_search=data.items
                            
                            if(items_search!=null){
                                let newHTML = [];
                                for (let i = 0; i < items_search.length; i++) {
                                    newHTML.push(
                                            '<li class="list-group-item products">'+
                                                items_search[i].name
                                            +'</li>'
                                    );
                                }
                                search_results.html(newHTML.join(""));

                                $('.products').on('click',function(){
                                    $('#search').val($(this).text())
                                    $('#search_submit').submit()
                                })

                                $(document).on('click',function(){
                                    search_results.hide()
                                })
                        }
                    }
                    }
                });
            })
        })
    </script>
@endsection




