<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Pengaturan — PRM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
  body { font-family: 'Inter', sans-serif; background: #f6f8eb; }

  .settings-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:24px; }
  .settings-card-title { display:flex; align-items:center; gap:10px; font-size:16px; font-weight:700; color:var(--gray-900); padding-bottom:16px; margin-bottom:20px; border-bottom:1px solid var(--gray-100); }
  .settings-card-title i { font-size:20px; color:var(--green-700); }
  .settings-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px 20px; margin-bottom:18px; }
  .settings-field.full { grid-column:1 / -1; }
  .settings-field label { font-size:12px; font-weight:600; color:var(--gray-500); margin-bottom:6px; display:block; }
  .settings-field input { width:100%; padding:11px 14px; border:1px solid var(--gray-200); border-radius:var(--radius-md); font-size:13px; color:var(--gray-800); font-family:inherit; background:#fff; }
  .settings-field input:focus { outline:none; border-color:var(--green-400); box-shadow:0 0 0 3px rgba(39,134,79,.08); }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_ranting.sidebar', ['activeNav' => 'settings'])

  <div class="main-shell">
    @include('admin_ranting.topbar', ['activeTopLink' => 'settings'])

    <main class="page-content">

      <div class="breadcrumb">
        <a href="{{ url('/prm/membership') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="current">Pengaturan</span>
      </div>

      <div class="page-header">
        <div class="page-header-left">
          <h1>Pengaturan</h1>
          <p>Kelola informasi profil akun admin ranting.</p>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan Perubahan</button>
      </div>

      <div class="settings-card">
        <div class="settings-card-title">
          <i class="ti ti-user"></i> Informasi Profil
        </div>

        <div class="settings-grid">
          <div class="settings-field">
            <label>Nama Lengkap</label>
            <input type="text" value="{{ session('nama_lengkap', session('username')) }}">
          </div>
          <div class="settings-field">
            <label>Alamat Email</label>
            <input type="email" value="{{ session('email') }}">
          </div>
          <div class="settings-field">
            <label>No. Telepon</label>
            <input type="text" value="{{ session('phone') }}">
          </div>
          <div class="settings-field">
            <label>Nama Panggilan</label>
            <input type="text" value="{{ session('nama_panggilan') }}">
          </div>
        </div>

        <div class="settings-field full">
          <label>Alamat</label>
          <input type="text" value="{{ session('alamat') }}">
        </div>
      </div>

    </main>
  </div>
</div>
</body>
</html>