<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Pengaturan — Panel Pengurus Masjid</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
  body { font-family: 'Inter', sans-serif; background: #f6f8eb; }

  .settings-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:24px; margin-bottom:20px; }
  .settings-card-title { display:flex; align-items:center; gap:10px; font-size:16px; font-weight:700; color:var(--gray-900); padding-bottom:16px; margin-bottom:20px; border-bottom:1px solid var(--gray-100); }
  .settings-card-title i { font-size:20px; color:var(--green-700); }
  .settings-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px 20px; margin-bottom:18px; }
  .settings-field label { font-size:12px; font-weight:600; color:var(--gray-500); margin-bottom:6px; display:block; text-transform:uppercase; letter-spacing:.04em; }
  .settings-field input {
    width:100%; padding:11px 14px; border:1px solid var(--gray-200);
    border-radius:var(--radius-md); font-size:13px; color:var(--gray-800);
    font-family:inherit; background:#fff; box-sizing:border-box;
    transition: border-color .15s, box-shadow .15s;
  }
  .settings-field input:focus { outline:none; border-color:var(--green-400); box-shadow:0 0 0 3px rgba(39,134,79,.08); }
  .settings-field input:disabled { background:var(--gray-50); color:var(--gray-500); cursor:not-allowed; }

  .alert-success {
    display:flex; align-items:center; gap:10px; background:#f0fdf4;
    border:1px solid #bbf7d0; color:#15803d; padding:12px 16px;
    border-radius:var(--radius-md); font-size:13px; font-weight:500; margin-bottom:20px;
  }
  .alert-error {
    background:#fef2f2; border:1px solid #fecaca; color:#b91c1c;
    padding:12px 16px; border-radius:var(--radius-md); font-size:13px;
    font-weight:500; margin-bottom:20px;
  }
  .info-note {
    font-size:12px; color:var(--gray-400); margin-top:6px;
    display:flex; align-items:center; gap:5px;
  }
</style>
</head>
<body>
<div class="app-shell">

  @include('pengurus_masjid.Sidebar', ['activeNav' => 'settings'])

  <div class="main-shell">
    @include('pengurus_masjid.Topbar', ['activeTopLink' => 'settings'])

    <main class="page-content">

      <div class="breadcrumb">
        <a href="{{ url('/masjid/informasi') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="current">Pengaturan</span>
      </div>

      <form action="{{ route('settings.save.masjid') }}" method="POST">
        @csrf

        <div class="page-header">
          <div class="page-header-left">
            <h1>Pengaturan Akun</h1>
            <p>Kelola kredensial login akun pengurus masjid.</p>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="ti ti-device-floppy"></i> Simpan Perubahan
          </button>
        </div>

        @if(session('success'))
          <div class="alert-success">
            <i class="ti ti-circle-check" style="font-size:18px;"></i>
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="alert-error">
            <ul style="margin:0;padding-left:18px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- INFO MASJID (read-only) --}}
        <div class="settings-card">
          <div class="settings-card-title">
            <i class="ti ti-building-mosque"></i> Masjid yang Dikelola
          </div>
          <div class="settings-grid">
            <div class="settings-field">
              <label>Nama Masjid</label>
              <input type="text" value="{{ $masjid->nama_masjid ?? '-' }}" disabled>
            </div>
            <div class="settings-field">
              <label>Ranting / PRM</label>
              <input type="text" value="{{ session('nama_ranting', '-') }}" disabled>
            </div>
            <div class="settings-field">
              <label>Kecamatan</label>
              <input type="text" value="{{ $masjid->kecamatan ?? '-' }}" disabled>
            </div>
            <div class="settings-field">
              <label>Status Data</label>
              <input type="text" value="{{ ucfirst($masjid->status_data ?? '-') }}" disabled>
            </div>
          </div>
          <p class="info-note">
            <i class="ti ti-info-circle"></i>
            Data masjid hanya dapat diubah melalui fitur Informasi Masjid dan disetujui oleh Admin Cabang.
          </p>
        </div>

        {{-- KREDENSIAL LOGIN --}}
        <div class="settings-card">
          <div class="settings-card-title">
            <i class="ti ti-lock"></i> Kredensial Login
          </div>
          <div class="settings-grid">
            <div class="settings-field">
              <label>Username Login</label>
              <input type="text" name="default_username"
                     value="{{ old('default_username', $masjid->default_username ?? '') }}"
                     required placeholder="Username untuk login">
            </div>
            <div class="settings-field" style="grid-column:1/-1;max-width:420px;">
              <label style="color:var(--gray-400);">Email (tidak dapat diubah)</label>
              <input type="text" value="{{ $masjid->email ?? '-' }}" disabled>
            </div>
            <div class="settings-field">
              <label>Password Baru <span style="font-weight:400;color:var(--gray-400);">(kosongkan jika tidak diubah)</span></label>
              <input type="password" name="password" placeholder="Minimal 6 karakter">
            </div>
            <div class="settings-field">
              <label>Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
            </div>
          </div>
        </div>

      </form>

    </main>
  </div>
</div>
</body>
</html>