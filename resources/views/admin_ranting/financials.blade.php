<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Dashboard — PRM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
    body { font-family: 'Inter', sans-serif; }
</style>
</head>

{{-- PERBAIKAN 1: hapus </body> yang salah posisi --}}
<body class="text-gray-800 antialiased" style="background-color: #f6f8eb;">
<div class="app-shell">

  @include('admin_ranting.sidebar', ['activeNav' => 'financials'])

  <!-- ── MAIN ── -->
  <div class="main-shell">

    @include('admin_ranting.topbar', ['activeTopLink' => 'financials'])

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
              <i class="ti ti-users-group" aria-hidden="true"></i>
            </div>
            <span class="stat-pill pill-green">
              +{{ $pctPertumbuhan ?? '12' }}% Bulan Ini
            </span>
          </div>
          <div class="stat-label">Total Anggota</div>
          <div class="stat-value">{{ number_format($totalAnggota ?? 1432) }}</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon">
              <i class="ti ti-user-check" aria-hidden="true"></i>
            </div>
            <span class="stat-pill pill-blue">{{ $pctAktif ?? '88' }}% Aktif</span>
          </div>
          <div class="stat-label">Anggota Aktif</div>
          <div class="stat-value">{{ number_format($anggotaAktif ?? 1260) }}</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon" style="background:#eff6ff;">
              <i class="ti ti-building-community" aria-hidden="true" style="color:#3b82f6;"></i>
            </div>
            <span class="stat-pill pill-blue">{{ $jumlahRanting ?? 12 }} PRM</span>
          </div>
          <div class="stat-label">Jumlah Ranting</div>
          <div class="stat-value">{{ $jumlahRanting ?? 12 }}</div>
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

      <!-- BOTTOM TWO COLS -->
      <div class="grid-2">

        <!-- STATUS RANTING -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Status Ranting (PRM)</span>
            <a href="{{ url('/prm/status-ranting') }}" class="card-link">Lihat Semua</a>
          </div>
          <div style="padding:0;">

            @forelse($daftarRanting ?? [] as $r)
            @php
              $dotColor  = match($r->status) { 'Aktif' => '#22c55e', 'Kurang Aktif' => '#f59e0b', default => '#94a3b8' };
              $badgeClass = match($r->status) { 'Aktif' => 'badge-aktif', 'Kurang Aktif' => 'badge-kurang', default => 'badge-vakum' };
            @endphp
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:12px;height:12px;border-radius:50%;background:{{ $dotColor }};flex-shrink:0;"></span>
                <div>
                  <div style="font-weight:600;font-size:14px;color:var(--gray-800);">{{ $r->nama_ranting }}</div>
                  <div style="font-size:12px;color:var(--gray-500);">Terakhir update: {{ $r->updated_at?->diffForHumans() ?? '-' }}</div>
                </div>
              </div>
              <span class="badge {{ $badgeClass }}">{{ strtoupper($r->status) }}</span>
            </div>
            @empty
            {{-- Data demo --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:12px;height:12px;border-radius:50%;background:#22c55e;flex-shrink:0;"></span>
                <div>
                  <div style="font-weight:600;font-size:14px;color:var(--gray-800);">PRM Kelurahan Sentosa</div>
                  <div style="font-size:12px;color:var(--gray-500);">Terakhir update: 2 jam yang lalu</div>
                </div>
              </div>
              <span class="badge badge-aktif">AKTIF</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:12px;height:12px;border-radius:50%;background:#f59e0b;flex-shrink:0;"></span>
                <div>
                  <div style="font-weight:600;font-size:14px;color:var(--gray-800);">PRM Desa Makmur Jaya</div>
                  <div style="font-size:12px;color:var(--gray-500);">Terakhir update: 1 hari yang lalu</div>
                </div>
              </div>
              <span class="badge badge-kurang">KURANG AKTIF</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:12px;height:12px;border-radius:50%;background:#94a3b8;flex-shrink:0;"></span>
                <div>
                  <div style="font-weight:600;font-size:14px;color:var(--gray-800);">PRM Perumahan Indah</div>
                  <div style="font-size:12px;color:var(--gray-500);">Terakhir update: 3 bulan yang lalu</div>
                </div>
              </div>
              <span class="badge badge-vakum">VAKUM</span>
            </div>
            @endforelse

          </div>
        </div><!-- /card status ranting -->

        <!-- STATUS PENGAJUAN -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Status Pengajuan</span>
          </div>
          <div style="padding:0;">

            @forelse($daftarPengajuan ?? [] as $p)
            @php
              $dotColor   = match($p->status) { 'Disetujui' => '#22c55e', 'Ditolak' => '#ef4444', default => '#f59e0b' };
              $statusText = match($p->status) { 'Disetujui' => 'DISETUJUI', 'Ditolak' => 'DITOLAK', default => 'PENDING' };
              $statusColor = match($p->status) {
                'Disetujui' => 'color:var(--green-600)',
                'Ditolak'   => 'color:var(--red-text)',
                default     => 'color:#b45309'
              };
            @endphp
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:10px;height:10px;border-radius:50%;background:{{ $dotColor }};flex-shrink:0;"></span>
                <span style="font-size:14px;font-weight:500;color:var(--gray-800);">{{ $p->jenis_pengajuan }}</span>
              </div>
              <span style="font-size:12px;font-weight:700;letter-spacing:.04em;{{ $statusColor }}">{{ $statusText }}</span>
            </div>
            @empty
            {{-- Data demo --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:10px;height:10px;border-radius:50%;background:#f59e0b;flex-shrink:0;"></span>
                <span style="font-size:14px;font-weight:500;color:var(--gray-800);">SK Ranting Baru</span>
              </div>
              <span style="font-size:12px;font-weight:700;color:#b45309;letter-spacing:.04em;">PENDING</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--gray-100);">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:10px;height:10px;border-radius:50%;background:#22c55e;flex-shrink:0;"></span>
                <span style="font-size:14px;font-weight:500;color:var(--gray-800);">Hibah Tanah Wakaf</span>
              </div>
              <span style="font-size:12px;font-weight:700;color:var(--green-600);letter-spacing:.04em;">DISETUJUI</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;">
              <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:10px;height:10px;border-radius:50%;background:#ef4444;flex-shrink:0;"></span>
                <span style="font-size:14px;font-weight:500;color:var(--gray-800);">Revisi Proposal Majelis</span>
              </div>
              <span style="font-size:12px;font-weight:700;color:var(--red-text);letter-spacing:.04em;">DITOLAK</span>
            </div>
            @endforelse

          </div>
        </div><!-- /card status pengajuan -->

      </div><!-- /grid-2 -->

    </main>
  </div><!-- /main-shell -->
</div><!-- /app-shell -->

<!-- FAB -->
<button class="fab" aria-label="Tambah Masjid"
        onclick="window.location.href='{{ url('/prm/data-masjid') }}'">
  <svg width="24" height="24" fill="none" stroke="currentColor"
       stroke-width="2.5" viewBox="0 0 24 24">
    <path d="M12 5v14M5 12h14"/>
  </svg>
</button>
</body>
</html>