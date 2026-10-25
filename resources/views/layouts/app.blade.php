<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransRio - Riosucio</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Menu -->
    <header class="header">
        <button id="btnMenu" class="btn-menu">☰</button>
        <div class="logo"><i class="bi bi-bus-front" style="color:white;"></i> TransRio</div>
        <div style="width:30px"></div>
    </header>

    <nav id="sideMenu" class="side-menu">
        <div class="menu-header-azul">
            <div class="menu-logo"><i class="bi bi-bus-front" style="color:white;"></i> TransRio</div>
            <button class="close-menu" onclick="toggleMenu()">X</button>
        </div>
        <a href="/">🗺️ Mapa</a>
        <a href="/paradas">📍 Paradas</a>
        <a href="/rutas">🚌 Rutas</a>
        <a href="/horarios">🕒 Horarios</a>
        <a href="/tarifas">💰 Tarifas</a>
        <a href="/numeros">📞 Números</a>
        <a href="/ayuda">❓ Ayuda</a>
        @auth
        @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
        <a href="/admin">⚙️ Admin</a>
        @endif
        @endauth
        @auth
        @if(auth()->user()->role === 'conductor' && auth()->user()->is_approved)
        <a href="/conductor">🟢 Transmitir Ubicación</a>
        @endif
        @endauth
        <hr style="margin: 10px 0; opacity: 0.3;">

        @guest
        <a href="/login">👤 Ingresar</a>
        <a href="/register">📝 Registrarse</a>
        @endguest

        @auth
        <a href="/perfil">👤 {{ Auth::user()->name }}</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Cerrar sesión</a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
    </nav>

    <main>@yield('content')</main>

    <footer class="footer">
        <p>TransRio © 2026 - Riosucio, Caldas - Todos los derechos reservados</p>
        <a href="mailto:admini@transrio.com">Soporte Técnico</a>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
