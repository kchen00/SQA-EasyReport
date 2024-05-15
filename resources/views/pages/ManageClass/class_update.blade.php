@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Register New Class'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <form action="{{ route('school_class.update.store', ['class_id' => $school_class->id]) }}" method="POST">
                        <fieldset>
                            @csrf
                            <div class="row row-col-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $school_class->name }}" placeholder="Class 1A">
                                        @error('name')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Class capacity</label>
                                        <input type="text" class="form-control" id="capcity" name="capacity"
                                            value="{{ $school_class->capacity }}" placeholder="30">
                                        @error('capacity')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="birth" class="form-label">Class teacher</label>
                                    <input type="text" class="form-control" id="class_teacher" name="class_teacher"
                                        value="{{ $school_class->class_teacher }}" placeholder="John Doe">
                                    @error('class_teacher')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Subjects Offered</label>
                                    <input type="text" class="form-control" id="subject_offered" name="subject_offered"
                                        value="{{ $school_class->subject_offered }}" placeholder="Mathematics">
                                    @error('subject_offered')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm">
                                    <input type="submit" value="Update" class="btn btn-success rounded-pill">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('update_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#update_status').modal('show');
            });
        </script>
    @endif
    {{-- register status modal --}}
    <div class="modal fade" id="update_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Class updated successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection