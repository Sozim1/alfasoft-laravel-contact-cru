<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
    <div class="container">
        {{-- Logo e título --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('contacts.index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="150" height="50" class="d-inline-block align-text-top">
        </a>

        {{-- Botão de colapsar (mobile) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Conteúdo da navbar --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav align-items-center gap-2">

                {{-- Select de idioma --}}
                <li class="nav-item">
                    <form action="{{ route('change.language') }}" method="POST">
                        @csrf
                        <select name="language" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="pt_BR" {{ app()->getLocale() == 'pt_BR' ? 'selected' : '' }}>🇧🇷 Português (BR)</option>
                            <option value="pt_PT" {{ app()->getLocale() == 'pt_PT' ? 'selected' : '' }}>🇵🇹 Português (PT)</option>
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 English</option>
                            <option value="sv" {{ app()->getLocale() == 'sv' ? 'selected' : '' }}>🇸🇪 Svenska</option>
                        </select>
                    </form>
                </li>

                {{-- Ações do usuário --}}
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                @else
                    <li class="nav-item">
                        <span class="nav-link">👤 {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link p-0">Sair</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>



<main class="container">
    @yield('content')
</main>
</body>
</html>
