@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manage Score'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <h4>Student Score ({{ $school_class->name }})</h4>
            </div>
            <div class="row p-4">
                <div class="row">
                    <h6>Student name</h6>
                </div>
                <div class="row m-auto">
                    <table class="table table-hover table-striped text-center">
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col m-auto d-flex justify-content-end">
                                            <form>
                                                <input type="number" id="score_input" class="form-control text-center" placeholder="80" onchange="change_form_input_color(this)">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row m-auto">
                        <div class="col">
                            <a role="button" class="btn btn-info rounded-pill" onclick="history.back()">Back to class</a>
                        </div>
                        <div class="col-5">
                            <a role="button" id="save_button" class="btn btn-success rounded-pill d-flex justify-content-center">Save</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('score_save_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#score_save_status').modal('show');
            });
        </script>
    @endif

    {{-- score save status modal --}}
    <div class="modal fade" id="score_save_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>Score saved successfully</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // change form input to yellow
        function change_form_input_color(input_field) {
            input_field.classList.add("bg-danger")
            $("#save_button").text("Update")
        }
    </script>
@endsection
