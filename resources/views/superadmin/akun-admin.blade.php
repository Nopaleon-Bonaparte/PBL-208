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

.aa-stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
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

      <div class="flex justify-between items-end mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Akun Administrator</h2>
          <p class="text-gray-500 font-medium mt-1">Kelola hak akses dan identitas untuk admin Cabang, Ranting, dan Masjid di lingkungan PDM Kota Batam.</p>
        </div>
        <div class="flex items-center gap-2">
          <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg font-semibold text-sm shadow-sm transition flex items-center gap-2" onclick="openCabangModal()">
            <i class="ti ti-building-community"></i> Tambah Cabang
          </button>
          <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg font-semibold text-sm shadow-sm transition flex items-center gap-2" onclick="openRantingModal()">
            <i class="ti ti-git-branch"></i> Tambah Ranting
          </button>
          <button class="bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-lg font-semibold text-sm shadow transition flex items-center gap-2" onclick="openAkunModal()">
            <i class="ti ti-plus"></i> Tambah Akun Baru
          </button>
        </div>
      </div>

      @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg font-medium flex items-center gap-2">
          <i class="ti ti-circle-check"></i> {{ session('success') }}
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
        <div class="aa-stat-card">
          <div><div class="aa-stat-label">Admin Masjid</div><div class="aa-stat-val">{{ $totalMasjid }}</div></div>
          <i class="ti ti-building-mosque aa-stat-icon"></i>
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
          <option value="R02" {{ request('role') === 'R02' ? 'selected' : '' }}>Admin Masjid</option>
        </select>
        <select name="unit" class="aa-select" onchange="this.form.submit()">
          <option value="">Semua Unit PCM/PRM</option>
          @foreach($daftarCabang as $c)
            <option value="{{ $c->id_cabang }}" {{ request('unit') === $c->id_cabang ? 'selected' : '' }}>{{ $c->nama_cabang }}</option>
          @endforeach
        </select>
      </form>

      {{-- ── TABLE ── --}}
      <div class="aa-table-card">
        <table class="aa-table">
          <thead>
            <tr>
              <th>Nama & Username</th>
              <th>Peran</th>
              <th>Unit Organisasi</th>
              <th>Login Terakhir</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($admins as $a)
            @php
              $roleClass = match($a->id_role) { 'R01' => 'rp-cabang', 'R03' => 'rp-ranting', default => 'rp-masjid' };
              $unitName = $a->nama_masjid ?? $a->nama_ranting ?? $a->nama_cabang ?? '—';
              $loginText = $a->terakhir_login ? \Carbon\Carbon::parse($a->terakhir_login)->diffForHumans() : 'Belum pernah login';
              $statusDot = $a->status_akun === 'Aktif' ? 'sd-aktif' : 'sd-nonaktif';
            @endphp
            <tr>
              <td>
                <div class="aa-name">{{ $a->nama_lengkap ?? $a->username }}</div>
                <div class="aa-username">{{ $a->username }}</div>
              </td>
              <td><span class="aa-role-pill {{ $roleClass }}">{{ $a->nama_role }}</span></td>
              <td>{{ $unitName }}</td>
              <td><span class="aa-status-dot {{ $statusDot }}"></span>{{ $loginText }}</td>
              <td>{{ $a->status_akun }}</td>
              <td>
                <button class="aa-action-icon ai-edit" title="Edit"><i class="ti ti-pencil"></i></button>
                <form method="POST" action="{{ url('/superadmin/akun-admin/'.$a->id_user.'/reset-password') }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="aa-action-icon ai-reset" title="Reset Password" onclick="return confirm('Reset password akun ini ke default?');"><i class="ti ti-key"></i></button>
                </form>
                <form method="POST" action="{{ url('/superadmin/akun-admin/'.$a->id_user.'/toggle-status') }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="aa-action-icon ai-block" title="{{ $a->status_akun === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }}" onclick="return confirm('Ubah status akun ini?');"><i class="ti ti-ban"></i></button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#9ca3af;padding:30px;">Tidak ada data akun ditemukan.</td></tr>
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
            <input type="text" name="no_hp" placeholder="08xx-xxxx-xxxx">
          </div>
        </div>

        <div class="aa-form-group">
          <label>Peran <span class="req">*</span></label>
          <select name="id_role" id="aaRoleSelect" required onchange="toggleUnitField()">
            <option value="">— Pilih Peran —</option>
            <option value="R01">Admin Cabang (PCM)</option>
            <option value="R03">Admin Ranting (PRM)</option>
            <option value="R02">Admin Masjid (Pengurus Masjid)</option>
          </select>
        </div>

        <div class="aa-form-group" id="aaUnitRantingField" style="display:none;">
          <label>Ranting (PRM)</label>
          <select name="id_ranting">
            <option value="">— Pilih Ranting —</option>
            @foreach(\Illuminate\Support\Facades\DB::table('ranting')->get() as $r)
              <option value="{{ $r->id_ranting }}">{{ $r->nama_ranting }}</option>
            @endforeach
          </select>
        </div>

        <div class="aa-form-group" id="aaUnitMasjidField" style="display:none;">
          <label>Masjid yang Dikelola</label>
          <select name="id_masjid">
            <option value="">— Pilih Masjid —</option>
            @foreach(\Illuminate\Support\Facades\DB::table('masjid')->where('wilayah', '!=', null)->get() as $m)
              <option value="{{ $m->id_masjid }}">{{ $m->nama_masjid }} ({{ $m->wilayah }})</option>
            @endforeach
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

