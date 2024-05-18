@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Viewing Subject'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <form action="{{ route("subject.update.store", ["teacher_id"=>$record["teacher"]->id, "subject_id"=>$record["subject"]->id, "class_id"=>$record["assigned_class"]->id]) }}" method="POST" id="subject_form">
                        <fieldset>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Subject Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="subject name" value="{{ $record["subject"]->name }}" onchange="enable_form_submit()">
                                        @error('name')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="teacher" class="form-label">Teacher Assigned</label>
                                        <select class="form-control" id="teacher" name="teacher"
                                            placeholder="teacher name" onchange="enable_form_submit()">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ $teacher->id == $record["teacher"]->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="schoolclass" class="form-label">Assigned Class</label>
                                        <select class="form-control" id="schoolclass" name="schoolclass"
                                            placeholder="teacher name" onchange="enable_form_submit()">
                                            @foreach ($schoolclass as $class_)
                                                <option value="{{ $class_->id }}" {{ $class_->id == $record["assigned_class"]->id ? 'selected' : '' }}>{{ $class_->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('schoolclass')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row row-col-2">
                                <div class="col text-end">
                                    <a role="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#delete_confirm"
                                            onclick="confirm_delete('{{ $record['subject']->name }}', '{{ $record['subject']->id }}')">Delete Subject</a>
                                </div>
                                <div class="col text-start">
                                    <a id="form_submit" role ="button" class="btn btn-success rounded-pill disabled" onclick="$('#subject_form').submit()">Edit Subject</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" id="delete-form-{{ $record['subject']->id }}"
        action="{{ route('subject.destroy', ['subject_id' => $record['subject']->id]) }}"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @if (Session::has('edit_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#edit_status').modal('show');
            });
        </script>
    @endif

    {{-- update status modal --}}
    <div class="modal fade" id="edit_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Subject Edited successfully</p>
                    <a type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let original_subject_name = "{{ $record['subject']->name }}";
        let original_assigned_teacher_id = {{ $record["teacher"]->id }};
        let original_assigned_class_id = {{ $record["assigned_class"]->id }};

        function enable_form_submit() {
            let new_subject_name = $("#name").val();
            let new_assigned_teacher_id = parseInt($("#teacher").val());
            let new_assigned_class_id = parseInt($("#schoolclass").val());

            if(new_subject_name != original_subject_name || new_assigned_teacher_id != original_assigned_teacher_id || new_assigned_class_id != original_assigned_class_id){
                $("#form_submit").removeClass("disabled")
            } else {
                $("#form_submit").addClass("disabled")
            }
        }
    </script>

<script>
    function confirm_delete(subject_name, subject_id) {
        $("#confirm_text").text("Are you sure you want to delete " + subject_name + "? The action cannot be undone!");
        var delete_confirm_button = $("#delete_confirm");
        delete_confirm_button.attr("onclick", "delete_subject(" + subject_id + ")");
    }

    function delete_subject(subject_id) {
        let delete_form = $("#delete-form-" + subject_id);
        delete_form.submit();
    }
</script>

{{-- delete confirm modal --}}
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
                <button id="#delete_confirm" type="button" class="btn bg-danger rounded-pill px-6"
                    data-bs-dismiss="modal">Yes</button>
                <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

@endsection
