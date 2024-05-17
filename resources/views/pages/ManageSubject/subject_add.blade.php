@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Subject'])
    <div class="container-fluid py-4">
        <div class="card p-4">
            <div class="row">
                <div>
                    <form action="{{ route('subject.store') }}" method="POST">
                        <fieldset>
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Subject Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="subject name">
                                        @error('name')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="teacher" class="form-label">Teacher Assigned</label>
                                        <select class="form-control" id="teacher" name="teacher"
                                            placeholder="teacher name">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher')
                                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm">
                                    <input type="submit" value="Create Subject" class="btn btn-info rounded-pill">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('register_success'))
        <script>
            // Show modal when the page loads
            $(document).ready(function() {
                $('#register_status').modal('show');
                $('#register_status_text').text('{{ session('register_success') }}');
            });
        </script>
    @endif

    {{-- register status modal --}}
    <div class="modal fade" id="register_status" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <p id="register_status_text"></p>
                    <a type="button" class="btn bg-success rounded-pill px-6" href="{{ route("subject.list") }}">OK</a>
                </div>
            </div>
        </div>
    </div>
@endsection
