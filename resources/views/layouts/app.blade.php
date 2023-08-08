<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

        @if(Auth::user())

            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">Главная</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="text-end">
                <a class="btn btn-secondary m-2" href="{{ route('profile.edit') }}">
                    <div class="text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                            <path
                                d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                        </svg>
                        Profile
                    </div>
                </a>

                <a href="#" class="btn btn-warning m-2"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        @else
            <a href="#" class="btn btn-warning m-2"
               onclick="event.preventDefault(); document.getElementById('login-form').submit();">Login</a>
            <form id="login-form" action="{{ route('login') }}" method="GET">
                @csrf
            </form>
        @endif

    </header>

    <div class="container-fluid">
        <div class="row">
            <nav style="height: calc(100vh - 48px);" id="sidebarMenu"
                 class="col-3 col-lg-2 d-md-block bg-light sidebar position-fixed">
                <div class="pt-3 sidebar-sticky">

                    @include('inc.admin.navigation')

                </div>
            </nav>

            <div class="col-9 ms-sm-auto col-lg-10 px-md-4 mt-3">

                @yield('content')

            </div>
        </div>
    </div>
</body>

</html>
