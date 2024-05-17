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
                                    <form>
                                        <fieldset disabled>
                                            <input type="number" id="score_input" class="form-control" placeholder="80"
                                                value="80" onchange="change_form_input_color(this)">
                                        </fieldset>
                                    </form>
                                </td>
                                <td style="display: none" id="check_box_col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    <div class="d-flex justify-content-end m-auto">
                                        <a role="button" class="btn btn-info rounded-pill" onclick="enable_checkbox()">Delete</a>
                                        <a role="button" id="save_button" class="btn btn-danger rounded-pill" onclick="clear_all_input()">Delete all</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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


    {{-- score delete all status modal --}}
    <div class="modal fade" id="score_delete_all_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p>All score is deleted</p>
                    <button type="button" class="btn bg-success rounded-pill px-6" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // clear all scores
        function clear_all_input() {
            var elements = document.querySelectorAll("#score_input");
            elements.forEach(function(element) {
                element.value = ""
                element.classList.remove("bg-danger")
            });
            $("#score_delete_all_status").modal("show")
        }

        // enable check box col
        function enable_checkbox() {
            var elements = document.querySelectorAll("#check_box_col");
            elements.forEach(function(element) {
                element.style.display = ""
            });
        }
    </script>
@endsection
