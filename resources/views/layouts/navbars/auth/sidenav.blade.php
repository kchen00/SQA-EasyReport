<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="./img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">EasyReport</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'list_student' ? 'active' : '' }}"
                    href="{{ route('student.list') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">
                        @if (Str::startsWith(Route::currentRouteName(), 'student'))
                            <strong>Manage Students</strong>
                        @else
                            Manage Students
                        @endif
                    </span>
                </a>
                <a class="nav-link {{ Route::currentRouteName() == 'student.list' ? 'active' : '' }}"
                    href="{{ route('student.list') }}" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-eye text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">View Students</span>
                </a>
                <a class="nav-link {{ Route::currentRouteName() == 'student.add' ? 'active' : '' }}"
                    href="{{ route('student.add') }}" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-plus-fill text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Register Student</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('allteacher') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Teacher</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-book text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">
                        @if (Str::startsWith(Route::currentRouteName(), 'school_class'))
                            <strong>Manage Class</strong>
                        @else
                            Manage Class
                        @endif
                    </span>
                </a>
                <a class="nav-link {{ Route::currentRouteName() == 'school_class.list' ? 'active' : '' }}"
                    href="{{ route('school_class.list') }}" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-eye text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">View Class</span>
                </a>
                <a class="nav-link {{ Route::currentRouteName() == 'school_class.add' ? 'active' : '' }}"
                    href="{{ route('school_class.add') }}" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Add Class</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route("subject.list") }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Subject</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('score.class.list') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-percent text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Score</span>
                </a>
                <a class="nav-link" href="{{ route('score.student.delete', ['class_id'=>10]) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-trash-fill text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Delete</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
