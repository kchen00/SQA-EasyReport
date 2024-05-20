@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Manage Teacher'])

    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row align-items-center">
                <div class="row">
                    <h6>Viewing Teacher in the system</h6>
                </div>
                <div class="row">
                    <form action="{{ route('teacher.search') }}" method="post" class="row row-cols-auto g-2 align-items-center">
                        @csrf
                        <div class="col-10">
                            <div class="input-group">
                                <input type="text" name="search_name" class="form-control rounded-pill" placeholder="Search teacher">
                            </div>
                        </div>
                        <div class="col-2 mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill">Search</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Teacher</th>
                                <th scope="col">Identity Card Number</th>
                                <th scope="col">Gender</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->ic }}</td>
                                    <td>{{ $teacher->gender }}</td>
                                    <td>
                                        <a href="{{ route('viewteacher', ['id' => $teacher->id]) }}" class="btn btn-success rounded-pill">View</a>
                                    @foreach (range(1, 3) as $item)
                                        &nbsp;
                                    @endforeach
                                        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#confirmDelete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th scope="col" colspan="3">
                                    {{ $teachers->onEachSide(5)->links() }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('addteacher') }}" class="btn btn-success rounded-pill">
                            Add New Teacher
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="confirmNotDelete" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete Teacher {{ $teacher->name }}?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('allteacher.delete', ['id' => $teacher->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn btn-danger" id="successDel">Delete</button>
                    </form>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="confirmNotDelete2">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successDelete" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Teacher deleted successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@if (Session::has('delete_success'))
    <script>
        $(document).ready(function() {
            $('#successDelete').modal('show');
        });
    </script>
@endif

    <script>
        $(document).ready(function() {
            console.log('jquery is on fire');
        
            $('button[data-target="#confirmDelete"]').on('click', function() {
                $('#confirmDelete').modal('show');
            });
        
            $('#confirmNotDelete, #confirmNotDelete2, #okaydeleted').on('click', function() {
                $('#confirmDelete').modal('hide');
            });
        });
    </script>

@endsection