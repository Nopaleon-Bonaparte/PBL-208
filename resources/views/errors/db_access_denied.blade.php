<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Error — Akses Dicabut</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body {
    font-family:'Inter',sans-serif;
    min-height:100vh;
    background:#f7d7de;
    display:flex; align-items:center; justify-content:center;
    padding:24px;
  }
  .card {
    background:#ffffff;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    width:100%; max-width:325px;
    padding:44px 40px 52px;
    text-align:center;
  }
  .icon {
    width:56px; height:56px; margin:0 auto 26px;
    border-radius:50%;
    background:#e8320e;
    border:3px solid #111;
    display:flex; align-items:center; justify-content:center;
  }
  .icon .bar { width:26px; height:6px; border-radius:2px; background:#fff; }
  h1 { font-size:22px; font-weight:700; color:#7a1420; margin-bottom:16px; }
  p  { font-size:16px; font-weight:600; color:#7a1420; }
</style>
</head>
<body>
  <div class="card">
    <div class="icon"><div class="bar"></div></div>
    <h1>Error!</h1>
    <p>{{ $judul ?? 'Akses Anda telah dicabut' }}</p>
  </div>
</body>
</html>
