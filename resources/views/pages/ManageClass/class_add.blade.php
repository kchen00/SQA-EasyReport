@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Register New Class'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <form action="{{ route('school_class.store') }}" method="POST">
                        <fieldset>
                            @csrf
                            <div class="row row-col-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Class 1A">
                                        @error('name')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Class capacity</label>
                                        <input type="text" class="form-control" id="capcity" name="capacity"
                                            value="" placeholder="30">
                                        @error('capacity')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="birth" class="form-label">Class teacher</label>
                                    <select type="text" class="form-control" id="class_teacher" name="class_teacher">
                                        <option value="Assign one class teacher" disabled selected hidden>Assign one class teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_teacher')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <p class="form-label">Subjects Offered</p>
                                    @foreach ($subjects as $subject)
                                        <div class="form-check">
                                            <input type="checkbox" name="subject_offered[]" class="form-check-input"
                                                id="{{ $subject->name }}" value="{{ $subject->id }}">
                                            <label class="form-check-label"
                                                for="{{ $subject->name }}">{{ $subject->name }}</label>
                                        </div>
                                    @endforeach

                                    @error('subject_offered')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm">
                                    <input type="submit" value="Register" class="btn btn-success rounded-pill">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session('register_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#register_status').modal('show');
                $('#register_status_text').text('{{ Session("register_success") }}');
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
                    <p id="register_status_text"></p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
