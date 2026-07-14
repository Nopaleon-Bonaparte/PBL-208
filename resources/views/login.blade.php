<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Login — PDM Kota Batam</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }

  body {
    min-height:100vh;
    background: linear-gradient(rgba(20,40,30,.25), rgba(20,40,30,.35)),
                url('{{ asset("images/batam-bg.jpg") }}') center/cover no-repeat;
    display:flex; align-items:center; justify-content:flex-end;
    padding:40px; position:relative; overflow:hidden;
  }

  .brand {
    position:absolute; left:60px; top:50%; transform:translateY(-50%);
    color:#fff; max-width:55%;
  }
  .brand h1 { font-size:130px; font-weight:800; line-height:.95; letter-spacing:2px;
              text-shadow:0 4px 20px rgba(0,0,0,.35); }
  .brand h2 { font-size:40px; font-weight:700; margin-top:6px;
              text-shadow:0 2px 12px rgba(0,0,0,.4); }
  .brand p  { font-size:18px; font-weight:400; margin-top:12px; opacity:.95;
              text-shadow:0 2px 10px rgba(0,0,0,.5); }

  .login-card {
    width:420px; background:rgba(255,255,255,.12);
    backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
    border:1.5px solid rgba(255,255,255,.5); border-radius:24px;
    padding:50px 40px 40px; box-shadow:0 8px 40px rgba(0,0,0,.25); margin-right:40px;
  }
  .login-card .avatar { width:70px; height:70px; margin:0 auto 30px;
                        display:flex; align-items:center; justify-content:center; }
  .login-card .avatar svg { width:64px; height:64px; }

  .field { display:flex; align-items:center; background:rgba(255,255,255,.15);
    border:1.5px solid rgba(255,255,255,.6); border-radius:999px;
    padding:14px 22px; margin-bottom:18px; }
  .field input { width:100%; background:transparent; border:none; outline:none;
                 color:#fff; font-size:15px; }
  .field input::placeholder { color:rgba(255,255,255,.85); }

  .btn-masuk { width:100%; background:#8ba05a; color:#fff; font-size:17px;
    font-weight:700; letter-spacing:1px; border:none; border-radius:999px;
    padding:15px; margin-top:8px; cursor:pointer; transition:background .15s, transform .1s; }
  .btn-masuk:hover { background:#7a9049; }
  .btn-masuk:active { transform:scale(.98); }

  .error-msg { background:rgba(220,38,38,.85); color:#fff; font-size:13px;
    padding:10px 16px; border-radius:12px; margin-bottom:16px; text-align:center; }

  .success-msg { background:rgba(16,185,129,.85); color:#fff; font-size:13px;
    padding:10px 16px; border-radius:12px; margin-bottom:16px; text-align:center; }

  .credit { position:absolute; bottom:24px; left:50%; transform:translateX(-50%);
    color:#fff; font-size:15px; opacity:.9; text-shadow:0 2px 8px rgba(0,0,0,.5); }

  @media (max-width:900px) {
    body { justify-content:center; padding:20px; }
    .brand { position:static; transform:none; text-align:center; max-width:100%; margin-bottom:30px; }
    .brand h1 { font-size:80px; }
    .brand h2 { font-size:26px; }
    .login-card { margin-right:0; width:100%; max-width:400px; }
  }
</style>
</head>
<body>

  <div class="brand">
    <h1>PDM</h1>
    <h2>Pimpinan Daerah Muhammadiyah Kota Batam</h2>
    <p>Sistem Informasi Manajemen Organisasi Berbasis Dashboard Information System</p>
  </div>

  <div class="login-card">
    <div class="avatar">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5">
        <circle cx="12" cy="8" r="4"/>
        <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-linecap="round"/>
      </svg>
    </div>

    @if($errors->any())
      <div class="error-msg">{{ $errors->first() }}</div>
    @endif

    @if(session('success'))
      <div class="success-msg">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf
      <div class="field">
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required/>
      </div>
      <div class="field">
        <input type="password" name="password" placeholder="Password" required/>
      </div>
      <button type="submit" class="btn-masuk">MASUK</button>
    </form>
  </div>

  <div class="credit">Develop by : PBL TRPL 208</div>

</body>
</html>