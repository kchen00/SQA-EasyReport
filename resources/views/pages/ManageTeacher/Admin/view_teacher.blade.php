@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'View Teacher'])

    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <div class="row row-col-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->name }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="ic" class="form-label">Identity Card Number</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->ic }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row row-col-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->email }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="ic" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->contact }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row row-col-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="contact" class="form-label">Age</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->age }} years old" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="contact" class="form-label">Gender</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $teacher->gender }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="contact" class="form-label">Address</label>
                            <input type="text" class="form-control" id="name"
                                value="{{ $teacher->address }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection