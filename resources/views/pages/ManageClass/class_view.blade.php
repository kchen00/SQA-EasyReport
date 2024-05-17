@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Class'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div class="row">
                    <h6>Viewing information for class {{ $school_class->name }}</h6>
                </div>
                <div class="row align-item-end">
                    <div class="col-sm">
                        <a role="button" href="{{ route('school_class.update', ['class_id' => $school_class->id]) }}"
                            class="btn btn-success rounded-pill">Update</a>
                    </div>
                    <div class="col-sm">
                        <a role="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#delete_confirm"
                            onclick="confirm_delete('{{ $school_class->name }}', '{{ $school_class->id }}')">Delete</a>
                        <form id="delete-form-{{ $school_class->id }}"
                            action="{{ route('school_class.destroy', ['class_id' => $school_class->id]) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
                <div>
                    <form>
                        <fieldset disabled>
                            <div class="row row-col-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            value="{{ $school_class->name }}" placeholder="student name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Class capacity</label>
                                        <input type="text" class="form-control" id="name"
                                            value="{{ $school_class->capacity }}" placeholder="class name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="birth" class="form-label">Class teacher</label>
                                    <input type="text" class="form-control" id="name"
                                        value="{{ $class_teacher->name }}" placeholder="class name">
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
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="row text-center">
                    <div class="col-sm">
                        <a role="button" class="btn btn-info rounded-pill" onclick="history.back()">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- delete status modal --}}
    <div class="modal fade" id="delete_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Student deleted successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    {{-- class delete confirm modal --}}
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p id="confirm_text"></p>
                    <button id="delete_confirm_button" type="button" class="btn bg-danger rounded-pill px-6"
                        data-bs-dismiss="modal">Yes</button>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirm_delete(class_name, class_id) {
            $("#confirm_text").text("Are you sure you want to delete " + class_name + "? The action cannot be undone!");
            var delete_confirm_button = $("#delete_confirm");
            delete_confirm_button.attr("onclick", "delete_class(" + class_id + ")");
        }

        function delete_class(class_id) {
            let delete_form = $("#delete-form-" + class_id);
            delete_form.submit();
        }
    </script>

    @if (Session::has('delete_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#delete_status').modal('show');
            });
        </script>
    @endif
    {{-- register status modal --}}
    <div class="modal fade" id="delete_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Class deleted successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    @endsection
