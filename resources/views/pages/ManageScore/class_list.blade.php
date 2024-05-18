@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manage Score'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            @if($subject_classes)
            <div class="row">
                <h4>Student Class</h4>
            </div>
            <div class="row p-4">
                <div class="row">
                    <div class="row">
                        <h6>Student Class</h6>
                    </div>
                    <div class="row m-auto">
                        <table class="table table-hover table-striped text-center">
                            <tbody>
                                @foreach ($subject_classes as $class_)
                                <tr>
                                    <td>
                                        <a href="{{ route('score.student.list', ['class_id' => $class_->id]) }}">
                                            {{ $class_->name }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if($class_teacher_class)
                <div class="row">
                    <div class="row">
                        <h6>My Class</h6>
                    </div>
                    <div class="row m-auto">
                        <table class="table table-hover table-striped text-center">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('score.student.view_generate', ['class_id' => $class_teacher_class->id]) }}">
                                            {{ $class_teacher_class->name }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                {{-- <div class="row">
                    <div class="d-flex justify-content-center">
                        <a role="button" class="btn btn-info rounded-pill" id="view_button">View</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- <script>
        let prev_selected = null;

        function set_view_id(id, class_row) {
            if(prev_selected) {
                prev_selected.classList.remove("bg-success");
            }

            var routeUrl = "{{ route('score.student.list', ['class_id' => ':id']) }}";
            routeUrl = routeUrl.replace(':id', id);
            $("#view_button").attr("href", routeUrl);

            class_row.classList.add("bg-success");
            prev_selected = class_row
        }
    </script> --}}
@endsection
