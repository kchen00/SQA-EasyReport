@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<style>
    @media print {
        /* Define the size and orientation of the printout */
        @page {
            size: A4 portrait; /* A4 paper in vertical orientation */
            margin: 20mm; /* Set the margins */
        }

        /* Example print-specific styles */
        body {
            font-family: Arial, sans-serif;
            color: black;
            background: white;
        }

        h1 {
            font-size: 24pt;
        }

        p {
            font-size: 12pt;
        }

        /* Hide elements you don't want to print */
        .no-print {
            display: none;
        }
    }
</style>
    @include('layouts.navbars.auth.topnav', ['title' => 'Report'])
    <div class="container-fluid py-4">
        <div class="card p-4 ">
            <div class="row no-print">
                <h4>My class</h4>
            </div>
            <div class="row">
                <div class="col">
                    <h6>
                        {{$report["student"]->name}}
                    </h6>
                </div>
                <div class="col text-end no-print">
                    <button class="btn btn-info" onclick="window.print();">
                        Print report <i class="bi bi-printer"></i>
                    </button>
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
            <div class="row no-print">
                <div class="d-flex justify-content-center">
                    <a role="button" class="btn btn-info rounded-pill" href="{{ route("score.class.list") }}">Back to class</a>
                </div>
            </div>
        </div>
    </div>
@endsection
