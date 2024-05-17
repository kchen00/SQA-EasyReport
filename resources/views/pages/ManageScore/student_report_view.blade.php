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
                        {{ $student->name }}
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
                        <tr>
                            <td>English</td>
                            <td>40</td>
                            <td>60</td>
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
