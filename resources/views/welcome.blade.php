<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
         @vite('resources/css/welcome.css')

        <!-- Styles / Scripts -->
    </head>
    <body >
        <header >
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-primary">Home</a></li>
       
      </ul>

      <div class="col-md-3 text-end">
         @if (Route::has('login'))
         <nav class="nav" aria-label="Main navigation" >
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-link px-2 link-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link px-2 link-primary">Iniciar sesión</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link px-2 link-primary">Registrarse</a>
                @endif
            @endauth
         </nav>
      @endif
    </header>
           
    </body>
</html>
