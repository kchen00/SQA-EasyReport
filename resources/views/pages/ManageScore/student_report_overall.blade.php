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
                        <tr class="text-center">
                            <td>Subject</td>
                            <td>Marks</td>
                            <td>Grade</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($report["scores"] as $score)
                        <tr class="text-center">
                            <td>{{ $score["subject"]->name }}</td>
                            <td>{{ $score["score"]->score }}</td>
                            <td>{{ $score["grade"] }}</td>
                        </tr>
                        @endforeach
                        <tr class="text-center">
                            <td colspan="2">Average grade</td>
                            <td>{{ $average_grade }}</td>
                        </tr>
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
