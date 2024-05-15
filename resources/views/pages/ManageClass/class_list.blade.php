@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Student'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="row">
                    <h6>Viewing classes in the system</h6>
                </div>
                <div class="row">
                    <form class="row row-cols-auto g-2 align-items-center">
                        <div class="col-10">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-pill" placeholder="Search class">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary rounded-pill">Search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Class</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $class->name }}</td>
                                    <td>
                                        <a href="{{ route('school_class.view', ['class_id' => $class->id]) }}"role="button"
                                            class="btn btn-success rounded-pill">View</a>
                                        <a role="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#delete_confirm"
                                            onclick="confirm_delete('{{ $class->name }}', '{{ $class->id }}')">Delete</a>
                                        <form id="delete-form-{{ $class->id }}"
                                            action="{{ route('school_class.destroy', ['class_id' => $class->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th scope="col" colspan="3">
                                    {{ $classes->onEachSide(5)->links() }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col w-100">
                        <a href="{{ route('school_class.add') }}" role="button"
                            class="btn btn-success rounded-pill align-self-end">Add new class</a>
                    </div>
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
    </div>
@endsection
