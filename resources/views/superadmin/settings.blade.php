<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Pengaturan Akun — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
@include('shared.styles')
<style>
  body { font-family: 'Inter', sans-serif; background: #f6f8eb; }

  .settings-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:24px; }
  .settings-card-title { display:flex; align-items:center; gap:10px; font-size:16px; font-weight:700; color:var(--gray-900); padding-bottom:16px; margin-bottom:20px; border-bottom:1px solid var(--gray-100); }
  .settings-card-title i { font-size:20px; color:#1e6b3f; }
  .settings-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px 20px; margin-bottom:18px; }
  .settings-field label { font-size:12px; font-weight:600; color:var(--gray-500); margin-bottom:6px; display:block; }
  .settings-field input { width:100%; padding:11px 14px; border:1px solid var(--gray-200); border-radius:var(--radius-md); font-size:13px; color:var(--gray-800); font-family:inherit; background:#fff; }
  .settings-field input:focus { outline:none; border-color:#1e6b3f; box-shadow:0 0 0 3px rgba(30,107,63,.08); }
</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'settings'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'settings'])

    <main class="page-content">

      <div class="breadcrumb">
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="current">Pengaturan</span>
      </div>

      <form action="{{ route('settings.save') }}" method="POST">
        @csrf

        <div class="page-header">
          <div class="page-header-left">
            <h1>Pengaturan</h1>
            <p>Kelola informasi profil dan kredensial login akun Anda.</p>
          </div>
          <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan Perubahan</button>
        </div>

        @if(session('success'))
          <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg font-medium flex items-center gap-2">
            <i class="ti ti-circle-check"></i> {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg font-medium">
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="settings-card">
          <div class="settings-card-title">
            <i class="ti ti-user"></i> Informasi Profil & Kredensial
          </div>

          <div class="settings-grid">
            <div class="settings-field">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
            </div>
            <div class="settings-field">
              <label>Username</label>
              <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
            </div>
            <div class="settings-field">
              <label>Alamat Email</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}">
            </div>
            <div class="settings-field">
              <label>No. HP</label>
              <input type="text" name="no_hp" id="saHpInput" value="{{ old('no_hp', $user->no_hp) }}">
            </div>
            <div class="settings-field">
              <label>Password Baru (Kosongkan jika tidak diubah)</label>
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

<script>
const hpInput = document.getElementById('saHpInput');
if (hpInput) {
  hpInput.addEventListener('input', function (e) {
    let val = e.target.value.replace(/\D/g, '');
    let formatted = '';
    if (val.length > 0) {
      formatted += val.substring(0, 4);
    }
    if (val.length > 4) {
      formatted += '-' + val.substring(4, 8);
    }
    if (val.length > 8) {
      formatted += '-' + val.substring(8, 13);
    }
    e.target.value = formatted;
  });
}
</script>
</body>
</html>
