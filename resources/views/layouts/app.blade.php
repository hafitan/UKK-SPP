<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SPP SMANIC</title>
        <link rel="stylesheet" href="{{asset('assets/css2.css')}}">
        <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome-free-5.15.3-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css') }}">

        <script src="{{asset('assets/jquery-3.6.0.slim.min.js')}}"></script>
        <script src="{{asset('assets/popper.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap.min.js')}}"></script>

        <script src="{{asset('assets/jquery.min.js')}}"></script>

        <link rel="stylesheet" href="{{asset('assets/jquery.dataTables.css')}}">
        <script src="{{asset('assets/jquery.dataTables.js')}}"></script>

        <link rel="stylesheet" href="{{asset('assets/select2.min.css')}}">
        <script src="{{asset('assets/select2.min.js')}}"></script>
        <script src="{{ asset('assets/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/pdfmake.min.js') }}" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/vfs_fonts.min.js') }}" integrity="sha512-P0bOMePRS378NwmPDVPU455C/TuxDS+8QwJozdc7PGgN8kLqR4ems0U/3DeJkmiE31749vYWHvBOtR+37qDCZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/jszip.min.js') }}" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/buttons.print.min.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body style="background: rgba(153, 78, 245, 0.578)">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ 'SPP SMA NEGRI 1 CIAWI' }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- udah login --}}
                        @auth
                            @if (auth()->user()->level == "admin")
                                <li class="nav-item">
                                    <a href="{{ route('kelas.index') }}" class="nav-link">Kelas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('siswa.index') }}" class="nav-link">Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('petugas.index') }}" class="nav-link">Petugas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('spp.index') }}" class="nav-link">SPP</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pembayaran.index') }}" class="nav-link">Pembayaran</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('pembayaran.history') }}" class="nav-link">history</a>
                                </li> --}}
                            @elseif(auth()->user()->level == 'petugas')
                                <li class="nav-item">
                                    <a href="{{ route('pembayaran.index') }}" class="nav-link">Pembayaran</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pembayaran.history') }}" class="nav-link">history</a>
                                </li>
                            @elseif (auth()->user()->level == 'siswa')
                                <li class="nav-item">
                                    <a href="{{ route('pembayaran.history') }}" class="nav-link">history</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Link Authentikasi -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card p-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
