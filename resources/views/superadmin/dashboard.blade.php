<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Dashboard Superadmin — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }

/* ── CARD SHAKE ── */
.sa-stat-card {
  cursor: pointer;
  transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
  user-select: none;
  overflow: visible !important;
}
.sa-stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(30,107,63,.13);
  border-color: #6ee7a0;
}
</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'dashboard'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'dashboard'])

    <main class="page-content">

      <!-- PAGE HEADER -->
      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Dashboard Superadmin</h1>
          <p>Monitoring menyeluruh PDM Muhammadiyah Kota Batam</p>
        </div>
      </div>

      <!-- STAT CARDS -->
      <div class="stat-cards" style="margin-bottom:20px;">

        <div class="stat-card sa-stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-users-group"></i></div>
            <span class="stat-pill pill-green">+20 Bulan Ini</span>
          </div>
          <div class="stat-label">Total Anggota</div>
          <div class="stat-value">{{ number_format($total_user ?? 100) }}</div>
        </div>

        <div class="stat-card sa-stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-building-community"></i></div>
            <span class="stat-pill pill-blue">{{ $total_cabang ?? 12 }} Aktif</span>
          </div>
          <div class="stat-label">Cabang (PCM)</div>
          <div class="stat-value">{{ $total_cabang ?? 12 }}</div>
        </div>

        <div class="stat-card sa-stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-home-2"></i></div>
            <span class="stat-pill pill-blue">{{ $total_ranting ?? 36 }} PRM</span>
          </div>
          <div class="stat-label">Ranting (PRM)</div>
          <div class="stat-value">{{ $total_ranting ?? 36 }}</div>
        </div>

        <div class="stat-card sa-stat-card urgent">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-clipboard-list"></i></div>
            <span class="stat-pill pill-amber">Penting</span>
          </div>
          <div class="stat-label">Antrian ACC</div>
          <div class="stat-value">9</div>
        </div>

      </div>

      <!-- BOTTOM: STATUS CABANG + ANTRIAN -->
      <div class="grid-2">

        <!-- STATUS CABANG -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Status Cabang (Kecamatan)</span>
            <a href="{{ url('/superadmin/status-cabang') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:0;">
            @php
            $demoCabang = [
              ['nama' => 'Batu Aji',        'status' => 'Aktif',        'color' => '#22c55e', 'badge' => 'badge-aktif'],
              ['nama' => 'Batu Ampar',       'status' => 'Aktif',        'color' => '#22c55e', 'badge' => 'badge-aktif'],
              ['nama' => 'Belakang Padang',  'status' => 'Kurang Aktif', 'color' => '#f59e0b', 'badge' => 'badge-kurang'],
              ['nama' => 'Nongsa',           'status' => 'Aktif',        'color' => '#22c55e', 'badge' => 'badge-aktif'],
              ['nama' => 'Sagulung',         'status' => 'Vakum',        'color' => '#ef4444', 'badge' => 'badge-vakum'],
            ];
            @endphp
            @foreach($demoCabang as $cb)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid var(--gray-100);">
              <span style="font-size:14px;font-weight:500;color:var(--gray-800);">{{ $cb['nama'] }}</span>
              <span class="badge {{ $cb['badge'] }}">{{ strtoupper($cb['status']) }}</span>
            </div>
            @endforeach
          </div>
        </div>

        <!-- ANTRIAN PERSETUJUAN -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Antrian Persetujuan</span>
            <a href="{{ url('/superadmin/persetujuan') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:0;">
            @php
            $demoAntrian = [
              ['nama' => 'Perubahan Takmir Masjid Agung', 'tipe' => 'Cabang',  'status' => 'Menunggu', 'sc' => '#b45309'],
              ['nama' => 'Pendaftaran Musholla An-Nur',   'tipe' => 'Ranting', 'status' => 'Menunggu', 'sc' => '#b45309'],
              ['nama' => 'Sertifikat Wakaf AIW',          'tipe' => 'Masjid',  'status' => 'Disetujui','sc' => '#15803d'],
            ];
            @endphp
            @foreach($demoAntrian as $a)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid var(--gray-100);">
              <div>
                <div style="font-size:13px;font-weight:600;color:var(--gray-800);">{{ $a['nama'] }}</div>
                <div style="font-size:11px;color:var(--gray-400);margin-top:2px;">{{ $a['tipe'] }}</div>
              </div>
              <span style="font-size:11px;font-weight:700;letter-spacing:.04em;color:{{ $a['sc'] }};">{{ strtoupper($a['status']) }}</span>
            </div>
            @endforeach
            <div style="padding:14px 20px;">
              <a href="{{ url('/superadmin/persetujuan') }}" style="display:flex;align-items:center;justify-content:center;gap:6px;padding:10px;border:1px solid var(--gray-200);border-radius:8px;font-size:13px;font-weight:600;color:var(--gray-600);text-decoration:none;transition:background .15s;">
                Lihat Semua Pengajuan <i class="ti ti-arrow-right" style="font-size:14px;"></i>
              </a>
            </div>
          </div>
        </div>

      </div>

    </main>
  </div>
</div>

<script>
function applyShake(el) {
  el.style.background = '#d6f0e0';
  el.style.borderColor = '#2d8a55';
  const frames = [
    {transform:'translateX(0px)'},{transform:'translateX(-6px)'},
    {transform:'translateX(6px)'},{transform:'translateX(-5px)'},
    {transform:'translateX(5px)'},{transform:'translateX(-3px)'},
    {transform:'translateX(3px)'},{transform:'translateX(0px)'},
  ];
  const anim = el.animate(frames, {duration:450, easing:'ease-in-out'});
  anim.onfinish = () => { el.style.background=''; el.style.borderColor=''; };
}
document.querySelectorAll('.sa-stat-card, .card').forEach(c => {
  c.addEventListener('mousedown', () => applyShake(c));
});
</script>
</body>
</html>