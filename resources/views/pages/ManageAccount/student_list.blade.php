@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Student'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="row">
                    <h6>Viewing students in the system</h6>
                </div>
                <div class="row">
                    <form class="row row-cols-auto g-2 align-items-center" action="{{ route('student.search') }}">
                        <div class="col-10">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-pill" placeholder="Search student" name="student_name">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary rounded-pill">Search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    @if(count($students) > 0)
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Student</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <a href="{{ route('student.view', ['student_id' => $student->id]) }}"role="button"
                                            class="btn btn-success rounded-pill">View</a>
                                        <a role="button" class="btn btn-danger rounded-pill"
                                            onclick="document.getElementById('delete-form-{{ $student->id }}').submit()">Delete</a>
                                        <form id="delete-form-{{ $student->id }}"
                                            action="{{ route('student.destroy', ['student_id' => $student->id]) }}" method="POST"
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
                                <th scope="col" colspan="3">
                                    {{ $students->onEachSide(5)->links() }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <div class="alert alert-danger text-center">
                        <h3 class="text-light">No results found</h3>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col w-100">
                        <a href="{{ route('student.add') }}" role="button"
                            class="btn btn-success rounded-pill align-self-end">Add new student</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- delete status modal --}}
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

    @if(session('delete_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#delete_status').modal("show");
                console.log("hellow")
            });
        </script>
    @endif
@endsection



