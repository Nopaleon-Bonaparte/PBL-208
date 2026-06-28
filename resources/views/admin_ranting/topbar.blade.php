<style>
.topbar {
  height: var(--topbar-h);
  background: #fff;
  border-bottom: 1px solid var(--gray-200);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
  flex-shrink: 0;
  gap: 16px;
}
.topbar-left { display: flex; align-items: center; gap: 6px; }
.topbar-breadcrumb {
  display: flex; align-items: center; gap: 6px;
  font-size: 13px; color: var(--gray-500);
}
.topbar-breadcrumb .bc-icon { font-size: 15px; color: var(--gray-400); display: flex; align-items: center; }
.topbar-breadcrumb .bc-sep  { font-size: 13px; color: var(--gray-300); }
.topbar-breadcrumb .bc-current { font-weight: 700; color: var(--gray-800); font-size: 13px; }
.topbar-breadcrumb a { color: var(--gray-500); text-decoration: none; font-size: 13px; transition: color .15s; }
.topbar-breadcrumb a:hover { color: var(--green-600); }

.topbar-center { flex: 1; display: flex; justify-content: flex-end; padding-right: 28px; }
.topbar-search {
  display: flex; align-items: center; gap: 8px;
  background: var(--gray-100);
  border: 1px solid var(--gray-200);
  border-radius: 20px;
  padding: 5px 14px;
  width: 260px;
  transition: border .15s, box-shadow .15s;
}
.topbar-search:focus-within {
  border-color: var(--green-400);
  box-shadow: 0 0 0 3px rgba(39,134,79,.08);
}
.topbar-search i { color: var(--gray-400); font-size: 14px; }
.topbar-search input {
  background: none; border: none; outline: none;
  font-size: 12.5px; color: var(--gray-800); width: 100%; font-family: inherit;
}
.topbar-search input::placeholder { color: var(--gray-400); }

.topbar-right { display: flex; align-items: center; gap: 6px; }
.tb-icon-btn {
  width: 34px; height: 34px;
  background: none; border: none; cursor: pointer;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--gray-500); font-size: 17px;
  transition: background .15s, color .15s;
  position: relative;
}
.tb-icon-btn:hover { background: var(--gray-100); color: var(--gray-800); }
.tb-icon-btn { text-decoration: none; }
.tb-notif-dot {
  position: absolute; top: 5px; right: 5px;
  width: 8px; height: 8px;
  background: #ef4444; border-radius: 50%; border: 2px solid #fff;
}
.tb-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: #1e6b3f; color: #fff;
  font-size: 13px; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; flex-shrink: 0; border: none;
}
.tb-divider { width: 1px; height: 20px; background: var(--gray-200); margin: 0 4px; }
.tb-chevron { color: var(--gray-400); font-size: 15px; display: flex; align-items: center; cursor: pointer; }

/* PROFILE POPUP */
.tb-profile-wrap { position: relative; display: flex; align-items: center; gap: 2px; }

.tb-profile-popup {
  position: absolute;
  top: calc(100% + 12px);
  right: 0;
  width: 360px;
  background: #fff;
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  padding: 16px 18px;
  z-index: 200;
  display: none;
  font-family: inherit;
}
.tb-profile-popup.show { display: block; }

.tb-popup-header {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: var(--gray-800);
  padding-bottom: 12px; margin-bottom: 12px;
  border-bottom: 1px solid var(--gray-100);
}
.tb-popup-header i { font-size: 17px; color: var(--green-700); }

.tb-popup-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 12px; margin-bottom: 10px; }
.tb-popup-field.full { grid-column: 1 / -1; }
.tb-popup-field label {
  font-size: 10px; font-weight: 600; color: var(--gray-400);
  text-transform: uppercase; letter-spacing: .04em;
  display: block; margin-bottom: 4px;
}
.tb-popup-value {
  border: 1px solid var(--gray-200); border-radius: var(--radius-sm);
  padding: 7px 10px; font-size: 12.5px; color: var(--gray-800);
  background: var(--gray-50, #f8f9fa);
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
</style>

<header class="topbar">

  {{-- LEFT: breadcrumb --}}
  <div class="topbar-left">
    <nav class="topbar-breadcrumb">
      <span class="bc-icon"><i class="ti ti-home"></i></span>
      <span class="bc-sep">›</span>
      <a href="{{ url('/prm/membership') }}">Pages</a>
      <span class="bc-sep">›</span>
      <span class="bc-current">
        @php
          $navLabels = [
            'dashboard'      => 'Dashboard',
            'data-masjid'    => 'Data Masjid',
            'legalitas'      => 'Legalitas Status',
            'status-ranting' => 'Status Ranting',
            'financials'     => 'Statistik',
            'settings'       => 'Pengaturan',
          ];
          echo $navLabels[$activeTopLink ?? ''] ?? 'Dashboard';
        @endphp
      </span>
    </nav>
  </div>

  {{-- CENTER: search --}}
  <div class="topbar-center">
    <div class="topbar-search">
      <i class="ti ti-search"></i>
      <input type="text" placeholder="Search items, categories, or more..."/>
    </div>
  </div>

  {{-- RIGHT: icons --}}
  <div class="topbar-right">
    <a href="{{ url('/prm/settings') }}" class="tb-icon-btn"><i class="ti ti-settings"></i></a>
    <div class="tb-divider"></div>

    <div class="tb-profile-wrap" id="profileWrap">
      <button class="tb-avatar" onclick="toggleProfilePopup(event)">
        {{ strtoupper(substr(session('username', 'A'), 0, 1)) }}
      </button>
      <span class="tb-chevron" onclick="toggleProfilePopup(event)"><i class="ti ti-chevron-down"></i></span>

      <div class="tb-profile-popup" id="profilePopup">
        <div class="tb-popup-header">
          <i class="ti ti-user"></i> Profile Information
        </div>
        <div class="tb-popup-grid">
          <div class="tb-popup-field">
            <label>Full Name</label>
            <div class="tb-popup-value">{{ session('nama_lengkap', session('username', '-')) }}</div>
          </div>
          <div class="tb-popup-field">
            <label>Email Address</label>
            <div class="tb-popup-value">{{ session('email', '-') }}</div>
          </div>
          <div class="tb-popup-field">
            <label>Phone</label>
            <div class="tb-popup-value">{{ session('phone', '-') }}</div>
          </div>
          <div class="tb-popup-field">
            <label>Cabang</label>
            <div class="tb-popup-value">{{ session('nama_cabang', '-') }}</div>
          </div>
        </div>
        <div class="tb-popup-field full">
          <label>Address</label>
          <div class="tb-popup-value">{{ session('alamat', '-') }}</div>
        </div>
      </div>
    </div>
  </div>

</header>

<script>
function toggleProfilePopup(e) {
  e.stopPropagation();
  document.getElementById('profilePopup').classList.toggle('show');
}
document.addEventListener('click', function(e) {
  const wrap = document.getElementById('profileWrap');
  const popup = document.getElementById('profilePopup');
  if (popup.classList.contains('show') && !wrap.contains(e.target)) {
    popup.classList.remove('show');
  }
});
</script>