<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Data Masjid — PRM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family:'Inter',sans-serif; }
.m-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(290px,1fr)); gap:16px; }
.m-card { background:#fff; border:1px solid var(--gray-200); border-radius:12px; padding:18px;
  box-shadow:0 1px 3px rgba(0,0,0,.05); transition:transform .15s, box-shadow .15s; }
.m-card:hover { transform:translateY(-3px); box-shadow:0 8px 20px rgba(30,107,63,.15); }
.m-top { display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.m-icon { width:40px; height:40px; border-radius:10px; background:#1e6b3f; color:#fff;
  display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
.m-name { font-size:15px; font-weight:700; color:var(--gray-900); line-height:1.3; }
.m-sub { font-size:12px; color:var(--gray-500); }
.m-badge { font-size:10.5px; font-weight:700; padding:3px 9px; border-radius:999px; }
.m-badge.approved { background:#dcfce7; color:#15803d; }
.m-badge.pending { background:#fef9c3; color:#a16207; }
.m-row { font-size:12.5px; color:var(--gray-600); margin-top:6px; display:flex; gap:6px; align-items:center; }
.m-row i { color:var(--gray-400); }
.m-contact { margin-top:12px; padding-top:12px; border-top:1px dashed var(--gray-200); font-size:12px; }
.m-contact b { color:var(--gray-900); }
.m-actions { margin-top:12px; }
.flash { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:16px; }
.flash.ok { background:#dcfce7; color:#15803d; }
.flash.err { background:#fee2e2; color:#b91c1c; }
.empty { text-align:center; color:var(--gray-400); padding:60px 0; }
.empty i { font-size:42px; display:block; margin-bottom:10px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_ranting.sidebar', ['activeNav' => 'data-masjid'])

  <div class="main-shell">
    @include('admin_ranting.topbar', ['activeTopLink' => 'data-masjid'])

    <main class="page-content">

      <div class="page-header" style="margin-bottom:20px; display:flex; align-items:center; justify-content:space-between;">
        <div class="page-header-left">
          <h1>Data Masjid / Musholla</h1>
          <p>Daftar masjid di ranting Anda. Tambahkan data baru untuk diajukan ke admin cabang.</p>
        </div>
        <a href="{{ url('/prm/tambah-masjid') }}" class="btn btn-primary">
          <i class="ti ti-plus"></i> Tambah Masjid
        </a>
      </div>

      @if(session('success'))<div class="flash ok">{{ session('success') }}</div>@endif
      @if(session('error'))<div class="flash err">{{ session('error') }}</div>@endif

      <div class="m-grid">
        @forelse($masjid as $m)
          <div class="m-card">
            <div class="m-top">
              <div class="m-icon"><i class="ti ti-building-mosque"></i></div>
              <div style="flex:1;">
                <div class="m-name">{{ $m->nama_masjid }}</div>
                <div class="m-sub">{{ $m->tipe ?? 'Masjid' }} · {{ $m->wilayah ?? '-' }}</div>
              </div>
              @if($m->status_data === 'approved')
                <span class="m-badge approved">Aktif</span>
              @else
                <span class="m-badge pending">Menunggu</span>
              @endif
            </div>

            <div class="m-row"><i class="ti ti-map-pin"></i> {{ $m->alamat ?? 'Alamat belum diisi' }}</div>
            <div class="m-row"><i class="ti ti-certificate"></i> Legalitas: {{ $m->status_legalitas ?? '-' }}</div>

            <div class="m-contact">
              <b>Info Kontak Pengurus</b><br>
              <i class="ti ti-phone"></i> {{ $m->kontak_pengurus ?? '-' }}<br>
              @if($m->status_data === 'approved')
                <span style="color:var(--gray-500);">
                  Login default — user: <b>{{ $m->default_username }}</b>, pass: <b>{{ $m->default_password }}</b>
                </span>
              @else
                <span style="color:#a16207;">Akun aktif setelah disetujui admin cabang.</span>
              @endif
            </div>

            <div class="m-actions">
              <a href="{{ url('/prm/edit-masjid/'.$m->id_masjid) }}" class="btn btn-secondary btn-sm">
                <i class="ti ti-edit"></i> Ajukan Perubahan
              </a>
            </div>
          </div>
        @empty
          <div class="empty" style="grid-column:1/-1;">
            <i class="ti ti-building-mosque"></i>
            Belum ada data masjid. Klik "Tambah Masjid" untuk mengajukan.
          </div>
        @endforelse
      </div>

    </main>
  </div>
</div>
</body>
</html>
