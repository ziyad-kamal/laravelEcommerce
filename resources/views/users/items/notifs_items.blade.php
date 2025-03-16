@if ($all_notifications)
    <div class="card-header">
        <h3 class="header" >Notifications</h3>
    </div>
    @foreach ($all_notifications as $notification)
        
        <div class="list-group">
            <a href="{{asset('items/details/'.$notification->items->slug)}}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <img src="{{asset('images/users/'.$notification->users->photo)}}" class="rounded-circle" alt="">
                    <h5 class="mb-1" >{{$notification->users->name}} commented on your item : {{$notification->comment}}</h5>
                    
                </div>
                <small class="text-muted"  >{{diff_date($notification->created_at)}}</small>
            </a>

        </div>
    @endforeach
@endif

