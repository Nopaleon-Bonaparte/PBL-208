<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Antrian Persetujuan — PCM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }
.pq-item {
  background:#fff; border:1px solid var(--gray-200); border-radius:12px;
  padding:18px 20px; margin-bottom:14px;
  box-shadow:0 1px 3px rgba(0,0,0,.05);
}
.pq-head { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }
.pq-title { font-size:15px; font-weight:700; color:var(--gray-900); display:flex; align-items:center; gap:8px; }
.pq-badge { font-size:11px; font-weight:700; padding:3px 10px; border-radius:999px; }
.pq-badge.add { background:#dcfce7; color:#15803d; }
.pq-badge.edit { background:#fef9c3; color:#a16207; }
.pq-meta { font-size:12.5px; color:var(--gray-500); margin-top:4px; }
.pq-data { margin-top:12px; font-size:13px; color:var(--gray-700); background:var(--gray-50);
  border-radius:8px; padding:10px 14px; }
.pq-data b { color:var(--gray-900); }
.pq-actions { display:flex; gap:8px; margin-top:14px; }
.pq-empty { text-align:center; color:var(--gray-400); padding:60px 0; }
.pq-empty i { font-size:42px; display:block; margin-bottom:10px; }
.flash { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:16px; }
.flash.ok { background:#dcfce7; color:#15803d; }
.flash.err { background:#fee2e2; color:#b91c1c; }
.reject-form { display:none; margin-top:10px; gap:8px; }
.reject-form.show { display:flex; }
.reject-form input { flex:1; padding:8px 12px; border:1px solid var(--gray-300); border-radius:8px; font-size:13px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_cabang.sidebar', ['activeNav' => 'persetujuan'])

  <div class="main-shell">
    @include('admin_cabang.topbar', ['activeTopLink' => 'persetujuan'])

    <main class="page-content">

      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Antrian Persetujuan</h1>
          <p>Permohonan penambahan & perubahan data masjid dari admin ranting di cabang Anda.</p>
        </div>
      </div>

      @if(session('success'))<div class="flash ok">{{ session('success') }}</div>@endif
      @if(session('error'))<div class="flash err">{{ session('error') }}</div>@endif

      <div class="dm-notice" style="margin-bottom:20px;">
        <i class="ti ti-info-circle"></i>
        Total {{ $totalPending }} permohonan menunggu. Persetujuan akan langsung menampilkan data sebagai "data jadi".
      </div>

      @forelse($pengajuan as $p)
        @php $d = is_array($p->data_baru) ? $p->data_baru : json_decode($p->data_baru, true); @endphp
        <div class="pq-item">
          <div class="pq-head">
            <div>
              <div class="pq-title">
                <i class="ti ti-building-mosque"></i> {{ $p->nama_masjid }}
                @if($p->jenis_pengajuan === 'tambah_masjid')
                  <span class="pq-badge add">Masjid Baru</span>
                @else
                  <span class="pq-badge edit">Perubahan Data</span>
                @endif
              </div>
              <div class="pq-meta">
                {{ $p->nama_ranting ?? '-' }} · Diajukan oleh {{ $p->pengaju ?? '-' }}
                · {{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}
              </div>
            </div>
          </div>

          <div class="pq-data">
            <b>Tipe:</b> {{ $d['tipe'] ?? $p->tipe }} &nbsp;|&nbsp;
            <b>Wilayah:</b> {{ $d['wilayah'] ?? $p->wilayah ?? '-' }} &nbsp;|&nbsp;
            <b>Alamat:</b> {{ $d['alamat'] ?? '-' }} &nbsp;|&nbsp;
            <b>Kontak:</b> {{ $d['kontak_pengurus'] ?? '-' }} &nbsp;|&nbsp;
            <b>Legalitas:</b> {{ $d['status_legalitas'] ?? '-' }}
          </div>

          <div class="pq-actions">
            <form method="POST" action="{{ url('/pcm/persetujuan/'.$p->id_pengajuan.'/approve') }}">
              @csrf
              <button type="submit" class="btn btn-primary btn-sm"><i class="ti ti-check"></i> Setujui</button>
            </form>
            <button type="button" class="btn btn-secondary btn-sm"
                    onclick="this.nextElementSibling.classList.toggle('show')">
              <i class="ti ti-x"></i> Tolak
            </button>
            <form method="POST" action="{{ url('/pcm/persetujuan/'.$p->id_pengajuan.'/reject') }}" class="reject-form">
              @csrf
              <input type="text" name="alasan" placeholder="Alasan penolakan (opsional)"/>
              <button type="submit" class="btn btn-secondary btn-sm">Kirim</button>
            </form>
          </div>
        </div>
      @empty
        <div class="pq-empty">
          <i class="ti ti-inbox"></i>
          Tidak ada permohonan yang menunggu persetujuan.
        </div>
      @endforelse

    </main>
  </div>
</div>
</body>
</html>
