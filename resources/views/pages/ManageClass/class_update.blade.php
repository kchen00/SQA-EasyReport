@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Update Class'])
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
                                    <select type="text" class="form-control" id="class_teacher" name="class_teacher">
                                        @foreach ($teachers as $teacher)
                                            <option value={{ $teacher->id }} {{ $teacher->id == $school_class->class_teacher ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_teacher')
                                        <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Subjects Offered</label>
                                    @foreach ($subjects as $subject)
                                        <div class="form-check">
                                            <input type="checkbox" name="subject_offered[]" class="form-check-input"
                                                id="{{ $subject->name }}" value="{{ $subject->id }}" {{ in_array($subject->id, $subjects_offered) ? "checked": ""}}>
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
