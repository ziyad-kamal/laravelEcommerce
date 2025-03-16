<aside id="sidebar">
    <ul class="list-unstyled sidebar_links">
        <a href="{{ url('/') }}">
            <div class="links home">
                <li style="margin-top: 14px;">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </li>
            </div>
        </a>

    @auth
        <a href="{{ url('profile/get') }}">
            <div class="links exams">
                <li>
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </li>
            </div>
        </a>
    @endauth

        <a href="{{url('items/get')}}">
            <div class="links profile">
                <li>
                    <i class="fas fa-briefcase"></i>
                    <span>Items</span>
                </li>
            </div>
        </a>

        <a href="{{url('category/get')}}">
            <div class="links posts">
                <li>
                    <i class="fab fa-buromobelexperte"></i>
                    <span>Categories</span>
                </li>
            </div>
        </a>

        @auth
            <a href="{{ url('orders/show') }}">
                <div class="links exams">
                    <li>
                        <i class="fas fa-shopping-bag"></i>
                        <span>Orders</span>
                    </li>
                </div>
            </a>
        @endauth
    </ul>

</aside>


@section('sidebar_script')
    <script>
        $(function(){
            //active links
            

            if(window.location.pathname == '/exams/get'){
                $('.exams').addClass('active');
            }

            if(window.location.pathname == '/subjects/get'){
                $('.subjects').addClass('active');
            }

            if(window.location.pathname == '/'){
                $('.home').addClass('active');
            }

            if(window.location.pathname == '/posts/get'){
                $('.posts').addClass('active');
            }

            if(window.location.pathname == '/profile/get'){
                $('.profile').addClass('active');
            }

           
        })
    </script>
@endsection