@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manage Subject'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="row">
                    <form class="row row-cols-auto g-2 align-items-center">
                        <div class="col-10">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-pill" placeholder="Search subject...">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary rounded-pill">Find</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Teacher Assigned</th>
                                <th scope="col">Assigned Class</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subject_teacher as $data)
                                <tr>
                                    <td>{{ $data["subject"]->name }}</td>
                                    <td>
                                        {{ $data["teacher"]->name }}
                                    </td>
                                    <td>
                                        {{ $data["schoolclass"]->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('subject.view', ['subject_id' => $data["subject"]->id, 'teacher_id' => $data['teacher']->id, 'class_id' => $data["schoolclass"]->id]) }}" role="button"
                                            class="btn btn-success rounded-pill">View</a>
                                        <a role="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#delete_confirm"
                                            onclick="confirm_delete('{{ $data['subject']->name }}', '{{ $data['subject']->id }}')">Delete</a>
                                        <form method="POST" id="delete-form-{{ $data["subject"]->id }}"
                                            action="{{ route('subject.destroy', ['subject_id' => $data["subject"]->id]) }}"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th scope="col" colspan="4">
                                    {{ $items->onEachSide(5)->links() }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col w-100">
                        <a href="{{ route('subject.add') }}" role="button"
                            class="btn btn-success rounded-pill align-self-end">Add new subject</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('delete_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#delete_status').modal("show");
                $('#delete_status_text').text('{{ session('delete_success') }}');
            });
        </script>
    @endif

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
                    <button id="delete_confirm_button" type="button" class="btn bg-danger rounded-pill px-6"
                        data-bs-dismiss="modal">Yes</button>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">No</button>
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
                    <p id="delete_status_text"></p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
