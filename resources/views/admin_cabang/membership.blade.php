<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Dashboard — PCM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }

/* ── STAT CARD PRESS EFFECT ── */
.stat-card {
  cursor: pointer;
  transition: transform 0.15s ease, background 0.15s ease,
              border-color 0.15s ease, box-shadow 0.15s ease;
  user-select: none;
}
.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(30,107,63,.12);
  border-color: var(--green-300);
}
.stat-card:active {
  animation: card-shake 0.3s ease;
  background: var(--green-50);
  border-color: var(--green-400);
  box-shadow: 0 2px 8px rgba(30,107,63,.15);
}
@keyframes card-shake {
  0%   { transform: rotate(0deg) scale(1); }
  20%  { transform: rotate(-1.5deg) scale(0.98); }
  40%  { transform: rotate(1.5deg) scale(0.98); }
  60%  { transform: rotate(-1deg) scale(0.99); }
  80%  { transform: rotate(0.8deg) scale(0.99); }
  100% { transform: rotate(0deg) scale(1); }
}
.stat-card.urgent:hover  { border-color: var(--gold); box-shadow: 0 6px 16px rgba(184,148,42,.15); }
.stat-card.urgent:active { background: #fef9e7; border-color: var(--gold-light); }

/* ── CARD (chart + ranting + pengajuan) PRESS EFFECT ── */
.card {
  cursor: pointer;
  transition: transform 0.15s ease, background 0.15s ease,
              border-color 0.15s ease, box-shadow 0.15s ease;
  user-select: none;
}
.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(30,107,63,.10);
  border-color: var(--green-300);
}
.card:active {
  animation: card-shake 0.3s ease;
  background: var(--green-50);
  border-color: var(--green-400);
  box-shadow: 0 2px 8px rgba(30,107,63,.12);
}
</style>
</head>

{{-- PERBAIKAN 1: hapus 
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── CHART 1: BAR — Trend Penambahan Masjid per Tahun ──
const ctx1 = document.getElementById('chartMasjid').getContext('2d');
const masjidData = {
  labels: ['2018','2019','2020','2021','2022','2023','2024','2025'],
  datasets: [{
    label: 'Jumlah Masjid',
    data: [3, 4, 5, 6, 7, 8, 9, 10],
    backgroundColor: function(ctx) {
      const i = ctx.dataIndex, total = ctx.dataset.data.length;
      return i === total - 1 ? '#1e6b3f' : 'rgba(58,170,101,0.35)';
    },
    borderRadius: 5,
    borderSkipped: false,
  }]
};
new Chart(ctx1, {
  type: 'bar',
  data: masjidData,
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1a1a2e',
        titleFont: { family: 'Inter', size: 11 },
        bodyFont: { family: 'Inter', size: 12, weight: '700' },
        callbacks: { label: ctx => ' ' + ctx.parsed.y + ' masjid' }
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd' } },
      y: { grid: { color: '#f1f3f5' }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd', stepSize: 5 }, beginAtZero: true }
    }
  }
});

// ── CHART 2: AREA — Akumulasi Wakaf Masjid ──
const ctx2 = document.getElementById('chartWakaf').getContext('2d');
const grad = ctx2.createLinearGradient(0, 0, 0, 200);
grad.addColorStop(0, 'rgba(30,107,63,0.25)');
grad.addColorStop(1, 'rgba(30,107,63,0.01)');
const wakafData = {
  labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
  datasets: [{
    label: 'Masjid Wakaf',
    data: [4, 4, 5, 5, 5, 6, 6, 6, 7, 7, 7, 7],
    borderColor: '#1e6b3f',
    borderWidth: 2,
    backgroundColor: grad,
    fill: true,
    tension: 0.4,
    pointBackgroundColor: '#1e6b3f',
    pointRadius: 3,
    pointHoverRadius: 5,
  }]
};
new Chart(ctx2, {
  type: 'line',
  data: wakafData,
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1a1a2e',
        titleFont: { family: 'Inter', size: 11 },
        bodyFont: { family: 'Inter', size: 12, weight: '700' },
        callbacks: { label: ctx => ' ' + ctx.parsed.y + ' masjid wakaf' }
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd' } },
      y: { grid: { color: '#f1f3f5' }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd', stepSize: 1 }, beginAtZero: true, min: 2 }
    }
  }
});

