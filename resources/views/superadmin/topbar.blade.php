<style>
.topbar {
  height: var(--topbar-h, 56px);
  background: #fff;
  border-bottom: 1px solid var(--gray-200, #e5e7eb);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  flex-shrink: 0;
  gap: 16px;
  font-family: 'Inter', sans-serif;
}
.topbar-left { display: flex; align-items: center; gap: 6px; }
.topbar-breadcrumb {
  display: flex; align-items: center; gap: 6px;
  font-size: 13px; color: #6b7280;
}
.topbar-breadcrumb .bc-icon { font-size: 15px; color: #9ca3af; display: flex; align-items: center; }
.topbar-breadcrumb .bc-sep  { font-size: 13px; color: #d1d5db; }
.topbar-breadcrumb .bc-current { font-weight: 700; color: #1f2937; font-size: 13px; }
.topbar-breadcrumb a { color: #6b7280; text-decoration: none; font-size: 13px; transition: color .15s; }
.topbar-breadcrumb a:hover { color: #1e6b3f; }
.topbar-right { display: flex; align-items: center; gap: 6px; }
.tb-icon-btn {
  width: 34px; height: 34px;
  background: none; border: none; cursor: pointer;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: #6b7280; font-size: 17px;
  transition: background .15s, color .15s;
  text-decoration: none;
}
.tb-icon-btn:hover { background: #f3f4f6; color: #1f2937; }
.tb-divider { width: 1px; height: 20px; background: #e5e7eb; margin: 0 4px; }
.tb-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: #1e6b3f; color: #fff;
  font-size: 13px; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; flex-shrink: 0; border: none;
}
.tb-chevron { color: #9ca3af; font-size: 15px; display: flex; align-items: center; cursor: pointer; }
.tb-profile-wrap { position: relative; display: flex; align-items: center; gap: 2px; }
.tb-profile-popup {
  position: absolute; top: calc(100% + 12px); right: 0;
  width: 320px; background: #fff;
  border: 1px solid #e5e7eb; border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0,0,0,.1);
  padding: 16px 18px; z-index: 200; display: none;
  font-family: 'Inter', sans-serif;
}
.tb-profile-popup.show { display: block; }
.tb-popup-header {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: #1f2937;
  padding-bottom: 12px; margin-bottom: 12px;
  border-bottom: 1px solid #f3f4f6;
}
.tb-popup-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 12px; margin-bottom: 10px; }
.tb-popup-field label {
  font-size: 10px; font-weight: 600; color: #9ca3af;
  text-transform: uppercase; letter-spacing: .04em;
  display: block; margin-bottom: 4px;
}
.tb-popup-value {
  border: 1px solid #e5e7eb; border-radius: 7px;
  padding: 7px 10px; font-size: 12.5px; color: #1f2937;
  background: #f9fafb;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>

<header class="topbar">
  {{-- LEFT: breadcrumb --}}
  <div class="topbar-left">
    <nav class="topbar-breadcrumb">
      <span class="bc-icon"><i class="ti ti-home"></i></span>
      <span class="bc-sep">›</span>
      <a href="{{ url('/dashboard') }}">Superadmin</a>
      <span class="bc-sep">›</span>
      <span class="bc-current">
        @php
          $saNavLabels = [
            'dashboard'      => 'Ringkasan Utama',
            'persetujuan'    => 'Antrian Persetujuan',
            'status-cabang'  => 'Status Cabang',
            'status-ranting' => 'Status Ranting',
            'status-masjid'  => 'Status Masjid',
            'akun-admin'     => 'Manajemen Akun',
          ];
          echo $saNavLabels[$activeTopLink ?? ''] ?? 'Dashboard';
        @endphp
      </span>
    </nav>
  </div>

  {{-- RIGHT: icons + avatar --}}
  <div class="topbar-right">
    <a href="{{ url('/superadmin/status-cabang') }}" class="tb-icon-btn"><i class="ti ti-settings"></i></a>
    <div class="tb-divider"></div>
    <div class="tb-profile-wrap" id="saProfileWrap">
      <button class="tb-avatar" onclick="toggleSaProfile(event)">
        {{ strtoupper(substr(session('username', 'S'), 0, 1)) }}
      </button>
      <span class="tb-chevron" onclick="toggleSaProfile(event)"><i class="ti ti-chevron-down"></i></span>
      <div class="tb-profile-popup" id="saProfilePopup">
        <div class="tb-popup-header">
          <i class="ti ti-user"></i> Profile Superadmin
        </div>
        <div class="tb-popup-grid">
          <div class="tb-popup-field">
            <label>Nama</label>
            <div class="tb-popup-value">{{ session('nama_lengkap', session('username', 'Superadmin')) }}</div>
          </div>
          <div class="tb-popup-field">
            <label>Role</label>
            <div class="tb-popup-value">Superadmin</div>
          </div>
        </div>
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="width:100%;padding:8px;background:#1e6b3f;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;">
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
function toggleSaProfile(e) {
  e.stopPropagation();
  document.getElementById('saProfilePopup').classList.toggle('show');
}
document.addEventListener('click', function(e) {
  const wrap = document.getElementById('saProfileWrap');
  const popup = document.getElementById('saProfilePopup');
  if (popup && popup.classList.contains('show') && !wrap.contains(e.target)) {
    popup.classList.remove('show');
  }
});
</script>