@extends('layouts.adminApp')
@section('content')
    <div class="container" style="margin-top: 200px">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">admins</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $admins }}</h5>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $users }}</h5>

                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">items</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $items }}</h5>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">categories</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $categories }}</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
