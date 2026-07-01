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

/* ── KARTU STATISTIK KEAKTIFAN ── */
.stat-cards { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:18px; }
.stat-card {
  background:#fff; border:1px solid var(--gray-200); border-radius:12px;
  padding:16px 14px; display:flex; flex-direction:column;
  align-items:center; text-align:center; gap:2px;
}
.stat-card-icon {
  font-size:18px; width:34px; height:34px;
  display:flex; align-items:center; justify-content:center;
  border-radius:8px; margin-bottom:4px; background:var(--green-50);
}
.sc-kurang .stat-card-icon { background:#fffbeb; }
.sc-vakum  .stat-card-icon { background:#fff5f5; }
.stat-card-num   { font-size:24px; font-weight:700; line-height:1; }
.stat-card-label { font-size:11.5px; font-weight:600; }
.sc-aktif  .stat-card-icon, .sc-aktif  .stat-card-num, .sc-aktif  .stat-card-label { color:var(--green-600); }
.sc-kurang .stat-card-icon, .sc-kurang .stat-card-num, .sc-kurang .stat-card-label { color:#d97706; }
.sc-vakum  .stat-card-icon, .sc-vakum  .stat-card-num, .sc-vakum  .stat-card-label { color:#dc2626; }
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
            @forelse(($daftarCabang ?? []) as $cb)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid var(--gray-100);">
              <span style="font-size:14px;font-weight:500;color:var(--gray-800);">{{ $cb->nama }}</span>
              <span class="badge {{ $cb->badge }}">{{ strtoupper($cb->status) }}</span>
            </div>
            @empty
            <div style="padding:16px;text-align:center;color:var(--gray-400);font-size:13px;">Belum ada data cabang.</div>
            @endforelse
          </div>
        </div>

        <!-- STATUS RANTING -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Status Ranting (Keaktifan)</span>
            <a href="{{ url('/superadmin/status-ranting') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:16px 20px;">

            {{-- Visual statistik keaktifan ranting --}}
            <div class="stat-cards">
              <div class="stat-card sc-aktif">
                <div class="stat-card-icon"><i class="ti ti-circle-check"></i></div>
                <div class="stat-card-num">{{ $rantingAktif ?? 0 }}</div>
                <div class="stat-card-label">Aktif</div>
              </div>
              <div class="stat-card sc-kurang">
                <div class="stat-card-icon"><i class="ti ti-alert-triangle"></i></div>
                <div class="stat-card-num">{{ $rantingKurang ?? 0 }}</div>
                <div class="stat-card-label">Kurang Aktif</div>
              </div>
              <div class="stat-card sc-vakum">
                <div class="stat-card-icon"><i class="ti ti-alert-circle"></i></div>
                <div class="stat-card-num">{{ $rantingVakum ?? 0 }}</div>
                <div class="stat-card-label">Vakum</div>
              </div>
            </div>

            {{-- Daftar ranting --}}
            <div style="border:1px solid var(--gray-100);border-radius:10px;overflow:hidden;">
              @forelse(($daftarRanting ?? []) as $r)
              <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:1px solid var(--gray-100);">
                <span style="font-size:14px;font-weight:500;color:var(--gray-800);">{{ $r->nama }}</span>
                <span class="badge {{ $r->badge }}">{{ strtoupper($r->status) }}</span>
              </div>
              @empty
              <div style="padding:16px;text-align:center;color:var(--gray-400);font-size:13px;">Belum ada data ranting.</div>
              @endforelse
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