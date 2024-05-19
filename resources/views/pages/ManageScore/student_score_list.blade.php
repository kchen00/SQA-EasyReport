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
                    <form action="{{ route("score.student.store", ["class_id"=>$school_class->id, "subject_id"=>$subject_id]) }}" method="POST">
                        @csrf
                        @foreach ($scores as $score)
                        <div class="row row-cols-2">
                            <div class="col text-center">
                                <p>{{ $score["student"]->name }}</p>
                            </div>
                            <div class="col text-center">
                                <input type="number" name="students[{{ $score['student']->id }}][id]" class="form-control text-center" value="{{ $score["student"]->id }}" hidden>
                                <input type="number" name="students[{{ $score['student']->id }}][score]" class="form-control text-center" id="student_{{$score["student"]->id }}_score" placeholder="80" value="{{ $score["score"] ?  $score["score"]->score : ''}}" onchange="change_form_input_color(this)">
                            </div>
                            @error('students.' . $score['student']->id . '.score')
                                <p class="text-danger text-xs pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col">
                                <a role="button" class="btn btn-info rounded-pill" onclick="history.back()">Back to class</a>
                            </div>
                            <div class="col text-end">
                                <input type="submit" id="save_button" class="btn btn-success rounded-pill disabled" value="Save">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a role="button" class="btn btn-danger rounded-pill" href="{{ route('score.student.delete', ['class_id'=>$school_class->id]) }}">Delete Scores</a>
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
            input_field.style.backgroundColor = "yellow"
            $("#save_button").removeClass("disabled")
            $("#save_button").val("Update")
        }
    </script>
@endsection
