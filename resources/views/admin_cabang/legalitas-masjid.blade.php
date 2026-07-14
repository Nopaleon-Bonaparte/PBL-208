<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Data Masjid & Musholla — PCM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>

/* ── SHAKE ON PRESS ── */
.stat-strip-card, .masjid-card, .card {
  cursor: pointer;
  overflow: visible !important;
  transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease, background 0.15s ease;
  user-select: none;
  will-change: transform;
}
.stat-strip-card:hover, .masjid-card:hover, .card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(30,107,63,.15);
  border-color: var(--green-400);
}
.stat-strip-card.shaking, .masjid-card.shaking, .card.shaking {
  animation: card-shake 0.35s ease;
  background: #d6f0e0 !important;
  border-color: var(--green-500) !important;
  box-shadow: 0 4px 14px rgba(30,107,63,.22) !important;
}
.stat-strip-card.warn.shaking { background: #fef9e7 !important; border-color: var(--gold) !important; }
@keyframes card-shake {
  0%   { transform: rotate(0deg) scale(1); }
  20%  { transform: rotate(-2deg) scale(0.97); }
  40%  { transform: rotate(2deg) scale(0.97); }
  60%  { transform: rotate(-1.2deg) scale(0.99); }
  80%  { transform: rotate(1deg) scale(0.99); }
  100% { transform: rotate(0deg) scale(1); }
}
  body { font-family: 'Inter', sans-serif; background: #f6f8eb; }

  /* PAGE HEADER */
  .legal-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 16px; }
  .legal-header-left h1 { font-size: 24px; font-weight: 700; color: var(--gray-900); }
  .legal-header-left p  { font-size: 13px; color: var(--gray-500); margin-top: 4px; }

  /* STAT STRIP */
  .stat-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
  .stat-strip-card {
    background: #fff; border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg); padding: 16px 18px;
    display: flex; align-items: center; justify-content: space-between;
  }
  .stat-strip-card.warn { border-color: var(--gold); }
  .stat-strip-left .stat-strip-lbl { font-size: 10px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 6px; }
  .stat-strip-left .stat-strip-val { font-size: 28px; font-weight: 700; color: var(--gray-900); line-height: 1; }
  .stat-strip-left .stat-strip-sub { font-size: 11px; color: var(--gray-500); margin-top: 4px; }
  .stat-strip-left .stat-strip-sub.warn-text { color: var(--gold); font-weight: 600; }
  .stat-strip-icon { width: 40px; height: 40px; border-radius: var(--radius-md); background: var(--green-50); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .stat-strip-icon i { font-size: 22px; color: var(--green-600); }
  .stat-strip-card.warn .stat-strip-icon { background: #fef9e7; }
  .stat-strip-card.warn .stat-strip-icon i { color: var(--gold); }

  /* FILTER BAR */
  .filter-wrap {
    background: #fff; border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg); padding: 10px 14px;
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 20px; flex-wrap: nowrap; padding-left: 32px;
  }
  .filter-search-box {
    display: flex; align-items: center; gap: 8px;
    border: 1px solid var(--gray-300); border-radius: var(--radius-sm);
    padding: 7px 12px; width: 200px; flex-shrink: 0; background: #fff;
  }
  .filter-search-box i { color: var(--gray-400); font-size: 15px; }
  .filter-search-box input { border: none; outline: none; font-size: 13px; color: var(--gray-700); background: none; width: 100%; font-family: inherit; }
  .filter-select {
    padding: 7px 10px; border: 1px solid var(--gray-300); border-radius: var(--radius-sm);
    font-size: 12px; color: var(--gray-600); background: #fff; cursor: pointer;
    font-family: inherit; width: auto; flex-shrink: 0;
  }
  .filter-select:focus { outline: none; border-color: var(--green-500); }

  /* MASJID GRID */
  .masjid-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }

  .masjid-card {
    background: #fff; border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg); overflow: hidden;
    transition: box-shadow .15s;
    position: relative;
  }
  .masjid-card:hover { box-shadow: var(--shadow-md); }

  /* bottom accent bar */
  .masjid-card::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0;
    height: 3px; background: var(--green-500);
  }
  .masjid-card.incomplete::after { background: var(--gold); }

  .masjid-card-head { padding: 14px 16px 10px; display: flex; align-items: flex-start; gap: 12px; }
  .masjid-card-icon {
    width: 42px; height: 42px; border-radius: var(--radius-md);
    background: var(--green-50); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
  }
  .masjid-card-icon i { font-size: 22px; color: var(--green-600); }
  .masjid-card-icon.musholla { background: #e0f2fe; }
  .masjid-card-icon.musholla i { color: #0369a1; }
  .masjid-card-title { font-size: 15px; font-weight: 700; color: var(--gray-900); margin-bottom: 3px; }
  .masjid-card-badges { display: flex; gap: 6px; flex-wrap: wrap; }
  .masjid-type-badge {
    font-size: 10px; font-weight: 700; padding: 2px 8px;
    border-radius: 4px; text-transform: uppercase; letter-spacing: .04em;
  }
  .type-masjid   { background: var(--green-50); color: var(--green-800); }
  .type-musholla { background: #e0f2fe; color: #0369a1; }
  .masjid-loc { font-size: 12px; color: var(--gray-500); display: flex; align-items: center; gap: 4px; margin-top: 4px; }
  .masjid-loc i { font-size: 12px; }
  .status-badge {
    margin-left: auto; flex-shrink: 0;
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; white-space: nowrap; align-self: flex-start;
  }
  .sb-wakaf       { background: var(--green-100); color: var(--green-800); }
  .sb-proses      { background: #fef9c3; color: #854d0e; }
  .sb-belum       { background: var(--red-bg); color: var(--red-text); }

  .masjid-stats {
    display: grid; grid-template-columns: repeat(3, 1fr);
    border-top: 1px solid var(--gray-100);
    border-bottom: 1px solid var(--gray-100);
  }
  .masjid-stat-item { padding: 10px 14px; text-align: center; border-right: 1px solid var(--gray-100); }
  .masjid-stat-item:last-child { border-right: none; }
  .msi-lbl { font-size: 10px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
  .msi-val { font-size: 18px; font-weight: 700; color: var(--gray-800); }

  .masjid-card-footer {
    padding: 10px 16px; display: flex; align-items: center; justify-content: space-between;
  }
  .masjid-actions { display: flex; gap: 14px; }
  .masjid-action-link { font-size: 13px; font-weight: 600; color: var(--green-700); text-decoration: none; cursor: pointer; }
  .masjid-action-link:hover { text-decoration: underline; }
  .completeness-txt { font-size: 12px; font-weight: 700; }
  .completeness-txt.ok   { color: var(--green-600); }
  .completeness-txt.warn { color: var(--gold); }

  /* PAGINATION */
  .pagination-wrap {
    display: flex; align-items: center; justify-content: space-between;
    padding: 4px 0; font-size: 13px; color: var(--gray-600);
  }
  .pagination-pages { display: flex; gap: 4px; }
  .page-btn {
    width: 32px; height: 32px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; cursor: pointer;
    border: 1px solid var(--gray-200); background: #fff; color: var(--gray-700);
    transition: all .15s;
  }
  .page-btn:hover { border-color: var(--green-400); color: var(--green-700); }
  .page-btn.active { background: var(--green-700); border-color: var(--green-700); color: #fff; }
  .page-btn.arrow { font-size: 16px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_cabang.sidebar', ['activeNav' => 'legal-status'])

  <div class="main-shell">
    @include('admin_cabang.topbar', ['activeTopLink' => 'legal-status'])

    <main class="page-content">

      <!-- BREADCRUMB -->
      <div class="breadcrumb">
        <a href="{{ url('/pcm/membership') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="current">Data Masjid & Musholla</span>
      </div>

      <!-- HEADER -->
      <div class="legal-header">
        <div class="legal-header-left">
          <h1>Manajemen Masjid & Musholla</h1>
          <p>Kelola data inventaris dan legalitas tempat ibadah di wilayah cabang.</p>
        </div>
        <a href="{{ url('/pcm/sub-branches') }}" class="btn btn-primary">
          <i class="ti ti-plus"></i> Tambah Data Masjid
        </a>
      </div>

      <!-- STAT STRIP -->
      <div class="stat-strip">
        <div class="stat-strip-card">
          <div class="stat-strip-left">
            <div class="stat-strip-lbl">Total di Cabang</div>
            <div class="stat-strip-val">{{ $totalMasjid ?? 10 }}</div>
            <div class="stat-strip-sub">Tersebar di 5 Kelurahan</div>
          </div>
          <div class="stat-strip-icon"><i class="ti ti-building"></i></div>
        </div>
        <div class="stat-strip-card">
          <div class="stat-strip-left">
            <div class="stat-strip-lbl">Masjid</div>
            <div class="stat-strip-val">{{ $totalJenisM ?? 17 }}</div>
            <div class="stat-strip-sub">Kapasitas &gt; 100 jamaah</div>
          </div>
          <div class="stat-strip-icon"><i class="ti ti-building-mosque"></i></div>
        </div>
        <div class="stat-strip-card">
          <div class="stat-strip-left">
            <div class="stat-strip-lbl">Musholla</div>
            <div class="stat-strip-val">{{ $totalJenisMu ?? 5 }}</div>
            <div class="stat-strip-sub">Fokus pada jamaah lingkungan</div>
          </div>
          <div class="stat-strip-icon"><i class="ti ti-home"></i></div>
        </div>
        <div class="stat-strip-card warn">
          <div class="stat-strip-left">
            <div class="stat-strip-lbl">Data Belum Lengkap</div>
            <div class="stat-strip-val">{{ $totalBelumLengkap ?? 4 }}</div>
            <div class="stat-strip-sub warn-text">Butuh perhatian admin</div>
          </div>
          <div class="stat-strip-icon"><i class="ti ti-alert-triangle"></i></div>
        </div>
      </div>

      <!-- FILTER -->
      <div class="filter-wrap">
        <div class="filter-search-box">
          <i class="ti ti-search"></i>
          <input type="text" id="searchInput" placeholder="Cari Nama Masjid..." oninput="filterCards()"/>
        </div>
        <select class="filter-select" id="filterKelurahan" onchange="filterCards()">
          <option value="">Semua Kelurahan</option>
          <option value="batam-kota">Batam Kota</option>
          <option value="belian">Belian</option>
          <option value="teluk-tering">Teluk Tering</option>
          <option value="sukajadi">Sukajadi</option>
          <option value="sungai-panas">Sungai Panas</option>
          <option value="tanjung-uma">Tanjung Uma</option>
          <option value="baloi-permai">Baloi Permai</option>
          <option value="bengkong-laut">Bengkong Laut</option>
          <option value="bukit-jodoh">Bukit Jodoh</option>
          <option value="tanjung-uncang">Tanjung Uncang</option>
        </select>
        <select class="filter-select" id="filterTipe" onchange="filterCards()">
          <option value="">Tipe: Semua</option>
          <option value="masjid">Masjid</option>
          <option value="musholla">Musholla</option>
        </select>
        <select class="filter-select" id="filterWakaf" onchange="filterCards()">
          <option value="">Status Wakaf</option>
          <option value="wakaf">Wakaf</option>
          <option value="proses-wakaf">Proses Wakaf</option>
          <option value="belum-wakaf">Belum Wakaf</option>
        </select>
        <select class="filter-select" id="filterData" onchange="filterCards()">
          <option value="">Status Data</option>
          <option value="lengkap">Data Lengkap</option>
          <option value="belum-lengkap">Belum Lengkap</option>
        </select>
      </div>

      <!-- MASJID GRID -->
      <div class="masjid-grid" id="masjidGrid">

        @forelse($daftarMasjid ?? [] as $m)
        @php
          $isLengkap  = ($m->kelengkapan_data ?? 100) >= 100;
          $tipe       = strtolower($m->tipe ?? 'masjid');
          $wakafSlug  = Str::slug($m->status_wakaf ?? 'belum-wakaf');
          $sbClass    = match($m->status_wakaf ?? '') {
            'Wakaf'        => 'sb-wakaf',
            'Proses Wakaf' => 'sb-proses',
            default        => 'sb-belum'
          };
          $pct = $m->kelengkapan_data ?? 100;
        @endphp
        <div class="masjid-card {{ $isLengkap ? '' : 'incomplete' }}"
             data-nama="{{ strtolower($m->nama_masjid) }}"
             data-tipe="{{ $tipe }}"
             data-wakaf="{{ $wakafSlug }}"
             data-data="{{ $isLengkap ? 'lengkap' : 'belum-lengkap' }}">
          <div class="masjid-card-head">
            <div class="masjid-card-icon {{ $tipe === 'musholla' ? 'musholla' : '' }}">
              <i class="ti {{ $tipe === 'musholla' ? 'ti-home' : 'ti-building-mosque' }}"></i>
            </div>
            <div style="flex:1;min-width:0;">
              <div class="masjid-card-title">{{ $m->nama_masjid }}</div>
              <div class="masjid-card-badges">
                <span class="masjid-type-badge {{ $tipe === 'musholla' ? 'type-musholla' : 'type-masjid' }}">
                  {{ strtoupper($tipe) }}
                </span>
              </div>
              <div class="masjid-loc"><i class="ti ti-map-pin"></i>{{ $m->alamat ?? '-' }}</div>
            </div>
            <span class="status-badge {{ $sbClass }}">{{ strtoupper($m->status_wakaf ?? 'BELUM WAKAF') }}</span>
          </div>
          <div class="masjid-stats">
            <div class="masjid-stat-item">
              <div class="msi-lbl">Jamaah</div>
              <div class="msi-val">{{ number_format($m->kapasitas_jamaah ?? 0) }}</div>
            </div>
            <div class="masjid-stat-item">
              <div class="msi-lbl">Inventaris</div>
              <div class="msi-val">{{ $m->jumlah_inventaris ?? '-' }} Item</div>
            </div>
            <div class="masjid-stat-item">
              <div class="msi-lbl">Takmir</div>
              <div class="msi-val">{{ $m->jumlah_takmir ?? '-' }}</div>
            </div>
          </div>
          <div class="masjid-card-footer">
            <div class="masjid-actions">
              <a class="masjid-action-link detail-btn"
                 data-nama="{{ $m->nama_masjid }}"
                 data-jamaah="{{ number_format($m->kapasitas_jamaah ?? 0) }}"
                 data-inventaris="{{ $m->jumlah_inventaris ?? 0 }}"
                 data-takmir="{{ $m->jumlah_takmir ?? 0 }}"
                 data-wakaf="{{ $m->status_wakaf ?? 'Belum Wakaf' }}"
                 data-sertifikat="{{ $m->nomor_sertifikat ?? '-' }}">Detail</a>
            </div>
            @if($isLengkap)
              <span class="completeness-txt ok">Data Lengkap</span>
            @else
              <span class="completeness-txt warn">Lengkapi {{ $pct }}%</span>
            @endif
          </div>
        </div>
        @empty
        <div style="grid-column:1/-1;padding:48px 20px;text-align:center;color:#9ca3af;">
          <i class="ti ti-building-mosque" style="font-size:48px;display:block;margin-bottom:12px;color:#d1d5db;"></i>
          <div style="font-size:15px;font-weight:600;margin-bottom:6px;">Belum ada masjid terdaftar</div>
          <div style="font-size:13px;">Data masjid yang disetujui akan muncul di sini.</div>
        </div>
        @endforelse

      </div><!-- /masjid-grid -->

      <!-- INFO COUNT -->
      <div class="pagination-wrap">
        <span>Menampilkan {{ $daftarMasjid->count() }} Masjid/Musholla yang sudah disetujui</span>
      </div>


    </main>
  </div>
</div>

  </div>
</div>

<script>
function filterCards() {
  const q     = document.getElementById('searchInput').value.toLowerCase();
  const tipe  = document.getElementById('filterTipe').value;
  const wakaf = document.getElementById('filterWakaf').value;
  const data  = document.getElementById('filterData').value;
  document.querySelectorAll('.masjid-card').forEach(card => {
    const matchNama  = card.dataset.nama.includes(q);
    const matchTipe  = !tipe  || card.dataset.tipe  === tipe;
    const matchWakaf = !wakaf || card.dataset.wakaf === wakaf;
    const matchData  = !data  || card.dataset.data  === data;
    card.style.display = (matchNama && matchTipe && matchWakaf && matchData) ? '' : 'none';
  });
}
</script>


<!-- DETAIL POPUP MODAL -->
<div id="detailModal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;">
  <!-- Backdrop -->
  <div id="modalBackdrop" onclick="closeModal()" style="position:absolute;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(3px);"></div>
  <!-- Modal Box -->
  <div id="modalBox" style="
    position:relative;z-index:1;background:#fff;border-radius:16px;
    width:92%;max-width:480px;max-height:85vh;overflow-y:auto;
    box-shadow:0 20px 60px rgba(0,0,0,.25);
    transform:scale(0.9);opacity:0;
    transition:transform 0.25s cubic-bezier(.34,1.56,.64,1), opacity 0.2s ease;
  ">
    <!-- Modal Header -->
    <div style="padding:20px 22px 16px;border-bottom:1px solid #eee;display:flex;align-items:center;justify-content:space-between;">
      <div>
        <div id="modalNama" style="font-size:17px;font-weight:700;color:#1a1a1a;"></div>
        <div id="modalWakafBadge" style="margin-top:5px;"></div>
      </div>
      <button onclick="closeModal()" style="background:none;border:none;cursor:pointer;font-size:22px;color:#888;line-height:1;padding:4px;">&times;</button>
    </div>

    <!-- Modal Body -->
    <div style="padding:18px 22px;display:flex;flex-direction:column;gap:18px;">

      <!-- Jamaah -->
      <div>
        <div style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#888;margin-bottom:8px;">JUMLAH JAMAAH</div>
        <div style="display:flex;align-items:center;gap:10px;background:#f0fdf4;border-radius:10px;padding:12px 14px;">
          <i class="ti ti-users" style="font-size:22px;color:#1e6b3f;"></i>
          <div>
            <div id="modalJamaah" style="font-size:22px;font-weight:700;color:#1e6b3f;"></div>
            <div style="font-size:11px;color:#666;">Kapasitas jamaah terdaftar</div>
          </div>
        </div>
      </div>

      <!-- Inventaris -->
      <div>
        <div style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#888;margin-bottom:8px;">DAFTAR INVENTARIS</div>
        <div id="modalInventaris" style="display:flex;flex-wrap:wrap;gap:7px;"></div>
      </div>

      <!-- Takmir -->
      <div>
        <div style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#888;margin-bottom:8px;">DAFTAR TAKMIR</div>
        <div id="modalTakmir" style="display:flex;flex-direction:column;gap:6px;"></div>
      </div>

      <!-- Sertifikat -->
      <div>
        <div style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#888;margin-bottom:8px;">SERTIFIKAT WAKAF</div>
        <div style="display:flex;align-items:center;gap:10px;background:#f8f9fa;border-radius:10px;padding:12px 14px;border:1px solid #eee;">
          <i class="ti ti-certificate" style="font-size:20px;color:#1e6b3f;"></i>
          <div id="modalSertifikat" style="font-size:13px;font-weight:600;color:#333;"></div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// ── MODAL ──
function openModal(btn) {
  const card = btn.closest('.masjid-card');
  const nama       = card.dataset.nama ? capitalize(card.dataset.nama) : btn.dataset.nama || '-';
  const jamaah     = card.dataset.jamaah || btn.dataset.jamaah || '-';
  const invList    = (card.dataset.inventarisList || btn.dataset.inventarisList || '').split('|').filter(Boolean);
  const takmirList = (card.dataset.takmirList || btn.dataset.takmirList || '').split('|').filter(Boolean);
  const wakafStatus= card.dataset.wakafStatus || btn.dataset.wakafStatus || '-';
  const sertifikat = card.dataset.sertifikat || btn.dataset.sertifikat || '-';

  document.getElementById('modalNama').textContent = nama;

  // Badge wakaf
  const wColors = { 'Wakaf': ['#f0fdf4','#1e6b3f'], 'Proses Wakaf': ['#fffbeb','#92400e'], 'Belum Wakaf': ['#fff5f5','#b91c1c'] };
  const [bg, fg] = wColors[wakafStatus] || ['#f0fdf4','#1e6b3f'];
  document.getElementById('modalWakafBadge').innerHTML =
    `<span style="background:${bg};color:${fg};padding:3px 10px;border-radius:999px;font-size:11px;font-weight:700;">${wakafStatus.toUpperCase()}</span>`;

  document.getElementById('modalJamaah').textContent = jamaah + ' orang';

  // Inventaris chips
  const invEl = document.getElementById('modalInventaris');
  invEl.innerHTML = invList.length
    ? invList.map(i => `<span style="background:#f0fdf4;color:#1e6b3f;border:1px solid #a7f3d0;padding:4px 10px;border-radius:999px;font-size:12px;font-weight:500;">${i}</span>`).join('')
    : '<span style="color:#aaa;font-size:13px;">Belum ada data inventaris</span>';

  // Takmir rows
  const takmirEl = document.getElementById('modalTakmir');
  takmirEl.innerHTML = takmirList.length
    ? takmirList.map((t,i) => `
        <div style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:#f8f9fa;border-radius:8px;">
          <div style="width:26px;height:26px;border-radius:50%;background:#1e6b3f;color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;">${i+1}</div>
          <span style="font-size:13px;font-weight:500;color:#333;">${t}</span>
        </div>`).join('')
    : '<span style="color:#aaa;font-size:13px;">Belum ada data takmir</span>';

  document.getElementById('modalSertifikat').textContent = sertifikat;

  // Show modal
  const modal = document.getElementById('detailModal');
  modal.style.display = 'flex';
  requestAnimationFrame(() => {
    document.getElementById('modalBox').style.transform = 'scale(1)';
    document.getElementById('modalBox').style.opacity = '1';
  });
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  const box = document.getElementById('modalBox');
  box.style.transform = 'scale(0.9)';
  box.style.opacity = '0';
  setTimeout(() => {
    document.getElementById('detailModal').style.display = 'none';
    document.body.style.overflow = '';
  }, 200);
}

function capitalize(str) {
  return str.replace(/\b\w/g, c => c.toUpperCase());
}

// Bind detail buttons
document.querySelectorAll('.detail-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.stopPropagation();
    openModal(this);
  });
});

// ── SHAKE ──
function applyShake(el) {
  const isWarn = el.classList.contains('incomplete');
  el.style.background = isWarn ? '#fef9e7' : '#d6f0e0';
  el.style.borderColor = isWarn ? '#d4a017' : '#2d8a55';
  el.style.boxShadow = '0 6px 18px rgba(30,107,63,.2)';
  const frames = [
    { transform: 'translateX(0px)' },
    { transform: 'translateX(-7px)' },
    { transform: 'translateX(7px)' },
    { transform: 'translateX(-5px)' },
    { transform: 'translateX(5px)' },
    { transform: 'translateX(-3px)' },
    { transform: 'translateX(3px)' },
    { transform: 'translateX(0px)' },
  ];
  const anim = el.animate(frames, { duration: 450, easing: 'ease-in-out' });
  anim.onfinish = () => {
    el.style.background = '';
    el.style.borderColor = '';
    el.style.boxShadow = '';
  };
}

document.querySelectorAll('.masjid-card').forEach(card => {
  card.style.cursor = 'pointer';
  card.style.transition = 'transform 0.2s ease, box-shadow 0.2s ease';
  card.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-4px)';
    this.style.boxShadow = '0 10px 24px rgba(30,107,63,.14)';
  });
  card.addEventListener('mouseleave', function() {
    this.style.transform = '';
    this.style.boxShadow = '';
  });
  card.addEventListener('mousedown', function() {
    applyShake(this);
  });
});

document.querySelectorAll('.stat-strip-card').forEach(card => {
  card.style.cursor = 'pointer';
  card.style.transition = 'transform 0.2s ease, box-shadow 0.2s ease';
  card.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-4px)';
    this.style.boxShadow = '0 10px 24px rgba(30,107,63,.14)';
  });
  card.addEventListener('mouseleave', function() {
    this.style.transform = '';
    this.style.boxShadow = '';
  });
  card.addEventListener('mousedown', function() {
    applyShake(this);
  });
});

// Close on Escape
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

</body>
</html>