</script>

<script>
// Animasi progress bar PRM — jalan dari 0 ke skor
window.addEventListener('load', function() {
  setTimeout(function() {
    document.querySelectorAll('.prm-bar').forEach(function(bar) {
      bar.style.width = bar.dataset.width + '%';
    });
  }, 300);
});
</script>
</body> yang salah posisi --}}
<body class="text-gray-800 antialiased" style="background-color: #f6f8eb;">
<div class="app-shell">

  @include('admin_cabang.sidebar', ['activeNav' => 'dashboard'])

  <!-- ── MAIN ── -->
  <div class="main-shell">

    @include('admin_cabang.topbar', ['activeTopLink' => 'dashboard'])

    <!-- CONTENT -->
    <main class="page-content">

      <p style="font-size:13px;color:var(--gray-500);margin-bottom:22px;">
        Data Masjid tingkat Kecamatan.
      </p>

      <!-- STAT CARDS -->
      <div class="stat-cards">

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon">
              <i class="ti ti-building-mosque" aria-hidden="true"></i>
            </div>
            <span class="stat-pill pill-green">
              +3 dari Tahun Lalu
            </span>
          </div>
          <div class="stat-label">Total Masjid/Musholla</div>
          <div class="stat-value">{{ number_format($totalMasjid ?? 10) }}</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon">
              <i class="ti ti-certificate" aria-hidden="true"></i>
            </div>
            <span class="stat-pill pill-blue">70% dari Total</span>
          </div>
          <div class="stat-label">Wakaf Terdaftar</div>
          <div class="stat-value">{{ number_format($masjidWakaf ?? 7) }}</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon" style="background:#eff6ff;">
              <i class="ti ti-building-community" aria-hidden="true" style="color:#3b82f6;"></i>
            </div>
            <span class="stat-pill pill-blue">4 PRM</span>
          </div>
          <div class="stat-label">Jumlah Ranting</div>
          <div class="stat-value">{{ $jumlahRanting ?? 4 }}</div>
        </div>

        <div class="stat-card urgent">
          <div class="stat-card-top">
            <div class="stat-card-icon">
              <i class="ti ti-clipboard-list" aria-hidden="true"></i>
            </div>
            <span class="stat-pill pill-amber">Penting</span>
          </div>
          <div class="stat-label">Pengajuan Pending</div>
          <div class="stat-value">{{ $pengajuanPending ?? 24 }}</div>
        </div>

      </div><!-- /stat-cards -->


      <!-- CHART CARDS -->
      <div class="grid-2" style="margin-bottom:20px;">

        <!-- CARD 1: TREND PENAMBAHAN MASJID -->
        <div class="card" style="padding:0;">
          <div style="padding:18px 20px 10px;">
            <div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Trend Penambahan Masjid</div>
            <div style="font-size:26px;font-weight:700;color:var(--gray-900);line-height:1.2;">{{ $totalMasjid ?? 10 }}</div>
            <div style="font-size:12px;color:var(--green-600);font-weight:600;margin-top:3px;">
              <i class="ti ti-trending-up" style="font-size:13px;vertical-align:middle;"></i>
              +2 masjid dari tahun lalu
            </div>
          </div>
          <div style="padding:0 12px 16px;">
            <canvas id="chartMasjid" height="130"></canvas>
          </div>
          <div style="padding:0 20px 14px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:11px;color:var(--gray-400);">Data per tahun · Kota Batam</span>
            <button style="display:flex;align-items:center;gap:4px;background:none;border:1px solid var(--gray-200);border-radius:6px;padding:4px 10px;font-size:11px;color:var(--gray-600);cursor:pointer;font-family:Inter,sans-serif;">
              <i class="ti ti-download" style="font-size:12px;"></i> Unduh
            </button>
          </div>
        </div>

        <!-- CARD 2: STATUS WAKAF MASJID -->
        <div class="card" style="padding:0;">
          <div style="padding:18px 20px 10px;">
            <div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Status Wakaf Masjid</div>
            <div style="font-size:26px;font-weight:700;color:var(--gray-900);line-height:1.2;">{{ $masjidWakaf ?? 7 }} Terdaftar</div>
            <div style="font-size:12px;color:var(--green-600);font-weight:600;margin-top:3px;">
              <i class="ti ti-trending-up" style="font-size:13px;vertical-align:middle;"></i>
              +20.5% dari bulan lalu
            </div>
          </div>
          <div style="padding:0 12px 16px;">
            <canvas id="chartWakaf" height="130"></canvas>
          </div>
          <div style="padding:0 20px 14px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:11px;color:var(--gray-400);">Akumulasi wakaf · Kota Batam</span>
            <button style="display:flex;align-items:center;gap:4px;background:none;border:1px solid var(--gray-200);border-radius:6px;padding:4px 10px;font-size:11px;color:var(--gray-600);cursor:pointer;font-family:Inter,sans-serif;">
              <i class="ti ti-download" style="font-size:12px;"></i> Unduh
            </button>
          </div>
        </div>

      </div><!-- /chart cards -->

      <!-- BOTTOM TWO COLS -->
      <div class="grid-2">

        <!-- ANTRIAN PERSETUJUAN -->
        <div class="card" style="padding:0;cursor:default;">
          <div class="card-header" style="padding:18px 20px 14px;">
            <span class="card-title" style="display:flex;align-items:center;gap:8px;">
              <i class="ti ti-clock-check" style="font-size:16px;color:#b45309;"></i>
              Antrian Persetujuan
              @if(($totalPending??0) > 0)
                <span style="background:#fef3c7;color:#b45309;font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;">{{ $totalPending }} Pending</span>
              @endif
            </span>
            <a href="{{ url('/pcm/persetujuan') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:0;">
            @forelse($antrian ?? [] as $a)
            @php
              $jenis = match($a->jenis_pengajuan ?? '') {
                'tambah_masjid' => 'Pendaftaran Masjid Baru',
                'edit_masjid'   => 'Perubahan Data Masjid',
                default         => ucwords(str_replace('_',' ',$a->jenis_pengajuan ?? 'Pengajuan'))
              };
              $tgl = $a->created_at ? \Carbon\Carbon::parse($a->created_at)->diffForHumans() : '-';
            @endphp
            <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid var(--gray-100);gap:12px;">
              <div style="display:flex;align-items:center;gap:12px;min-width:0;">
                <span style="width:36px;height:36px;border-radius:10px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                  <i class="ti ti-building-mosque" style="font-size:16px;color:#b45309;"></i>
                </span>
                <div style="min-width:0;">
                  <div style="font-size:13px;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $a->nama_masjid }}</div>
                  <div style="font-size:11px;color:var(--gray-500);margin-top:1px;">{{ $jenis }} · {{ $a->nama_ranting ?? '-' }}</div>
                </div>
              </div>
              <div style="display:flex;flex-direction:column;align-items:flex-end;gap:3px;flex-shrink:0;">
                <span style="font-size:11px;font-weight:700;color:#b45309;background:#fef3c7;padding:2px 8px;border-radius:99px;">PENDING</span>
                <span style="font-size:10px;color:var(--gray-400);">{{ $tgl }}</span>
              </div>
            </div>
            @empty
            <div style="padding:32px 20px;text-align:center;color:var(--gray-400);">
              <i class="ti ti-circle-check" style="font-size:32px;color:#22c55e;display:block;margin-bottom:8px;"></i>
              <div style="font-size:13px;font-weight:500;">Tidak ada antrian persetujuan</div>
              <div style="font-size:12px;margin-top:4px;">Semua pengajuan sudah diproses</div>
            </div>
            @endforelse
          </div>
        </div><!-- /antrian persetujuan -->

        <!-- MASJID BARU TERDAFTAR -->
        <div class="card" style="padding:0;cursor:default;">
          <div class="card-header" style="padding:18px 20px 14px;">
            <span class="card-title" style="display:flex;align-items:center;gap:8px;">
              <i class="ti ti-building-mosque" style="font-size:16px;color:var(--green-600);"></i>
              Masjid Baru Terdaftar
            </span>
            <a href="{{ url('/pcm/sub-branches') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:0;">
            @forelse($masjidBaru ?? [] as $mb)
            @php
              $tipeIcon  = $mb->tipe === 'Musholla' ? 'ti-home' : 'ti-building-mosque';
              $tipeBadge = $mb->tipe === 'Musholla' ? '#ede9fe' : '#dcfce7';
              $tipeClr   = $mb->tipe === 'Musholla' ? '#7c3aed'  : '#15803d';
            @endphp
            <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid var(--gray-100);gap:12px;">
              <div style="display:flex;align-items:center;gap:12px;min-width:0;">
                <span style="width:36px;height:36px;border-radius:10px;background:{{ $tipeBadge }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                  <i class="ti {{ $tipeIcon }}" style="font-size:16px;color:{{ $tipeClr }};"></i>
                </span>
                <div style="min-width:0;">
                  <div style="font-size:13px;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $mb->nama_masjid }}</div>
                  <div style="font-size:11px;color:var(--gray-500);margin-top:1px;">{{ $mb->nama_ranting ?? '-' }} · {{ $mb->kecamatan ?? 'Batam' }}</div>
                </div>
              </div>
              <span style="font-size:11px;font-weight:700;color:{{ $tipeClr }};background:{{ $tipeBadge }};padding:2px 8px;border-radius:99px;flex-shrink:0;">{{ strtoupper($mb->tipe ?? 'MASJID') }}</span>
            </div>
            @empty
            <div style="padding:32px 20px;text-align:center;color:var(--gray-400);">
              <i class="ti ti-building-mosque" style="font-size:32px;display:block;margin-bottom:8px;"></i>
              <div style="font-size:13px;font-weight:500;">Belum ada masjid terdaftar</div>
            </div>
            @endforelse
          </div>
        </div><!-- /masjid baru -->

      </div><!-- /grid-2 -->


    </main>
  </div><!-- /main-shell -->
