<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Indeks Aktivitas Cabang — PCM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }

.stat-card, .card, .data-card, .kriteria-card {
  transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
}
.stat-card:hover, .data-card:hover, .kriteria-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(30,107,63,.12);
  border-color: var(--green-300);
}

.iar-header { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:24px; }
.iar-header-left h1 { font-size:22px; font-weight:700; color:var(--gray-900); line-height:1.3; }
.iar-header-left p  { font-size:13px; color:var(--gray-500); margin-top:3px; }

.stat-cards { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:20px; }
.stat-card {
  background:#fff; border:1px solid var(--gray-200); border-radius:12px;
  padding:18px 20px; display:flex; flex-direction:column;
  align-items:center; text-align:center; gap:4px;
}
.stat-card-icon {
  font-size:20px; width:36px; height:36px;
  display:flex; align-items:center; justify-content:center;
  border-radius:8px; margin-bottom:6px; background:var(--green-50);
}
.sc-kurang .stat-card-icon { background:#fffbeb; }
.sc-vakum  .stat-card-icon { background:#fff5f5; }
.stat-card-num   { font-size:26px; font-weight:700; line-height:1; }
.stat-card-label { font-size:12px; font-weight:600; }
.sc-aktif  .stat-card-icon,
.sc-aktif  .stat-card-num,
.sc-aktif  .stat-card-label { color:var(--green-600); }
.sc-kurang .stat-card-icon,
.sc-kurang .stat-card-num,
.sc-kurang .stat-card-label { color:#d97706; }
.sc-vakum  .stat-card-icon,
.sc-vakum  .stat-card-num,
.sc-vakum  .stat-card-label { color:#dc2626; }

.kriteria-card {
  background:#fff; border:1px solid var(--gray-200); border-radius:12px;
  padding:20px 24px; margin-bottom:20px;
}
.kriteria-card h2 { font-size:15px; font-weight:700; color:var(--gray-900); margin-bottom:14px; }
.kriteria-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.kriteria-box  { border-radius:10px; padding:14px 16px; font-size:12.5px; }
.kb-aktif  { background:#f0fdf4; }
.kb-kurang { background:#fffbeb; }
.kb-vakum  { background:#fff5f5; }
.kriteria-box-title {
  display:flex; align-items:center; gap:7px;
  font-size:12px; font-weight:700; letter-spacing:.04em; margin-bottom:8px;
}
.kriteria-box-title .dot { width:9px; height:9px; border-radius:50%; flex-shrink:0; }
.kb-aktif  .kriteria-box-title { color:var(--green-700); }
.kb-kurang .kriteria-box-title { color:#92400e; }
.kb-vakum  .kriteria-box-title { color:#b91c1c; }
.kriteria-item { display:flex; align-items:center; gap:7px; font-size:12px; color:var(--gray-700); margin-bottom:4px; }
.kriteria-item:last-child { margin-bottom:0; }
.kriteria-item i { font-size:14px; }
.kb-aktif  .kriteria-item i { color:var(--green-600); }
.kb-kurang .kriteria-item i { color:#d97706; }
.kb-vakum  .kriteria-item i { color:#dc2626; }

.data-card { background:#fff; border:1px solid var(--gray-200); border-radius:12px; overflow:hidden; }
.data-card-header {
  display:flex; align-items:center; justify-content:space-between;
  padding:18px 24px; border-bottom:1px solid var(--gray-100);
}
.data-card-header h2 { font-size:15px; font-weight:700; color:var(--gray-900); }
.data-card-actions  { display:flex; gap:10px; }

.filter-bar {
  display:flex; align-items:center; gap:10px;
  padding:14px 24px; border-bottom:1px solid var(--gray-100);
}
.filter-search {
  display:flex; align-items:center; gap:8px;
  background:var(--gray-100); border-radius:8px;
  padding:7px 12px; width:260px; flex-shrink:0;
}
.filter-search i { color:var(--gray-500); font-size:15px; }
.filter-search input {
  background:none; border:none; outline:none;
  font-size:13px; color:var(--gray-800); width:100%;
  font-family:'Inter',sans-serif;
}
.filter-search input::placeholder { color:var(--gray-500); }
.filter-bar select.filter-btn {
  width:auto; min-width:0; padding:7px 28px 7px 10px;
  font-size:13px; font-family:'Inter',sans-serif;
  background:var(--gray-100); border:1px solid var(--gray-200);
  border-radius:8px; color:var(--gray-700); cursor:pointer; appearance:auto;
}

.data-table { width:100%; border-collapse:collapse; }
.data-table thead tr { background:var(--gray-50); }
.data-table th {
  padding:10px 20px; font-size:11px; font-weight:700; color:var(--gray-500);
  text-transform:uppercase; letter-spacing:.06em; text-align:left;
  border-bottom:1px solid var(--gray-100); white-space:nowrap;
}
.data-table td {
  padding:14px 20px; font-size:13px; color:var(--gray-800);
  border-bottom:1px solid var(--gray-100); vertical-align:middle;
}
.data-table tbody tr:last-child td { border-bottom:none; }
.data-table tbody tr:hover { background:var(--green-50); }
.col-laporan { color:var(--gray-700); font-size:13px; }

.progress-wrap { display:flex; align-items:center; gap:10px; min-width:160px; }
.progress-bar  { flex:1; height:8px; background:var(--gray-100); border-radius:999px; overflow:hidden; }
.progress-fill { height:100%; border-radius:999px; }
.pf-green  { background:var(--green-500); }
.pf-yellow { background:#f59e0b; }
.pf-red    { background:#ef4444; }
.progress-num { font-size:13px; font-weight:600; color:var(--gray-700); min-width:24px; }
.col-proker { font-weight:600; }
.proker-green  { color:var(--green-600); }
.proker-yellow { color:#d97706; }
.proker-red    { color:#dc2626; }

.badge {
  display:inline-flex; align-items:center;
  padding:4px 11px; font-size:10.5px; font-weight:700;
  border-radius:999px; white-space:nowrap; letter-spacing:.03em;
}
.badge-aktif  { background:var(--green-50);  color:var(--green-700); border:1px solid var(--green-100); }
.badge-kurang { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }
.badge-vakum  { background:#fff5f5; color:#b91c1c; border:1px solid #fecaca; }

.pagination {
  display:flex; align-items:center; justify-content:space-between;
  padding:14px 24px; border-top:1px solid var(--gray-100);
  font-size:12.5px; color:var(--gray-500);
}

.modal-overlay {
  display:none; position:fixed; inset:0;
  background:rgba(0,0,0,.45); z-index:1000;
  align-items:center; justify-content:center;
}
.modal-overlay.open { display:flex; }
.modal-box {
  background:#fff; border-radius:16px; width:100%; max-width:520px;
  max-height:90vh; overflow-y:auto;
  box-shadow:0 20px 60px rgba(0,0,0,.2);
  animation:modal-in .2s ease;
}
@keyframes modal-in {
  from { opacity:0; transform:translateY(-16px) scale(.97); }
  to   { opacity:1; transform:translateY(0) scale(1); }
}
.modal-header {
  display:flex; align-items:center; justify-content:space-between;
  padding:20px 24px 16px; border-bottom:1px solid var(--gray-100);
}
.modal-header h3 { font-size:16px; font-weight:700; color:var(--gray-900); }
.modal-close {
  width:32px; height:32px; border:none; background:var(--gray-100);
  border-radius:8px; cursor:pointer; display:flex; align-items:center;
  justify-content:center; color:var(--gray-600); transition:background .15s;
}
.modal-close:hover { background:var(--gray-200); }
.modal-close i { font-size:16px; }
.modal-body { padding:20px 24px; }
.modal-body .form-group { margin-bottom:16px; }
.modal-body label {
  display:block; font-size:12px; font-weight:600;
  color:var(--gray-700); margin-bottom:5px; text-transform:uppercase; letter-spacing:.04em;
}
.modal-body input[type=text],
.modal-body input[type=number],
.modal-body input[type=date],
.modal-body select,
.modal-body textarea {
  width:100%; padding:9px 12px;
  border:1.5px solid var(--gray-300); border-radius:8px;
  font-size:13px; color:var(--gray-800);
  font-family:'Inter',sans-serif;
  background:#fff; outline:none; transition:border .15s;
}
.modal-body input:focus,
.modal-body select:focus,
.modal-body textarea:focus {
  border-color:var(--green-500);
  box-shadow:0 0 0 3px rgba(39,134,79,.1);
}
.modal-body textarea { height:70px; resize:vertical; }
.form-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.modal-footer {
  display:flex; align-items:center; justify-content:flex-end; gap:10px;
  padding:16px 24px; border-top:1px solid var(--gray-100);
}
.btn-cancel {
  padding:9px 18px; border:1.5px solid var(--gray-300); border-radius:8px;
  font-size:13px; font-weight:600; color:var(--gray-700); background:#fff;
  cursor:pointer; font-family:'Inter',sans-serif; transition:background .15s;
}
.btn-cancel:hover { background:var(--gray-100); }
.btn-simpan {
  padding:9px 22px; background:var(--green-700); color:#fff; border:none;
  border-radius:8px; font-size:13px; font-weight:700;
  cursor:pointer; font-family:'Inter',sans-serif;
  display:inline-flex; align-items:center; gap:6px; transition:background .15s;
}
.btn-simpan:hover { background:var(--green-600); }
.req { color:#dc2626; }
.toast {
  position:fixed; bottom:28px; right:28px;
  background:var(--green-700); color:#fff;
  padding:12px 20px; border-radius:10px; font-size:13px; font-weight:600;
  display:none; align-items:center; gap:8px; z-index:2000;
  box-shadow:0 6px 24px rgba(0,0,0,.18);
}
.toast.show { display:flex; }
</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'status-cabang'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'status-cabang'])

    <main class="page-content">

      <div class="iar-header">
        <div class="iar-header-left">
          <h1>Indeks Aktivitas Cabang</h1>
          <p>Monitoring real-time keaktifan Pimpinan Cabang Muhammadiyah (PCM) berdasarkan laporan dan program kerja.</p>
        </div>
      </div>

      <div class="stat-cards">
        <div class="stat-card sc-aktif">
          <div class="stat-card-icon"><i class="ti ti-circle-check"></i></div>
          <div class="stat-card-num">{{ $daftar->where("status","Aktif")->count() }}</div>
          <div class="stat-card-label">Cabang Aktif</div>
        </div>
        <div class="stat-card sc-kurang">
          <div class="stat-card-icon"><i class="ti ti-alert-triangle"></i></div>
          <div class="stat-card-num">{{ $daftar->where("status","Kurang Aktif")->count() }}</div>
          <div class="stat-card-label">Kurang Aktif</div>
        </div>
        <div class="stat-card sc-vakum">
          <div class="stat-card-icon"><i class="ti ti-alert-circle"></i></div>
          <div class="stat-card-num">{{ $daftar->where("status","Vakum")->count() }}</div>
          <div class="stat-card-label">Inaktif / Vakum</div>
        </div>
      </div>

      <div class="kriteria-card">
        <h2>Kriteria Penilaian Indeks</h2>
        <div class="kriteria-grid">
          <div class="kriteria-box kb-aktif">
            <div class="kriteria-box-title">
              <span class="dot" style="background:var(--green-500);"></span>AKTIF
            </div>
            <div class="kriteria-item"><i class="ti ti-circle-check"></i> Laporan ≤ 30 hari terakhir</div>
            <div class="kriteria-item"><i class="ti ti-circle-check"></i> Proker terealisasi ≥ 60%</div>
          </div>
          <div class="kriteria-box kb-kurang">
            <div class="kriteria-box-title">
              <span class="dot" style="background:#f59e0b;"></span>KURANG AKTIF
            </div>
            <div class="kriteria-item"><i class="ti ti-minus-circle"></i> Laporan 31 – 90 hari terakhir</div>
            <div class="kriteria-item"><i class="ti ti-minus-circle"></i> Proker terealisasi 30 – 60%</div>
          </div>
          <div class="kriteria-box kb-vakum">
            <div class="kriteria-box-title">
              <span class="dot" style="background:#ef4444;"></span>INAKTIF / VAKUM
            </div>
            <div class="kriteria-item"><i class="ti ti-circle-x"></i> Laporan > 90 hari terakhir</div>
            <div class="kriteria-item"><i class="ti ti-circle-x"></i> Proker terealisasi < 30%</div>
          </div>
        </div>
      </div>

      <div class="data-card">
        <div class="data-card-header">
          <h2>Data Aktivitas Cabang</h2>
          <div class="data-card-actions">
            <button class="btn btn-secondary">
              <i class="ti ti-adjustments-horizontal"></i> Filter
            </button>
            <button class="btn btn-secondary">
              <i class="ti ti-download"></i> Export
            </button>
          </div>
        </div>

        <div class="filter-bar">
          <div class="filter-search">
            <i class="ti ti-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama cabang..." oninput="filterRanting()"/>
          </div>
          <select class="filter-btn" id="filterStatus" onchange="filterRanting()">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="kurang-aktif">Kurang Aktif</option>
            <option value="vakum">Vakum</option>
          </select>
        </div>

        <table class="data-table">
          <thead>
            <tr>
              <th>Nama PCM</th>
              <th>Login Terakhir</th>
              <th>Skor Keaktifan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="rantingList">

            @forelse($daftar as $r)
            @php
              $skor       = $r->skor;
              $status     = $r->status;
              $badgeClass = match($status) { 'Aktif'=>'badge-aktif','Kurang Aktif'=>'badge-kurang',default=>'badge-vakum' };
              $skorClass  = $skor >= 70 ? 'pf-green' : ($skor >= 50 ? 'pf-yellow' : 'pf-red');
              $statusSlug = \Illuminate\Support\Str::slug($status);
            @endphp
            <tr data-nama="{{ strtolower($r->nama) }}" data-status="{{ $statusSlug }}">
              <td><strong>{{ $r->nama }}</strong></td>
              <td class="col-laporan">{{ $r->laporan_terakhir }}</td>
              <td>
                <div class="progress-wrap">
                  <div class="progress-bar">
                    <div class="progress-fill {{ $skorClass }}" style="width:{{ $skor }}%;"></div>
                  </div>
                  <span class="progress-num">{{ $skor }}</span>
                </div>
              </td>
              <td><span class="badge {{ $badgeClass }}">{{ strtoupper($status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:#9ca3af;padding:24px;">Belum ada data cabang.</td></tr>
            @endforelse
          </tbody>
        </table>

        {{-- Info saja, tanpa tombol pagination --}}
        <div class="pagination">
          <span id="paginationInfo">Menampilkan 1–6 dari 6 Ranting (Kec. Batam Kota)</span>
        </div>
      </div>

    </main>
  </div>
</div>

<script>
function filterRanting() {
  const q      = (document.getElementById('searchInput')?.value || '').toLowerCase();
  const status = document.getElementById('filterStatus')?.value || '';
  const rows   = document.querySelectorAll('#rantingList tr');
  rows.forEach(r => {
    const nama = r.getAttribute('data-nama') || '';
    const st   = r.getAttribute('data-status') || '';
    const okNama = nama.includes(q);
    const okStat = !status || st === status;
    r.style.display = (okNama && okStat) ? '' : 'none';
  });
}
</script>
</body>
</html>