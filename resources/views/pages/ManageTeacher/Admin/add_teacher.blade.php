@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Register New Teacher'])

    <div class="container-fluid py-4">
        <div class="card p-4">

            <form action="{{ route('addteacher.create') }}" method="post">
                @csrf

                <div class="row">
                    <div>
                        <div class="row row-col-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                    @error('name')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Identity Card Number</label>
                                    <input type="text" class="form-control" name="ic" required>
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
                                    <input type="text" class="form-control" name="email" required>
                                    @error('email')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                    @error('password')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-check d-flex justify-content-end" style="margin-top: -15px;">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">&nbsp;
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Set Password As IC Number
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row row-col-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Age</label>
                                    <input type="text" class="form-control" name="age" required>
                                    @error('age')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="ic" class="form-label">Contact</label>
                                    <input type="text" class="form-control" name="contact" required>
                                    @error('contact')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Gender</label>
                                    <select id="user_gender" name="gender" class="form-select" aria-label="Default select example">
                                        <option selected value="null">Select</option>
                                        <option value="Men">Men</option>
                                        <option value="Women">Women</option>
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
                                <input type="text" class="form-control" name="address" required>
                                @error('address')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn text-white fw-bold btn-primary">
                                {{ __('Add') }}
                            </button>

                        @foreach (range(1, 5) as $index)
                            &nbsp;
                        @endforeach

                            <button type="reset" class="btn text-white fw-bold btn-danger">
                                {{ __('Reset') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="successreg" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Teacher Successfully Registered</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@if (Session::has('registration_success'))
    <script>
        $(document).ready(function() {
            $('#successreg').modal('show');
        });
    </script>
@endif

    <script>
        $(document).ready(function() {

            setTimeout(function(){
                $('#error').fadeOut('slow');
            }, 3000);

            $("#flexCheckChecked").change(function() {
                var passwordInput = $('input[name="password"]');
                var icInput = $('input[name="ic"]');

                if ($(this).is(":checked")) {
                    passwordInput.val(icInput.val());
                } else {
                    passwordInput.val("");
                }
            });
        });
    </script>

@endsection