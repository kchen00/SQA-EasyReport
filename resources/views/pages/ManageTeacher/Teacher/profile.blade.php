@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Teacher Profile'])

    <div class="container-fluid py-4">
        <div class="card p-4">

            <div class="row">
                <form action="{{ route('profile.update', ['id' => $teacher->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="row row-col-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $teacher->name }}">
                                    @error('name')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Identity Card Number</label>
                                    <input type="text" class="form-control" name="ic"
                                        value="{{ $teacher->ic }}">
                                    @error('ic')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-col-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $teacher->email }}">
                                    @error('email')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Contact</label>
                                    <input type="text" class="form-control" name="contact"
                                        value="{{ $teacher->contact }}">
                                    @error('contact')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-col-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Age</label>
                                    <input type="text" class="form-control" name="age"
                                        value="{{ $teacher->age }}">
                                    @error('age')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" name="gender" name="gender">
                                        <option value="Men" {{ $teacher->gender == 'Men' ? 'selected' : '' }}>Men</option>
                                        <option value="Women" {{ $teacher->gender == 'Women' ? 'selected' : '' }}>Women</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="contact" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ $teacher->address }}">
                                @error('address')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password">
                                </div>
                                @error('new_password')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </div>
                                @error('confirm_password')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn text-white fw-bold btn-primary">
                                {{ __('Update') }}
                            </button>

                        @foreach (range(1, 5) as $index)
                            &nbsp;
                        @endforeach

                            <button type="reset" class="btn text-white fw-bold btn-danger">
                                {{ __('Reset') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successupdate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <span>
                        <i class="bi bi-check-circle-fill text-success display-6"></i>
                    </span>

                    <p>Successfully Update Profile</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@if (Session::has('update_success'))
    <script>
        $(document).ready(function() {
            $('#successupdate').modal('show');
        });
    </script>
@endif

@endsection