</div><!-- /app-shell -->




<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── CHART 1: BAR — Trend Penambahan Masjid per Tahun ──
const ctx1 = document.getElementById('chartMasjid').getContext('2d');
const masjidData = {
  labels: ['2018','2019','2020','2021','2022','2023','2024','2025'],
  datasets: [{
    label: 'Jumlah Masjid',
    data: [8, 10, 11, 13, 15, 17, 19, 22],
    backgroundColor: function(ctx) {
      const i = ctx.dataIndex, total = ctx.dataset.data.length;
      return i === total - 1 ? '#1e6b3f' : 'rgba(58,170,101,0.35)';
    },
    borderRadius: 5,
    borderSkipped: false,
  }]
};
new Chart(ctx1, {
  type: 'bar',
  data: masjidData,
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1a1a2e',
        titleFont: { family: 'Inter', size: 11 },
        bodyFont: { family: 'Inter', size: 12, weight: '700' },
        callbacks: { label: ctx => ' ' + ctx.parsed.y + ' masjid' }
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd' } },
      y: { grid: { color: '#f1f3f5' }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd', stepSize: 5 }, beginAtZero: true }
    }
  }
});

// ── CHART 2: AREA — Akumulasi Wakaf Masjid ──
const ctx2 = document.getElementById('chartWakaf').getContext('2d');
const grad = ctx2.createLinearGradient(0, 0, 0, 200);
grad.addColorStop(0, 'rgba(30,107,63,0.25)');
grad.addColorStop(1, 'rgba(30,107,63,0.01)');
const wakafData = {
  labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
  datasets: [{
    label: 'Masjid Wakaf',
    data: [10, 10, 11, 11, 12, 13, 13, 14, 15, 15, 16, 17],
    borderColor: '#1e6b3f',
    borderWidth: 2,
    backgroundColor: grad,
    fill: true,
    tension: 0.4,
    pointBackgroundColor: '#1e6b3f',
    pointRadius: 3,
    pointHoverRadius: 5,
  }]
};
new Chart(ctx2, {
  type: 'line',
  data: wakafData,
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1a1a2e',
        titleFont: { family: 'Inter', size: 11 },
        bodyFont: { family: 'Inter', size: 12, weight: '700' },
        callbacks: { label: ctx => ' ' + ctx.parsed.y + ' masjid wakaf' }
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd' } },
      y: { grid: { color: '#f1f3f5' }, ticks: { font: { family: 'Inter', size: 11 }, color: '#adb5bd', stepSize: 4 }, beginAtZero: false, min: 8 }
    }
  }
});
</script>

<script>
// Animasi progress bar PRM — jalan dari 0 ke skor
window.addEventListener('load', function() {
  setTimeout(function() {
    document.querySelectorAll('.prm-bar').forEach(function(bar) {
      bar.style.width = bar.dataset.width + '%';
    });
  }, 300);
});
</script>
</body>
</html>