@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Report'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <h4>My class</h4>
            </div>
            <div class="row">
                <div class="row">
                    <h6>
                        {{$report["student"]->name}}
                    </h6>
                </div>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Subject</td>
                            <td>Score</td>
                            <td>Full marks</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($report["scores"] as $score)
                        <tr>
                            <td>{{ $score["subject"]->name }}</td>
                            <td>{{ $score["score"]->score }}</td>
                            <td>{{ $score["score"]->full_marks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="d-flex justify-content-center">
                    <a role="button" class="btn btn-info rounded-pill" href="{{ route("score.class.list") }}">Back to class</a>
                </div>
            </div>
        </div>
    </div>
@endsection
