<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Data Masjid — Superadmin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family:'Inter',sans-serif; }
.m-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(290px,1fr)); gap:16px; }
.m-card { background:#fff; border:1px solid var(--gray-200); border-radius:12px; padding:18px;
  box-shadow:0 1px 3px rgba(0,0,0,.05); }
.m-top { display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.m-icon { width:40px; height:40px; border-radius:10px; background:#1e6b3f; color:#fff;
  display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
.m-name { font-size:15px; font-weight:700; color:var(--gray-900); line-height:1.3; }
.m-sub { font-size:12px; color:var(--gray-500); }
.m-row { font-size:12.5px; color:var(--gray-600); margin-top:6px; display:flex; gap:6px; align-items:center; }
.m-row i { color:var(--gray-400); }
.m-cabang { font-size:11px; font-weight:700; color:#1e6b3f; background:#dcfce7;
  padding:3px 9px; border-radius:999px; }
.empty { text-align:center; color:var(--gray-400); padding:60px 0; }
.empty i { font-size:42px; display:block; margin-bottom:10px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'status-masjid'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'status-masjid'])

    <main class="page-content">

      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Data Masjid (Seluruh Cabang)</h1>
          <p>Data yang sudah jadi dan dikelola dari seluruh cabang. Tampilan hanya untuk pemantauan.</p>
        </div>
      </div>

      <div class="dm-notice" style="margin-bottom:20px;">
        <i class="ti ti-eye"></i>
        Superadmin hanya dapat melihat data. Pengelolaan dilakukan oleh admin cabang & ranting.
      </div>

      <div class="m-grid">
        @forelse($masjid as $m)
          <div class="m-card">
            <div class="m-top">
              <div class="m-icon"><i class="ti ti-building-mosque"></i></div>
              <div style="flex:1;">
                <div class="m-name">{{ $m->nama_masjid }}</div>
                <div class="m-sub">{{ $m->tipe ?? 'Masjid' }} · {{ $m->nama_ranting ?? '-' }}</div>
              </div>
            </div>
            <div class="m-row"><span class="m-cabang">{{ $m->nama_cabang ?? '-' }}</span></div>
            <div class="m-row"><i class="ti ti-map-pin"></i> {{ $m->alamat ?? '-' }}</div>
            <div class="m-row"><i class="ti ti-certificate"></i> Legalitas: {{ $m->status_legalitas ?? '-' }}</div>
          </div>
        @empty
          <div class="empty" style="grid-column:1/-1;">
            <i class="ti ti-building-mosque"></i>
            Belum ada data masjid yang disetujui.
          </div>
        @endforelse
      </div>

    </main>
  </div>
</div>
</body>
</html>
