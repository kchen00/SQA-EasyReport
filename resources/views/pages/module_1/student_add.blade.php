@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Register New Student'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <form action="{{ route('student.store') }}" method="POST">
                        <fieldset>
                            @csrf
                            <div class="row row-col-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="student name">
                                        @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" class="form-select" name="gender" value="selected">
                                            <option value="selected" disabled hidden>
                                                Select a gender
                                            </option>
                                            <option value="male">
                                                Male
                                            </option>
                                            <option value="female">
                                                Female
                                            </option>
                                        </select>
                                        @error('gender') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="birth" class="form-label">Date of birth</label>
                                    <input type="date" id="birth" class="form-control" name="birth" placeholder="Please select date">
                                    @error('birth') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact information</label>
                                    <input type="text" class="form-control" id="contact" name="contact">
                                    @error('contact') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm">
                                    <input type="submit" value="Register" class="btn btn-info rounded-pill">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('register_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#register_status').modal('show');
            });
        </script>
    @endif
    {{-- register status modal --}}
    <div class="modal fade" id="register_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Student registered successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

