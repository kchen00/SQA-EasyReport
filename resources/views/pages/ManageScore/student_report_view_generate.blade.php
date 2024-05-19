@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Report'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <td colspan="2">
                            Student name
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>
                            {{ $student->name }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-end m-auto">
                                <a role="button" href="{{ route("score.report.student", ["student_id"=>$student->id, "generate"=>0]) }}" class="btn bg-white rounded-pill">View Report</a>
                                <a role="button" href="{{ route("score.report.student.overall", ["student_id"=>$student->id, "generate"=>1]) }}" class="btn bg-white rounded-pill">Generate Report</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="d-flex justify-content-center">
                    <a role="button" class="btn btn-info rounded-pill" href="{{ route('score.class.list') }}">Back to class</a>
                </div>
            </div>
        </div>
    </div>
@endsection
