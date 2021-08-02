<div class="row">
@foreach ($items as $item)

    <div class="col-sm-12 col-md">
        <div class="card" style="width: 18rem;margin-bottom: 20px">
            <img src="{{asset('images/items/'.$item->photo)}}" class="card-img-top" alt="loading">
            <ul class="list-group text-center">
                <li class="list-group-item"> 
                    <h4>
                        <span class="name">{{$item->name}}</span>  
                        <span class="condition">{{$item->condition}}</span>
                    </h4>
                </li>
        
                <li class="list-group-item">
                    <div class="stars_wrapper">
                        <div class="stars_outer">
                            <div class="{{'stars_inner id'.$item->id}}"></div>
                        </div>
                    </div>
                    <span class="price">${{$item->price}}</span> 
                </li>
                <li class="list-group-item">
                    <a href="{{asset('items/details/'.$item->slug)}}" class="btn btn-success">
                        Details
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <script>
        var items_id          ="{{$item->id}}",
            item_rate         ="{{$item->rate}}",
            item_rate_perc    =(item_rate/5)*100,
            item_rate_rounded =Math.round(item_rate_perc)+'%';
            

        document.querySelector('.id'+items_id).style.width=item_rate_rounded;
    </script>
@endforeach
</div>


