<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Intranet-Margube · Iniciar sesión</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css'])
<style>
html,body{overflow-x:hidden;max-width:100vw;}
:root{--bg:#0d1117;--surface:#161b27;--surface2:#1e2638;--border:#2a3450;
  --text:#e8ecf5;--text2:#8b97b8;--primary:#4f79f7;--primary-light:#6b8ff9;
  --primary-dim:rgba(79,121,247,.12);--red:#f74f6e;--red-dim:rgba(247,79,110,.12);
  --green:#4fca8a;--green-dim:rgba(79,202,138,.12);}
[data-theme="light"]{
  --bg:#f3f4f6;--surface:#ffffff;--surface2:#f9fafb;--border:#e5e7eb;
  --text:#111827;--text2:#4b5563;--primary:#3b82f6;--primary-light:#60a5fa;
  --primary-dim:rgba(59,130,246,.12);--red:#dc2626;--red-dim:rgba(220,38,38,.12);
  --green:#059669;--green-dim:rgba(5,150,105,.12);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);
  min-height:100vh;display:flex;align-items:center;justify-content:center;
  background-image:radial-gradient(ellipse at 30% 50%,rgba(79,121,247,.15) 0%,transparent 60%),
    radial-gradient(ellipse at 80% 20%,rgba(155,111,247,.1) 0%,transparent 50%);}
body::before{content:'';position:fixed;inset:0;
  background-image:radial-gradient(circle,var(--border) 1px,transparent 1px);
  background-size:40px 40px;opacity:.25;pointer-events:none;}
h1,h2{font-family:'Syne',sans-serif;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:20px;
  padding:46px 42px;width:420px;max-width:95vw;position:relative;z-index:1;
  box-shadow:0 0 80px rgba(79,121,247,.1),0 4px 24px rgba(0,0,0,.4);}
.logo{display:flex;align-items:center;gap:12px;margin-bottom:30px;}
.logo-icon{width:44px;height:44px;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);border-radius:12px;
  display:flex;align-items:center;justify-content:center;font-size:20px;box-shadow:0 4px 12px rgba(79,121,247,.3);}
.logo h1{font-size:22px;font-weight:800;letter-spacing:-.5px;}
.logo span{color:var(--primary);}
h2{font-size:26px;font-weight:700;margin-bottom:5px;}
.sub{color:var(--text2);font-size:14px;margin-bottom:26px;}
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:12.5px;font-weight:600;color:var(--text2);margin-bottom:7px;letter-spacing:.3px;}
.form-control{width:100%;padding:11px 14px;background:var(--surface2);border:1px solid var(--border);
  border-radius:10px;color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;
  transition:border-color .2s,box-shadow .2s;outline:none;}
.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px var(--primary-dim);}
.form-control::placeholder{color:#4a5670;}
.btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;
  padding:12px;border-radius:10px;font-family:'Plus Jakarta Sans',sans-serif;
  font-size:15px;font-weight:600;cursor:pointer;border:none;
  background:var(--primary);color:#fff;margin-top:8px;transition:all .2s;}
.btn:hover{background:var(--primary-light);transform:translateY(-1px);box-shadow:0 8px 20px rgba(79,121,247,.35);}
.error-box{background:var(--red-dim);border:1px solid rgba(247,79,110,.2);color:var(--red);
  padding:10px 14px;border-radius:9px;font-size:13px;margin-bottom:16px;}
.demo-box{margin-top:20px;padding:14px;background:var(--primary-dim);
  border:1px solid rgba(79,121,247,.2);border-radius:10px;font-size:12px;
  color:var(--text2);line-height:1.9;}
.demo-box strong{color:var(--primary);}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}
.shake{animation:shake .3s ease;}

/* Mobile */
@media(max-width:480px){
  body{padding:12px;}
  .card{padding:24px 20px;border-radius:16px;}
  .logo{margin-bottom:20px;}
  .logo-icon{width:38px;height:38px;font-size:18px;}
  .logo h1{font-size:18px;}
  h2{font-size:20px;}
  .sub{font-size:12px;margin-bottom:16px;}
  .form-group{margin-bottom:12px;}
  .form-control{padding:10px 12px;font-size:14px;}
  .btn{padding:11px;font-size:14px;}
  .demo-box{font-size:10px;padding:10px;}
}
</style>
<script>
  const theme = localStorage.getItem('theme') || 'dark';
  document.documentElement.setAttribute('data-theme', theme);
</script>
</head>
<body>

<button id="themeToggle" style="position:absolute;top:24px;right:24px;background:var(--surface);border:1px solid var(--border);color:var(--text);border-radius:50%;width:42px;height:42px;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,.1);transition:all .2s;" title="Cambiar tema">☀️</button>

<div class="card">
  <div class="logo">
    <img src="{{ asset('logo.png') }}" alt="Intranet Logo" class="logo-icon">
    <h1>Intra<span>Net</span></h1>
  </div>
  <h2>Bienvenido de nuevo</h2>
  <p class="sub">Accede al portal corporativo</p>

  @if($errors->any())
    <div class="error-box shake">❌ {{ $errors->first() }}</div>
  @endif
  @if(session('success'))
    <div style="background:var(--green-dim);border:1px solid rgba(79,202,138,.2);color:var(--green);
      padding:10px 14px;border-radius:9px;font-size:13px;margin-bottom:16px;">
      ✅ {{ session('success') }}
    </div>
  @endif

  <form action="/login" method="POST">
    @csrf
    <div class="form-group">
      <label>Correo electrónico</label>
      <input type="email" name="email" class="form-control" placeholder="tu@empresa.com"
        value="{{ old('email') }}" required autofocus>
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input type="password" name="password" class="form-control" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn">Entrar al portal →</button>
  </form>

  <div class="demo-box">
    <strong>👤 Admin:</strong> admin@empresa.com / admin123<br>
    <strong>👤 Empleado:</strong> ana@empresa.com / emp123<br>
    <strong>👤 Empleado:</strong> luis@empresa.com / emp123
  </div>
</div>

<script>
  const themeToggleBtn = document.getElementById('themeToggle');
  const updateIcon = () => {
    themeToggleBtn.innerHTML = document.documentElement.getAttribute('data-theme') === 'light' ? '🌙' : '☀️';
  };
  updateIcon();
  themeToggleBtn.addEventListener('click', () => {
    const newTheme = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateIcon();
  });
</script>
</body>
</html>
