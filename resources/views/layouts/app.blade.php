<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>{{ config('app.name','Intranet-Margube') }} · @yield('title','Portal')</title>
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css'])
@stack('css')
<script>
  const theme = localStorage.getItem('theme') || 'dark';
  document.documentElement.setAttribute('data-theme', theme);
</script>
</head>
<body>

{{-- SIDEBAR OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="{{ asset('logo.png') }}" alt="Intranet Logo" class="logo-icon">
    <h2>Intra<span>Net</span></h2>
  </div>

  <div class="sidebar-user">
    <div class="avatar">{{ strtoupper(substr(session('user_name','?'),0,2)) }}</div>
    <div class="user-info">
      <div class="uname">{{ session('user_name') }}</div>
      <div class="urole">
        @if(session('user_role')==='admin')
          <span class="badge-admin">⭐ Admin</span>
        @else
          Empleado
        @endif
      </div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Principal</div>
    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <span class="ni">📊</span> Dashboard
    </a>
    <a href="{{ route('news.index') }}" class="nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
      <span class="ni">📰</span> Noticias & Eventos
    </a>

    <div class="nav-section">Reservas</div>
    <a href="{{ route('rooms.index') }}" class="nav-item {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
      <span class="ni">🚪</span> Salas
    </a>
    <a href="{{ route('cars.index') }}" class="nav-item {{ request()->routeIs('cars.*') ? 'active' : '' }}">
      <span class="ni">🚗</span> Vehículos
    </a>

    <div class="nav-section">Gestión</div>
    <a href="{{ route('purchases.index') }}" class="nav-item {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
      <span class="ni">🛒</span> Solicitudes compra
    </a>
    <a href="{{ route('absences.index') }}" class="nav-item {{ request()->routeIs('absences.*') ? 'active' : '' }}">
      <span class="ni">🏖️</span> Ausencias
    </a>
    <a href="{{ route('employees.index') }}" class="nav-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
      <span class="ni">👥</span> Empleados
    </a>

    @if(session('user_role')==='admin')
    <div class="nav-section">Administración</div>
    <a href="{{ route('admin.index') }}" class="nav-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
      <span class="ni">⚙️</span> Panel Admin
    </a>
    @endif
  </nav>

  <div class="sidebar-bottom">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="logout-btn" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">
        <span class="ni">🚪</span> Cerrar sesión
      </button>
    </form>
  </div>
</aside>

{{-- MAIN --}}
<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h1>@yield('title','Dashboard')</h1>
      <p>{{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
    </div>
    <div class="topbar-right">
      <span class="date-chip">{{ now()->format('d/m/Y') }}</span>
      <button id="themeToggle" class="btn btn-ghost btn-icon" title="Cambiar tema">☀️</button>
      <div class="avatar sidebar-toggle" id="sidebarToggle" style="cursor:pointer" title="{{ session('user_name') }} - Click para menú">{{ strtoupper(substr(session('user_name','?'),0,2)) }}</div>
    </div>
  </div>

  <div class="page-body">
    {{-- Flash messages --}}
    @if(session('success'))
      <div class="alerts">
        <div class="alert alert-success">
          <span class="al-icon">✅</span>
          <span>{{ session('success') }}</span>
          <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
        </div>
      </div>
    @endif
    @if(session('error'))
      <div class="alerts">
        <div class="alert alert-error">
          <span class="al-icon">❌</span>
          <span>{{ session('error') }}</span>
          <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
        </div>
      </div>
    @endif

    @yield('content')
  </div>
</div>

<script>
// Auto-dismiss flash alerts after 5s
setTimeout(() => {
  document.querySelectorAll('.alert-success, .alert-error').forEach(el => {
    el.style.transition = 'opacity .4s';
    el.style.opacity = '0';
    setTimeout(() => el.remove(), 400);
  });
}, 5000);

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  
  function toggleSidebar() {
    sidebar.classList.toggle('open');
    if(sidebar.classList.contains('open')) {
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    } else {
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
  }
  
  if (toggle && sidebar) {
    toggle.addEventListener('click', toggleSidebar);
  }
  
  if (overlay) {
    overlay.addEventListener('click', toggleSidebar);
  }

  // Theme toggle
  const themeToggleBtn = document.getElementById('themeToggle');
  const updateIcon = () => {
    themeToggleBtn.innerHTML = document.documentElement.getAttribute('data-theme') === 'light' ? '🌙' : '☀️';
  };
  if (themeToggleBtn) {
    updateIcon();
    themeToggleBtn.addEventListener('click', () => {
      const newTheme = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      updateIcon();
    });
  }
});
</script>
</body>
</html>
