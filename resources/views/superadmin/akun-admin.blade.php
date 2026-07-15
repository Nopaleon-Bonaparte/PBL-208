<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Manajemen Akun Administrator — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }

.aa-stat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px; }
.aa-stat-card {
  background:#fff; border:1px solid #e5e7eb; border-radius:14px;
  padding:18px 20px; display:flex; justify-content:space-between; align-items:flex-start;
}
.aa-stat-label { font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:.04em; margin-bottom:8px; }
.aa-stat-val { font-size:28px; font-weight:700; color:#111827; }
.aa-stat-icon { font-size:20px; color:#1e6b3f; }

.aa-filter-bar { background:#fff; border:1px solid #e5e7eb; border-radius:14px; padding:16px 18px; margin-bottom:18px; display:flex; gap:12px; }
.aa-search { flex:1; display:flex; align-items:center; gap:8px; background:#f3f4f6; border:1px solid #e5e7eb; border-radius:9px; padding:9px 14px; }
.aa-search i { color:#9ca3af; font-size:15px; }
.aa-search input { background:none; border:none; outline:none; font-size:13px; width:100%; font-family:inherit; }
.aa-select { padding:9px 30px 9px 14px; border:1px solid #e5e7eb; border-radius:9px; background:#fff; font-size:13px; color:#374151; font-family:inherit; cursor:pointer; }

.aa-table-card { background:#fff; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; }
.aa-table { width:100%; border-collapse:collapse; }
.aa-table th { text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:.03em; padding:13px 22px; border-bottom:1px solid #f3f4f6; background:#f9fafb; }
.aa-table td { padding:15px 22px; font-size:13.5px; color:#1f2937; border-bottom:1px solid #f3f4f6; vertical-align:middle; }
.aa-table tr:last-child td { border-bottom:none; }
.aa-name { font-weight:700; color:#111827; }
.aa-username { font-size:12px; color:#9ca3af; margin-top:1px; }
.aa-role-pill { font-size:11px; font-weight:700; padding:4px 12px; border-radius:999px; display:inline-block; }
.rp-cabang  { background:#eff6ff; color:#1d4ed8; }
.rp-ranting { background:#fffbeb; color:#b45309; }
.rp-masjid  { background:#f0fdf4; color:#15803d; }
.aa-action-icon { width:30px; height:30px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; margin-right:5px; border:none; font-family:inherit; }
.ai-edit  { background:#f0fdf4; color:#1e6b3f; }
.ai-reset { background:#fffbeb; color:#b45309; }
.ai-block { background:#fef2f2; color:#dc2626; }
.aa-status-dot { width:7px; height:7px; border-radius:50%; display:inline-block; margin-right:6px; }
.sd-aktif    { background:#10b981; }
.sd-nonaktif { background:#ef4444; }

.aa-pagination { display:flex; justify-content:space-between; align-items:center; padding:14px 22px; font-size:12.5px; color:#6b7280; }
.aa-page-btn { padding:8px 18px; border:1px solid #e5e7eb; border-radius:8px; background:#fff; font-size:13px; font-weight:600; color:#374151; cursor:pointer; font-family:inherit; text-decoration:none; display:inline-block; }
.aa-page-btn.primary { background:#1e6b3f; color:#fff; border-color:#1e6b3f; }
.aa-page-btn.disabled { opacity:.4; cursor:not-allowed; pointer-events:none; }

.btn-detail-outline {
  display: inline-block;
  width: 72px;
  padding: 5px 0;
  font-size: 12.5px;
  font-weight: 600;
  text-align: center;
  color: #1d4ed8;
  background-color: #fff;
  border: 1px solid #bfdbfe;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.btn-detail-outline:hover {
  background-color: #eff6ff;
  border-color: #3b82f6;
}
.btn-hapus-outline {
  display: inline-block;
  width: 72px;
  padding: 5px 0;
  font-size: 12.5px;
  font-weight: 600;
  text-align: center;
  color: #c2410c;
  background-color: #fff;
  border: 1px solid #fed7aa;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.btn-hapus-outline:hover {
  background-color: #fff7ed;
  border-color: #ea580c;
}

/* ── MODAL ── */
.aa-modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; align-items:center; justify-content:center; }
.aa-modal-overlay.open { display:flex; }
.aa-modal-box { background:#fff; border-radius:16px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto; box-shadow:0 20px 60px rgba(0,0,0,.2); }
.aa-modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px 16px; border-bottom:1px solid #f3f4f6; }
.aa-modal-header h3 { font-size:16px; font-weight:700; color:#111827; }
.aa-modal-close { width:32px; height:32px; border:none; background:#f3f4f6; border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; color:#4b5563; }
.aa-modal-body { padding:20px 24px; }
.aa-form-group { margin-bottom:16px; }
.aa-form-group label { display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:5px; text-transform:uppercase; letter-spacing:.03em; }
.aa-form-group input, .aa-form-group select {
  width:100%; padding:9px 12px; border:1.5px solid #d1d5db; border-radius:8px;
  font-size:13px; color:#1f2937; font-family:inherit; background:#fff; outline:none;
}
.aa-form-group input:focus, .aa-form-group select:focus { border-color:#1e6b3f; box-shadow:0 0 0 3px rgba(30,107,63,.1); }
.aa-form-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.aa-modal-footer { display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; border-top:1px solid #f3f4f6; }
.aa-btn-cancel { padding:9px 18px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px; font-weight:600; color:#374151; background:#fff; cursor:pointer; font-family:inherit; }
.aa-btn-save { padding:9px 22px; background:#1e6b3f; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:6px; }
.req { color:#dc2626; }
</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'akun-admin'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'akun-admin'])

    <main class="page-content">

      <div class="flex justify-between items-start mb-10">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Akun Administrator</h2>
          <p class="text-gray-500 font-medium mt-1">Kelola hak akses dan identitas untuk admin Cabang, Ranting, dan Masjid di lingkungan PDM Kota Batam.</p>
        </div>
        <div class="flex items-center gap-2">
          <button class="btn btn-primary" onclick="openAkunModal()">
            <i class="ti ti-plus"></i> Tambah Akun Baru
          </button>
        </div>
      </div>

    @if(session('success'))
  <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg font-medium flex items-center gap-2">
    <i class="ti ti-circle-check"></i> {{ session('success') }}
  </div>
@endif

@if(session('notifikasi_privileges'))
  <div class="mb-4 px-4 py-3 rounded-lg font-medium flex items-center gap-2"
    style="background: {{ str_contains(session('notifikasi_privileges'), 'DICABUT') ? '#fee2e2' : '#dcfce7' }};
           border: 1px solid {{ str_contains(session('notifikasi_privileges'), 'DICABUT') ? '#fca5a5' : '#86efac' }};
           color: {{ str_contains(session('notifikasi_privileges'), 'DICABUT') ? '#dc2626' : '#16a34a' }};">
    <i class="ti ti-{{ str_contains(session('notifikasi_privileges'), 'DICABUT') ? 'lock' : 'lock-open' }}"></i>
    <div>
      <div style="font-weight:700;font-size:13px;">
        {{ str_contains(session('notifikasi_privileges'), 'DICABUT') ? '🔒 Privileges Dicabut' : '🔓 Privileges Diberikan' }}
      </div>
      <div style="font-size:12px;margin-top:2px;">{{ session('notifikasi_privileges') }}</div>
    </div>
  </div>
@endif

      {{-- ── STAT CARDS ── --}}
      <div class="aa-stat-grid">
        <div class="aa-stat-card">
          <div><div class="aa-stat-label">Total Administrator</div><div class="aa-stat-val">{{ $totalAdmin }}</div></div>
          <i class="ti ti-users aa-stat-icon"></i>
        </div>
        <div class="aa-stat-card">
          <div><div class="aa-stat-label">Admin Cabang (PCM)</div><div class="aa-stat-val">{{ $totalCabang }}</div></div>
          <i class="ti ti-building-bank aa-stat-icon"></i>
        </div>
        <div class="aa-stat-card">
          <div><div class="aa-stat-label">Admin Ranting (PRM)</div><div class="aa-stat-val">{{ $totalRanting }}</div></div>
          <i class="ti ti-git-branch aa-stat-icon"></i>
        </div>
      </div>

      {{-- ── FILTER BAR ── --}}
      <form method="GET" action="{{ url('/superadmin/akun-admin') }}" class="aa-filter-bar">
        <div class="aa-search">
          <i class="ti ti-search"></i>
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau username...">
        </div>
        <select name="role" class="aa-select" onchange="this.form.submit()">
          <option value="">Semua Peran</option>
          <option value="R01" {{ request('role') === 'R01' ? 'selected' : '' }}>Admin Cabang</option>
          <option value="R03" {{ request('role') === 'R03' ? 'selected' : '' }}>Admin Ranting</option>

        </select>
        <select name="cabang" id="filterCabangSelect" class="aa-select" onchange="this.form.submit()">
          <option value="">Semua Cabang (PCM)</option>
          <option value="Batam Kota" {{ request('cabang') === 'Batam Kota' ? 'selected' : '' }}>Batam Kota</option>
          <option value="Batu Aji" {{ request('cabang') === 'Batu Aji' ? 'selected' : '' }}>Batu Aji</option>
          <option value="Batu Ampar" {{ request('cabang') === 'Batu Ampar' ? 'selected' : '' }}>Batu Ampar</option>
          <option value="Belakang Padang" {{ request('cabang') === 'Belakang Padang' ? 'selected' : '' }}>Belakang Padang</option>
          <option value="Bengkong" {{ request('cabang') === 'Bengkong' ? 'selected' : '' }}>Bengkong</option>
          <option value="Bulang" {{ request('cabang') === 'Bulang' ? 'selected' : '' }}>Bulang</option>
          <option value="Galang" {{ request('cabang') === 'Galang' ? 'selected' : '' }}>Galang</option>
          <option value="Lubuk Baja" {{ request('cabang') === 'Lubuk Baja' ? 'selected' : '' }}>Lubuk Baja</option>
          <option value="Nongsa" {{ request('cabang') === 'Nongsa' ? 'selected' : '' }}>Nongsa</option>
          <option value="Sagulung" {{ request('cabang') === 'Sagulung' ? 'selected' : '' }}>Sagulung</option>
          <option value="Sei Beduk" {{ request('cabang') === 'Sei Beduk' ? 'selected' : '' }}>Sei Beduk</option>
          <option value="Sekupang" {{ request('cabang') === 'Sekupang' ? 'selected' : '' }}>Sekupang</option>
        </select>

        <select name="ranting" id="filterRantingSelect" class="aa-select" onchange="this.form.submit()">
          <option value="">Semua Ranting (PRM)</option>
        </select>
      </form>

      {{-- ── TABLE ── --}}
      <div class="aa-table-card">
        <table class="aa-table">
          <thead>
            <tr>
              <th style="width: 60px; text-align: center;">No</th>
              <th style="width: 150px;">Peran</th>
              <th style="padding-left: 40px;">Nama</th>
              <th style="padding-left: 40px;">Wilayah</th>
              <th style="width: 100px; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($admins as $a)
            @php
              $roleClass = match($a->id_role) { 'R01' => 'rp-cabang', 'R03' => 'rp-ranting', default => 'rp-masjid' };
              
              $wilayahName = '—';
              if ($a->id_role === 'R01') {
                  $wilayahName = $a->nama_cabang_direct ? str_replace('PCM ', '', $a->nama_cabang_direct) : '—';
              } elseif ($a->id_role === 'R03') {
                  $cabangName = $a->nama_cabang_ranting ? str_replace('PCM ', '', $a->nama_cabang_ranting) : '—';
                  $wilayahName = $cabangName . ' - ' . ($a->nama_ranting ?? '—');
              }
            @endphp
            <tr>
              <td style="text-align: center; color: #6b7280; font-weight: 500;">
                {{ ($admins->currentPage() - 1) * $admins->perPage() + $loop->iteration }}
              </td>
              <td><span class="aa-role-pill {{ $roleClass }}">{{ $a->nama_role }}</span></td>
              <td style="padding-left: 40px;">
                <div class="aa-name" style="font-weight: 600; color: #111827;">{{ $a->nama_lengkap }}</div>
              </td>
              <td style="padding-left: 40px;">
                <span style="font-weight: 500; color: #374151;">{{ $wilayahName }}</span>
              </td>
              <td style="text-align: center; vertical-align: middle;">
                <div style="display: flex; flex-direction: column; gap: 6px; align-items: center;">
                  <button type="button" class="btn-detail-outline"
                    data-nama="{{ $a->nama_lengkap }}"
                    data-username="{{ $a->username }}"
                    data-email="{{ $a->email ?? '-' }}"
                    data-hp="{{ $a->no_hp ?? '-' }}"
                    data-role="{{ $a->nama_role }}"
                    data-cabang="{{ $a->id_role === 'R01' ? $a->nama_cabang_direct : ($a->id_role === 'R03' ? $a->nama_cabang_ranting : '-') }}"
                    data-ranting="{{ $a->id_role === 'R03' ? $a->nama_ranting : '-' }}"
                    onclick="openDetailModal(this)">
                    Detail
                  </button>
                  <form method="POST" action="{{ url('/superadmin/akun-admin/'.$a->id_user.'/delete') }}" style="display:block; width: 100%;">
                    @csrf
                    <button type="submit" class="btn-hapus-outline" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#9ca3af;padding:30px;">Tidak ada data akun ditemukan.</td></tr>
            @endforelse
          </tbody>
        </table>

        <div class="aa-pagination">
          <span>Menampilkan {{ $admins->firstItem() ?? 0 }}-{{ $admins->lastItem() ?? 0 }} dari {{ $admins->total() }} Admin</span>
          <div style="display:flex;gap:8px;">
            <a href="{{ $admins->previousPageUrl() ?? '#' }}" class="aa-page-btn {{ $admins->onFirstPage() ? 'disabled' : '' }}">Sebelumnya</a>
            <a href="{{ $admins->nextPageUrl() ?? '#' }}" class="aa-page-btn primary {{ !$admins->hasMorePages() ? 'disabled' : '' }}">Berikutnya</a>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

{{-- ── MODAL: TAMBAH AKUN BARU ── --}}
<div class="aa-modal-overlay" id="aaModalOverlay" onclick="closeOnBgAkun(event)">
  <div class="aa-modal-box">

    <div class="aa-modal-header">
      <h3><i class="ti ti-user-plus" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Akun Administrator</h3>
      <button class="aa-modal-close" onclick="closeAkunModal()"><i class="ti ti-x"></i></button>
    </div>

    <form method="POST" action="{{ url('/superadmin/akun-admin') }}">
      @csrf
      <div class="aa-modal-body">

        <div class="aa-form-group">
          <label>Nama Lengkap <span class="req">*</span></label>
          <input type="text" name="nama_lengkap" placeholder="Contoh: H. Ahmad Zaki, M.Pd" required>
        </div>

        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Username <span class="req">*</span></label>
            <input type="text" name="username" placeholder="ahmad_zaki_pcm" required>
          </div>
          <div class="aa-form-group">
            <label>Password Awal <span class="req">*</span></label>
            <input type="text" name="password" placeholder="Minimal 6 karakter" required>
          </div>
        </div>

        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="nama@pdmbatam.or.id">
          </div>
          <div class="aa-form-group">
            <label>No. HP</label>
            <input type="text" name="no_hp" id="aaNoHpInput" placeholder="08xx-xxxx-xxxx">
          </div>
        </div>

        <div class="aa-form-group">
          <label>Peran <span class="req">*</span></label>
          <select name="id_role" id="aaRoleSelect" required onchange="toggleUnitField()">
            <option value="">— Pilih Peran —</option>
            <option value="R01">Admin Cabang (PCM)</option>
            <option value="R03">Admin Ranting (PRM)</option>

          </select>
        </div>

        <div class="aa-form-group" id="aaBranchGroup" style="display:none;">
          <label id="aaBranchLabel">Kecamatan (Cabang) <span class="req">*</span></label>
          <select name="kecamatan_cabang" id="aaBranchSelect">
            <option value="">— Pilih Kecamatan —</option>
            <option value="Batam Kota">Batam Kota</option>
            <option value="Nongsa">Nongsa</option>
            <option value="Bengkong">Bengkong</option>
            <option value="Batu Ampar">Batu Ampar</option>
            <option value="Sekupang">Sekupang</option>
            <option value="Lubuk Baja">Lubuk Baja</option>
            <option value="Sei Beduk">Sei Beduk</option>
            <option value="Batu Aji">Batu Aji</option>
            <option value="Sagulung">Sagulung</option>
            <option value="Galang">Galang</option>
            <option value="Bulang">Bulang</option>
            <option value="Belakang Padang">Belakang Padang</option>
          </select>
        </div>

        <div class="aa-form-group" id="aaRantingGroup" style="display:none;">
          <label>Kelurahan (Ranting) <span class="req">*</span></label>
          <select name="nama_ranting" id="aaRantingSelect">
            <option value="">— Pilih Kelurahan —</option>
          </select>
        </div>

      </div>

      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeAkunModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Akun</button>
      </div>
    </form>

  </div>
</div>

<!-- ── MODAL DETAIL AKUN ── -->
<div class="aa-modal-overlay" id="detailModalOverlay" onclick="closeOnBgDetail(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-user" style="margin-right:6px;color:#1e6b3f;"></i>Detail Akun Administrator</h3>
      <button class="aa-modal-close" onclick="closeDetailModal()"><i class="ti ti-x"></i></button>
    </div>
    <div class="aa-modal-body">
      <div class="aa-form-row-2">
        <div class="aa-form-group">
          <label>Nama Lengkap</label>
          <input type="text" id="detailNama" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
        </div>
        <div class="aa-form-group">
          <label>Username</label>
          <input type="text" id="detailUsername" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
        </div>
      </div>

      <div class="aa-form-row-2">
        <div class="aa-form-group">
          <label>Email</label>
          <input type="text" id="detailEmail" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
        </div>
        <div class="aa-form-group">
          <label>No. HP</label>
          <input type="text" id="detailHp" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
        </div>
      </div>

      <div class="aa-form-group">
        <label>Peran</label>
        <input type="text" id="detailRole" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
      </div>

      <div class="aa-form-group" id="detailBranchGroup">
        <label id="detailBranchLabel">Kecamatan (Cabang)</label>
        <input type="text" id="detailCabang" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
      </div>

      <div class="aa-form-group" id="detailRantingGroup">
        <label>Kelurahan (Ranting)</label>
        <input type="text" id="detailRanting" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
      </div>
    </div>
    <div class="aa-modal-footer">
      <button type="button" class="aa-btn-cancel" onclick="closeDetailModal()">Tutup</button>
    </div>
  </div>
</div>

<script>
function openAkunModal() {
  document.getElementById('aaModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeAkunModal() {
  document.getElementById('aaModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgAkun(e) {
  if (e.target === document.getElementById('aaModalOverlay')) closeAkunModal();
}
const BATAM_WILAYAH = {
  "Batam Kota": ["Baloi Permai", "Belian", "Sukajadi", "Sungai Panas", "Taman Baloi", "Teluk Tering"],
  "Batu Aji": ["Bukit Tempayan", "Buliang", "Kibing", "Tanjung Uncang"],
  "Batu Ampar": ["Batu Merah", "Kampung Seraya", "Sungai Jodoh", "Tanjung Sengkuang"],
  "Belakang Padang": ["Kasu", "Pecong", "Pemping", "Pulau Terong", "Sekanak Raya", "Tanjung Sari"],
  "Bengkong": ["Bengkong Indah", "Bengkong Laut", "Sadai", "Tanjung Buntung"],
  "Bulang": ["Batu Legong", "Bulang Lintang", "Pantai Gelam", "Pulau Buluh", "Setokok", "Temoyong"],
  "Galang": ["Air Raja", "Galang Baru", "Karas", "Pulau Abang", "Rempang Cate", "Sembulang", "Sijantung", "Subang Mas"],
  "Lubuk Baja": ["Baloi Indah", "Batu Selicin", "Kampung Pelita", "Lubuk Baja Kota", "Tanjung Uma"],
  "Nongsa": ["Batu Besar", "Kabil", "Ngenang", "Sambau"],
  "Sagulung": ["Sagulung Kota", "Sungai Binti", "Sungai Langkai", "Sungai Lekop", "Sungai Pelunggut", "Tembesi"],
  "Sei Beduk": ["Duriangkang", "Mangsang", "Muka Kuning", "Tanjung Piayu"],
  "Sekupang": ["Patam Lestari", "Sungai Harapan", "Tanjung Pinggir", "Tanjung Riau", "Tiban Baru", "Tiban Indah", "Tiban Lama"]
};

function populateKelurahan(kecSelectId, kelSelectId, defaultValue) {
  const selectedKec = document.getElementById(kecSelectId).value;
  const kelSelect = document.getElementById(kelSelectId);
  
  const defaultLabel = kelSelectId === 'filterRantingSelect' ? 'Semua Ranting (PRM)' : '— Pilih Kelurahan —';
  kelSelect.innerHTML = `<option value="">${defaultLabel}</option>`;
  
  if (selectedKec && BATAM_WILAYAH[selectedKec]) {
    BATAM_WILAYAH[selectedKec].forEach(function (kel) {
      const opt = document.createElement('option');
      opt.value = kel;
      opt.innerText = kel;
      if (kel === defaultValue) {
        opt.selected = true;
      }
      kelSelect.appendChild(opt);
    });
  }
}

// Init Filter Ranting pada load page
const initialFilterCabang = "{{ request('cabang') }}";
const initialFilterRanting = "{{ request('ranting') }}";
if (initialFilterCabang) {
  populateKelurahan('filterCabangSelect', 'filterRantingSelect', initialFilterRanting);
}

// Event Listeners
document.getElementById('filterCabangSelect').addEventListener('change', function () {
  populateKelurahan('filterCabangSelect', 'filterRantingSelect', '');
});

document.getElementById('aaBranchSelect').addEventListener('change', function () {
  populateKelurahan('aaBranchSelect', 'aaRantingSelect', '');
});

function toggleUnitField() {
  const role = document.getElementById('aaRoleSelect').value;
  const branchGroup = document.getElementById('aaBranchGroup');
  const rantingGroup = document.getElementById('aaRantingGroup');
  const branchLabel = document.getElementById('aaBranchLabel');
  const branchSelect = document.getElementById('aaBranchSelect');
  const rantingInput = document.getElementById('aaRantingSelect');
  
  if (role === 'R01') {
    branchGroup.style.display = 'block';
    branchLabel.innerHTML = 'Kecamatan (Cabang) <span class="req">*</span>';
    branchSelect.required = true;
    rantingGroup.style.display = 'none';
    rantingInput.required = false;
  } else if (role === 'R03') {
    branchGroup.style.display = 'block';
    branchLabel.innerHTML = 'Cabang Induk (Kecamatan) <span class="req">*</span>';
    branchSelect.required = true;
    rantingGroup.style.display = 'block';
    rantingInput.required = true;
  } else {
    branchGroup.style.display = 'none';
    branchSelect.required = false;
    rantingGroup.style.display = 'none';
    rantingInput.required = false;
  }
}
document.addEventListener('keydown', e => { 
  if (e.key === 'Escape') {
    closeAkunModal(); 
    closeDetailModal(); 
  } 
});

function openDetailModal(btn) {
  document.getElementById('detailNama').value = btn.getAttribute('data-nama');
  document.getElementById('detailUsername').value = btn.getAttribute('data-username');
  document.getElementById('detailEmail').value = btn.getAttribute('data-email');
  document.getElementById('detailHp').value = btn.getAttribute('data-hp');
  document.getElementById('detailRole').value = btn.getAttribute('data-role');
  
  const cabang = btn.getAttribute('data-cabang');
  const ranting = btn.getAttribute('data-ranting');
  const isRanting = ranting !== '-';

  if (isRanting) {
    document.getElementById('detailBranchGroup').style.display = 'block';
    document.getElementById('detailBranchLabel').innerText = 'Cabang Induk (Kecamatan)';
    document.getElementById('detailCabang').value = cabang.replace('PCM ', '');
    document.getElementById('detailRantingGroup').style.display = 'block';
    document.getElementById('detailRanting').value = ranting.replace('PRM ', '');
  } else if (cabang !== '-') {
    document.getElementById('detailBranchGroup').style.display = 'block';
    document.getElementById('detailBranchLabel').innerText = 'Kecamatan (Cabang)';
    document.getElementById('detailCabang').value = cabang.replace('PCM ', '');
    document.getElementById('detailRantingGroup').style.display = 'none';
  } else {
    document.getElementById('detailBranchGroup').style.display = 'none';
    document.getElementById('detailRantingGroup').style.display = 'none';
  }
  
  document.getElementById('detailModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
  document.getElementById('detailModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

function closeOnBgDetail(e) {
  if (e.target === document.getElementById('detailModalOverlay')) closeDetailModal();
}

const hpInput = document.getElementById('aaNoHpInput');
if (hpInput) {
  hpInput.addEventListener('input', function (e) {
    let val = e.target.value.replace(/\D/g, '');
    let formatted = '';
    if (val.length > 0) {
      formatted += val.substring(0, 4);
    }
    if (val.length > 4) {
      formatted += '-' + val.substring(4, 8);
    }
    if (val.length > 8) {
      formatted += '-' + val.substring(8, 13);
    }
    e.target.value = formatted;
  });
}
</script>
</body>
</html>