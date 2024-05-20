@extends('layouts.app')

@section('content')
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder text-center">Welcome back to EasyReport</h4>
                                </div>
                                <div class="card-body bg-black rounded m-4 mx-8">
                                    <p class="text-center text-dark">Log in</p>
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <label for="email" class="form-label text-start">Email</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" aria-label="Email">
                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <label for="password" class="form-label text-start">Password</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" aria-label="Password" value="secret" >
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary rounded-pill px-6">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
