@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Home'])
    <div class="container-fluid py-4">
        <div class="card" style="height: 750px">
            <div class="row align-items-center">
                <div class="col">
                    <div class="card-body text-center align-middle">
                        <h1>Welcome back, {{ Auth::user()->name }}</h1>
                        <p>Please select an action from the sidebar to continue</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