<!-- ── MODAL TAMBAH CABANG ── -->
<div class="aa-modal-overlay" id="cabangModalOverlay" onclick="closeOnBgCabang(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-building-community" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Cabang Baru</h3>
      <button class="aa-modal-close" onclick="closeCabangModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/superadmin/cabang') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Nama Cabang (PCM) <span class="req">*</span></label>
          <input type="text" name="nama_cabang" placeholder="Contoh: PCM Batu Aji" required>
        </div>
        <div class="aa-form-group">
          <label>Wilayah</label>
          <input type="text" name="wilayah" placeholder="Kota Batam" value="Kota Batam">
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeCabangModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Cabang</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL TAMBAH RANTING ── -->
<div class="aa-modal-overlay" id="rantingModalOverlay" onclick="closeOnBgRanting(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-git-branch" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Ranting Baru</h3>
      <button class="aa-modal-close" onclick="closeRantingModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/superadmin/ranting') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Nama Ranting (PRM) <span class="req">*</span></label>
          <input type="text" name="nama_ranting" placeholder="Contoh: PRM Bukit Indah" required>
        </div>
        <div class="aa-form-group">
          <label>Cabang Induk <span class="req">*</span></label>
          <select name="id_cabang" required>
            <option value="">— Pilih Cabang —</option>
            @foreach(\Illuminate\Support\Facades\DB::table('cabang')->get() as $c)
              <option value="{{ $c->id_cabang }}">{{ $c->nama_cabang }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeRantingModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Ranting</button>
      </div>
    </form>
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
function toggleUnitField() {
  const role = document.getElementById('aaRoleSelect').value;
  document.getElementById('aaUnitRantingField').style.display = (role === 'R01' || role === 'R03') ? 'block' : 'none';
  document.getElementById('aaUnitMasjidField').style.display = (role === 'R02') ? 'block' : 'none';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAkunModal(); });

function openCabangModal() { document.getElementById('cabangModalOverlay').classList.add('open'); document.body.style.overflow='hidden'; }
function closeCabangModal() { document.getElementById('cabangModalOverlay').classList.remove('open'); document.body.style.overflow=''; }
function closeOnBgCabang(e) { if (e.target === document.getElementById('cabangModalOverlay')) closeCabangModal(); }

function openRantingModal() { document.getElementById('rantingModalOverlay').classList.add('open'); document.body.style.overflow='hidden'; }
function closeRantingModal() { document.getElementById('rantingModalOverlay').classList.remove('open'); document.body.style.overflow=''; }
function closeOnBgRanting(e) { if (e.target === document.getElementById('rantingModalOverlay')) closeRantingModal(); }
</script>
</body>
</html>