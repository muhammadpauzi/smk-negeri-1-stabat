<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                Dashboard | SMKN 1 Stabat
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex me-3">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="4" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="12" cy="7" r="4" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                        <div class="mt-1 small text-muted">{{ Str::ucfirst(auth()->user()->role) }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Profile & account</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Settings</a>
                    <form action="{{ route('signOut') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item btn-danger">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <!-- .navbar-overflow in main.css -->
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav navbar-overflow">
                    <li class="nav-item {{ request()->routeIs('home.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="12" cy="13" r="2" />
                                    <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                                    <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    @if( auth()->user()->isSuperadmin() )
                    <li class="nav-item {{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                User
                            </span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item  {{ request()->routeIs('dashboard.articles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.articles.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                    <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                    <line x1="3" y1="6" x2="3" y2="19" />
                                    <line x1="12" y1="6" x2="12" y2="19" />
                                    <line x1="21" y1="6" x2="21" y2="19" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Article
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.categories.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z" />
                                    <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116" />
                                    <path d="M6 9h-.01" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Category
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.majors.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.majors.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M17.8 19.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                    <path d="M6.2 19.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                    <path d="M12 9.817l-2.172 1.138a0.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a0.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a0.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a0.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a0.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Major
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.teachers.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.teachers.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="5" y="4" width="4" height="16" rx="1" />
                                    <rect x="9" y="4" width="4" height="16" rx="1" />
                                    <path d="M5 8h4" />
                                    <path d="M9 16h4" />
                                    <g transform="rotate(-13 27.054 -55.827)">
                                        <rect width="4" height="16" rx="1" />
                                        <path d="M0 4h4" />
                                        <path d="M0 12h4" />
                                    </g>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Teacher
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.students.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.students.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Student
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.slides.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.slides.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="15" y1="6" x2="15.01" y2="6" />
                                    <rect x="3" y="3" width="18" height="14" rx="3" />
                                    <path d="M3 13l4 -4a3 5 0 0 1 3 0l4 4" />
                                    <path d="M13 12l2 -2a3 5 0 0 1 3 0l3 3" />
                                    <line x1="8" y1="21" x2="8.01" y2="21" />
                                    <line x1="12" y1="21" x2="12.01" y2="21" />
                                    <line x1="16" y1="21" x2="16.01" y2="21" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Slide
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.school-profile.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.school-profile.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                School Profile
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.menus.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.menus.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="4" y1="8" x2="20" y2="8" />
                                    <line x1="4" y1="16" x2="20" y2="16" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Menu
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('dashboard.pages.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.pages.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="7" y="3" width="14" height="14" rx="2" />
                                    <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Page
                            </span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-xl my-2">
    <!-- alert -->
    <div class="w-100">
        @if( session('errorMessage') )
        <div class="alert alert-danger block m-0" role="alert">
            {{ session('errorMessage') }}
        </div>
        @endif

        @if( session('success') )
        <div class="alert alert-success block m-0" role="alert">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>