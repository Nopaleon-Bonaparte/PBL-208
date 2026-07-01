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

/* ── Kartu atas lebih ringkas agar 4 muat 1 baris ── */
.stat-cards { grid-template-columns: repeat(4, 1fr) !important; gap: 14px !important; }
.sa-stat-card { padding: 14px 16px !important; }
.sa-stat-card .stat-value { font-size: 24px; }
.sa-stat-card .stat-card-icon { width: 34px; height: 34px; }
.sa-stat-card .stat-card-icon i { font-size: 17px; }

/* ── Chart cards ── */
.chart-card { background:#fff; border:1px solid var(--gray-200); border-radius:14px; padding:20px 22px; }
.chart-title { font-size:12px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:var(--gray-400); }
.chart-big { font-size:26px; font-weight:800; color:var(--gray-900); margin-top:2px; }
.chart-delta { font-size:13px; font-weight:600; color:var(--green-600); margin:4px 0 6px; display:flex; align-items:center; gap:5px; }
.chart-foot { font-size:11.5px; color:var(--gray-400); margin-top:8px; }

/* ── Tooltip interaktif chart ── */
.chart-card { position: relative; }
.chart-tip {
  position: absolute; pointer-events: none; z-index: 20;
  background: #1f2937; color: #fff; font-size: 12px; font-weight: 600;
  padding: 6px 10px; border-radius: 8px; white-space: nowrap;
  transform: translate(-50%, -120%); opacity: 0; transition: opacity .12s;
  box-shadow: 0 4px 12px rgba(0,0,0,.18);
}
.chart-tip::after {
  content: ''; position: absolute; left: 50%; top: 100%;
  transform: translateX(-50%); border: 5px solid transparent; border-top-color: #1f2937;
}
.chart-tip.show { opacity: 1; }
.chart-tip .tip-sub { font-weight: 500; color: #cbd5e1; font-size: 10.5px; }
.bar-hit, .dot-hit { cursor: pointer; }
.bar-el { transition: fill .12s; }

/* ── Animasi masuk chart ── */
@keyframes barGrow { from { transform: scaleY(0); } to { transform: scaleY(1); } }
.bar-el { transform-origin: bottom; transform-box: fill-box; animation: barGrow .7s cubic-bezier(.22,1,.36,1) both; }
#trendSvg .bar-el:nth-of-type(1){animation-delay:.05s}
#trendSvg .bar-el:nth-of-type(2){animation-delay:.11s}
#trendSvg .bar-el:nth-of-type(3){animation-delay:.17s}
#trendSvg .bar-el:nth-of-type(4){animation-delay:.23s}
#trendSvg .bar-el:nth-of-type(5){animation-delay:.29s}
#trendSvg .bar-el:nth-of-type(6){animation-delay:.35s}
#trendSvg .bar-el:nth-of-type(7){animation-delay:.41s}
#trendSvg .bar-el:nth-of-type(8){animation-delay:.47s}

@keyframes lineDraw { to { stroke-dashoffset: 0; } }
.wakaf-line { stroke-dasharray: 1400; stroke-dashoffset: 1400; animation: lineDraw 1.4s ease-out .2s forwards; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
.wakaf-area { opacity: 0; animation: fadeIn .9s ease-out .8s forwards; }
.wakaf-dot  { opacity: 0; animation: fadeIn .3s ease-out forwards; }

/* ── Animasi progress bar status ranting ── */
@keyframes fillGrow { from { width: 0 !important; } }
.pr-fill { animation: fillGrow 1s cubic-bezier(.22,1,.36,1) both; }

/* ── Progress bar (status ranting) ── */
.pr-row { padding:14px 0; border-bottom:1px solid var(--gray-100); }
.pr-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
.pr-name { font-size:14px; font-weight:600; color:var(--gray-800); }
.pr-num  { font-size:15px; font-weight:700; color:var(--gray-500); }
.pr-bar  { height:9px; background:var(--gray-100); border-radius:999px; overflow:hidden; }
.pr-fill { height:100%; border-radius:999px; }
.pf-green  { background:var(--green-500); }
.pf-yellow { background:#f59e0b; }
.pf-red    { background:#ef4444; }
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
          <div class="stat-label">Pengajuan Pending</div>
          <div class="stat-value">{{ $pengajuan_pending ?? 0 }}</div>
        </div>

      </div>

      <!-- ROW: CHARTS (Trend Masjid + Status Wakaf) -->
      <div class="grid-2" style="margin-bottom:20px;">

        <!-- TREND PENAMBAHAN MASJID -->
        <div class="chart-card" id="trendCard">
          <div class="chart-title">Trend Penambahan Masjid</div>
          <div class="chart-big">{{ $total_masjid ?? 0 }}</div>
          <div class="chart-delta"><i class="ti ti-trending-up"></i> +2 masjid dari tahun lalu</div>
          <div class="chart-tip" id="trendTip"></div>
          <svg viewBox="0 0 480 220" width="100%" height="200" preserveAspectRatio="xMidYMid meet" id="trendSvg">
            @php
              $maxT = max($trenNilai ?: [1]); $maxT = $maxT < 5 ? 25 : ceil($maxT/5)*5;
              $n = count($trenNilai); $bw = 40; $gap = (480 - 40 - $n*$bw) / max($n-1,1); $x0 = 30;
            @endphp
            @for($i=0;$i<=5;$i++)
              @php $gy = 20 + (170*($i/5)); $val = round($maxT*(1-$i/5)); @endphp
              <line x1="30" y1="{{ $gy }}" x2="470" y2="{{ $gy }}" stroke="#eef0f2" stroke-width="1"/>
              <text x="24" y="{{ $gy+4 }}" text-anchor="end" font-size="9" fill="#9ca3af">{{ $val }}</text>
            @endfor
            @foreach($trenNilai as $k => $v)
              @php
                $h = 170 * ($v / $maxT); $x = $x0 + $k*($bw+$gap); $y = 20 + (170 - $h);
                $last = $k === $n-1;
              @endphp
              <rect class="bar-el" x="{{ $x }}" y="{{ $y }}" width="{{ $bw }}" height="{{ $h }}" rx="4"
                    fill="{{ $last ? '#1e6b3f' : '#c7e3d2' }}"/>
              {{-- hit area transparan (dari atas grafik) untuk hover mudah --}}
              <rect class="bar-hit" x="{{ $x }}" y="20" width="{{ $bw }}" height="170" fill="transparent"
                    data-label="{{ $trenTahun[$k] }}" data-value="{{ $v }}"
                    data-cx="{{ $x + $bw/2 }}" data-cy="{{ $y }}"></rect>
              <text x="{{ $x + $bw/2 }}" y="205" text-anchor="middle" font-size="9" fill="#9ca3af">{{ $trenTahun[$k] }}</text>
            @endforeach
          </svg>
          <div class="chart-foot">Data per tahun · Kota Batam</div>
        </div>

        <!-- STATUS WAKAF MASJID -->
        <div class="chart-card" id="wakafCard">
          <div class="chart-title">Status Wakaf Masjid</div>
          <div class="chart-big">{{ $masjid_terdaftar ?? 0 }} Terdaftar</div>
          <div class="chart-delta"><i class="ti ti-trending-up"></i> +20.5% dari bulan lalu</div>
          <div class="chart-tip" id="wakafTip"></div>
          <svg viewBox="0 0 480 220" width="100%" height="200" preserveAspectRatio="xMidYMid meet" id="wakafSvg">
            @php
              $wak = [10,10,11,11,12,13,13,14,15,15,16,17];
              $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
              $wmin=8; $wmax=20; $wn=count($wak); $wx0=34; $wstep=(470-$wx0)/($wn-1);
              $pts=''; $area="{$wx0},190 ";
              foreach($wak as $i=>$v){ $px=$wx0+$i*$wstep; $py=20+170*(1-(($v-$wmin)/($wmax-$wmin))); $pts.="{$px},{$py} "; $area.="{$px},{$py} "; }
              $area.=(($wx0+($wn-1)*$wstep)).',190';
            @endphp
            @for($i=0;$i<=3;$i++)
              @php $gy=20+(170*($i/3)); $val=round($wmax-($wmax-$wmin)*($i/3)); @endphp
              <line x1="30" y1="{{ $gy }}" x2="470" y2="{{ $gy }}" stroke="#eef0f2" stroke-width="1"/>
              <text x="24" y="{{ $gy+4 }}" text-anchor="end" font-size="9" fill="#9ca3af">{{ $val }}</text>
            @endfor
            <polygon class="wakaf-area" points="{{ $area }}" fill="#e8f3ec"/>
            <polyline class="wakaf-line" points="{{ $pts }}" fill="none" stroke="#1e6b3f" stroke-width="2.5"/>
            @foreach($wak as $i=>$v)
              @php $px=$wx0+$i*$wstep; $py=20+170*(1-(($v-$wmin)/($wmax-$wmin))); @endphp
              <circle class="wakaf-dot" cx="{{ $px }}" cy="{{ $py }}" r="3" fill="#1e6b3f" style="animation-delay:{{ 0.9 + $i*0.05 }}s"/>
              {{-- hit area lingkaran besar transparan untuk hover --}}
              <circle class="dot-hit" cx="{{ $px }}" cy="{{ $py }}" r="14" fill="transparent"
                      data-label="{{ $bulan[$i] }}" data-value="{{ $v }}"
                      data-cx="{{ $px }}" data-cy="{{ $py }}"></circle>
              <text x="{{ $px }}" y="210" text-anchor="middle" font-size="8.5" fill="#9ca3af">{{ $bulan[$i] }}</text>
            @endforeach
          </svg>
          <div class="chart-foot">Akumulasi wakaf · Kota Batam</div>
        </div>

      </div>

      <!-- ROW: STATUS RANTING (progress) + STATUS CABANG -->
      <div class="grid-2">

        <!-- STATUS RANTING (PRM) -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Status Ranting (PRM)</span>
            <a href="{{ url('/superadmin/status-ranting') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:6px 20px 14px;">
            @forelse(($daftarRanting ?? []) as $r)
              @php $cls = $r->skor >= 70 ? 'pf-green' : ($r->skor >= 50 ? 'pf-yellow' : 'pf-red'); @endphp
              <div class="pr-row">
                <div class="pr-head">
                  <span class="pr-name">{{ $r->nama }}</span>
                  <span class="pr-num">{{ $r->skor }}</span>
                </div>
                <div class="pr-bar"><div class="pr-fill {{ $cls }}" style="width:{{ $r->skor }}%;"></div></div>
              </div>
            @empty
              <div style="padding:20px;text-align:center;color:var(--gray-400);font-size:13px;">Belum ada data ranting.</div>
            @endforelse
          </div>
        </div>

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
document.querySelectorAll('.sa-stat-card, .card, .chart-card').forEach(c => {
  c.addEventListener('mousedown', () => applyShake(c));
});

// ── Tooltip interaktif untuk chart (hover & touch) ──
function setupChart(svgId, tipId, cardId, unit) {
  const svg  = document.getElementById(svgId);
  const tip  = document.getElementById(tipId);
  const card = document.getElementById(cardId);
  if (!svg || !tip || !card) return;

  function showTip(el) {
    const label = el.getAttribute('data-label');
    const value = el.getAttribute('data-value');
    const cx = parseFloat(el.getAttribute('data-cx'));
    const cy = parseFloat(el.getAttribute('data-cy'));
    // konversi koordinat viewBox (0..480 / 0..220) ke posisi piksel dalam card
    const rect = svg.getBoundingClientRect();
    const cardRect = card.getBoundingClientRect();
    const px = rect.left - cardRect.left + (cx / 480) * rect.width;
    const py = rect.top  - cardRect.top  + (cy / 220) * rect.height;
    tip.style.left = px + 'px';
    tip.style.top  = py + 'px';
    tip.innerHTML = '<div>' + value + ' ' + unit + '</div><div class="tip-sub">' + label + '</div>';
    tip.classList.add('show');
  }
  function hideTip() { tip.classList.remove('show'); }

  svg.querySelectorAll('.bar-hit, .dot-hit').forEach(hit => {
    hit.addEventListener('mouseenter', () => showTip(hit));
    hit.addEventListener('mouseleave', hideTip);
    hit.addEventListener('touchstart', (e) => { e.preventDefault(); showTip(hit); }, {passive:false});
    hit.addEventListener('touchend', () => setTimeout(hideTip, 1200));
  });
}
setupChart('trendSvg', 'trendTip', 'trendCard', 'masjid');
setupChart('wakafSvg', 'wakafTip', 'wakafCard', 'terdaftar');
</script>
</body>
</html>