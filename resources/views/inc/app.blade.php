@extends('inc.main')
@section('page_title')
    @yield('title') - LVS
@endsection

@section('nav')
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">LVS</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.index') }}"><i class="fas fa-user"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Uitloggen</a></li>
                </ul>
            </li> --}}
        </ul>
    </nav>
@endsection

@section('sidebar')
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link @if ($page_id == 'dashboard') active @endif" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    @can('projects.owns')
                        <a class="nav-link @if ($page_id == 'projects') active @endif" href="{{ route('projects.own') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                            Mijn project
                        </a>
                    @endcan
                    <a class="nav-link @if ($page_id == 'questions') active @endif"
                        href="{{ route('questions.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
                        Vragen
                        {{-- @can('questions.view')
                            <span class="badge rounded-pill text-bg-primary">{{ Question::withCount('answer') }}</span>
                        @endcan --}}
                    </a>
                    <a class="nav-link @if ($page_id == 'conversations') active @endif"
                        href="{{ route('conversations.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                        Gesprekken
                    </a>
                    @can('schedule.view')
                        <a class="nav-link @if ($page_id == 'schedule') active @endif"
                            href="{{ route('schedule.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                            Rooster
                        </a>
                    @endcan
                    @if (auth()->user()->can('students.viewown') &&
                        auth()->user()->cannot('students.view'))
                        <a class="nav-link @if ($page_id != 'students') collapsed @endif" href="#"
                            data-bs-toggle="collapse" data-bs-target="#collapseStudents"
                            aria-expanded="@if ($page_id == 'students') true @else false @endif"
                            aria-controls="collapseStudents">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Leerlingen
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse @if ($page_id == 'students') show @endif" id="collapseStudents"
                            aria-labelledby="headingOne">
                            <nav class="sb-sidenav-menu-nested nav">
                                @php($students = auth()->user()->students)
                                @foreach ($students as $student)
                                    <a class="nav-link"
                                        href="{{ route('students.show', ['id' => $student->id]) }}">{{ $student->name }}</a>
                                @endforeach
                            </nav>
                        </div>
                    @endif
                    @can('absencerequest.view')
                        <a class="nav-link @if ($page_id == 'absencerequests') active @endif"
                            href="{{ route('absencerequests.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-clock"></i></div>
                            Verzuimverzoeken
                        </a>
                    @endcan
                    @canany(['students.view', 'buddies.view', 'users.view'])
                        <div class="sb-sidenav-menu-heading">Beheer</div>
                    @endcan
                    @can('students.view')
                        <a class="nav-link @if ($page_id == 'students') active @endif"
                            href="{{ route('students.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Leerlingen
                        </a>
                    @endcan
                    @can('buddies.view')
                        <a class="nav-link @if ($page_id == 'buddies') active @endif"
                            href="{{ route('buddies.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Buddy's
                        </a>
                    @endcan
                    @can('users.view')
                        <a class="nav-link @if ($page_id == 'users') active @endif"
                            href="{{ route('users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Gebruikers
                        </a>
                    @endcan
                    {{-- <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a> --}}
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Ingelogd als:</div>
                {{ auth()->user()->name }}
            </div>
        </nav>
    </div>
@endsection()

@section('footer')
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Rick Okkersen {{ date('Y') }}</div>
            </div>
        </div>
    </footer>
@endsection()
