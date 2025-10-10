<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WiLink-Tickets') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo WiLink-Tickets" style="height: 40px;">
                    {{ config('app.name', 'WiLink-Tickets') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">{{ __('Services') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tarifs.index') }}">{{ __('Tarifs') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">{{ __('Contact') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
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

        <main>
            @yield('content')
        </main>

        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a class="footer-brand" href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo WiLink-Tickets" style="height: 30px;">
                            {{ config('app.name', 'WiLink-Tickets') }}
                        </a>
                        <p class="mt-3">{{ config('app.name', 'WiLink-Tickets') }} offre un accès internet fiable et abordable.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Liens Rapides</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('services.index') }}">Services</a></li>
                            <li><a href="{{ route('tarifs.index') }}">Tarifs</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Nous Contacter</h5>
                        <ul class="list-unstyled">
                            <li>Email: info@fasowifi.com</li>
                            <li>Téléphone: +226 00 00 00 00</li>
                            <li>Adresse: 123 Rue Principale, Ouagadougou</li>
                        </ul>
                    </div>
                </div>
                <hr style="border-color: rgba(255, 255, 255, 0.2);">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'WiLink-Tickets') }}. Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
