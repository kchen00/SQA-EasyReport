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
                    <form class="form" method="POST" action="{{ route('score.student.delete.store', ["class_id"=>$school_class->id]) }}">
                        @csrf
                        @foreach ($scores as $score)
                        <div class="row">
                            <div class="col">
                                {{ $score["student"]->name }}
                            </div>
                            <div class="col text-center">
                                <input type="number" name="students[{{ $score['student']->id }}][id]" class="form-control text-center" value="{{ $score["student"]->id }}" hidden>
                                <input type="number" id="student_{{ $score['student']->id }}_score" name="students[{{ $score['student']->id }}][score]" class="form-control text-center" id="student_{{$score["student"]->id }}_score" placeholder="80" value="{{ $score["score"] ?  $score["score"]->score : ""}}" onchange="change_form_input_color(this)">
                            </div>
                            <div class="col-1" style="display: none" id="check_box_col">
                                <div class="form-check">
                                    <input class="form-check-input text-end" type="checkbox" value="" id="student_{{ $score['student']->id }}_selected" name="students[{{ $score['student']->id }}][selected]">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="d-flex justify-content-end m-auto">
                                <input type="button" value="Delete" class="btn btn-info rounded-pill" onclick="enable_checkbox(this)">
                                <input type="button" value="Delete all" class="btn btn-danger rounded-pill" onclick="clear_all_input(this)">
                            </div>
                        </div>
                    </form>
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
        function clear_all_input(delete_button) {
            var elements = document.querySelectorAll('[id^="student_"][id$="_score"]');
            elements.forEach(function(element) {
                element.value = ""
                element.classList.remove("bg-danger")
            });

            delete_button.type = "submit";
        }

        // enable check box col
        function enable_checkbox(delete_button) {
            var elements = document.querySelectorAll("#check_box_col");
            elements.forEach(function(element) {
                element.style.display = ""
            });

            delete_button.setAttribute('onclick', 'clear_selected(this)');
        }

        // clear input that is selected
        function clear_selected(delete_button) {
            let checkboxes = document.querySelectorAll(".form-check-input");

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    // Get the corresponding student ID from the checkbox ID
                    const studentId = checkbox.id.split('_')[1];
                    // Select the corresponding score input field
                    console.log('student_' + studentId + '_score');
                    const scoreInput = document.getElementById('student_' + studentId + '_score');


                    scoreInput.value = "";
                };
            });

            delete_button.type = "submit";
        };
    </script>
@endsection
