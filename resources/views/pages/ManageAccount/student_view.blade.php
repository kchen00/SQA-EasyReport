@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Student'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div class="row align-item-end">
                    <div class="col-sm">
                        <a role="button" class="btn btn-danger rounded-pill"
                            onclick="document.getElementById('delete-form-{{ $student->id }}').submit()">Delete</a>
                        <form id="delete-form-{{ $student->id }}"
                            action="{{ route('student.destroy', ['student_id' => $student->id]) }}" method="POST"
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
                                            value="{{ $student->name }}" placeholder="student name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" class="form-select">
                                            <option disabled hidden>Select a gender</option>
                                            <option value="male" {{ $student->gender === 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ $student->gender === 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="birth" class="form-label">Date of birth</label>
                                    <input type="date" id="birth" class="form-control"
                                        placeholder="Please select date" value="{{ $student->date_of_birth }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact information</label>
                                    <input type="text" class="form-control" id="contact"
                                        value="{{ $student->contact_information }}">
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
    @if (Session::has('delete_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#delete_status').modal('show');
            });
        </script>
    @endif
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
@endsection
