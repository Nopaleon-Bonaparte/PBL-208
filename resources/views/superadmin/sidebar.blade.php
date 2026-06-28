<style>
.sa-sidebar {
  width: 220px;
  background: #fff;
  border-right: 1px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  overflow-y: auto;
  font-family: 'Inter', sans-serif;
}
.sa-sidebar-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 18px 18px 14px;
  border-bottom: 1px solid #f3f4f6;
}
.sa-sidebar-logo-icon {
  width: 36px; height: 36px;
  background: #1e6b3f; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.sa-sidebar-logo-icon i { color: #fff; font-size: 20px; }
.sa-sidebar-logo-text { line-height: 1.2; }
.sa-sidebar-logo-text strong { font-size: 13px; font-weight: 700; color: #1f2937; }
.sa-sidebar-logo-text span { font-size: 10px; color: #9ca3af; display: block; }

.sa-nav { padding: 12px 10px; flex: 1; }
.sa-nav-label {
  font-size: 10px; font-weight: 700; color: #9ca3af;
  letter-spacing: .07em; text-transform: uppercase;
  padding: 0 8px; margin: 14px 0 6px;
}
.sa-nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 8px 10px; border-radius: 8px;
  font-size: 13px; font-weight: 500; color: #4b5563;
  text-decoration: none;
  transition: background .15s, color .15s;
  cursor: pointer;
}
.sa-nav-item i { font-size: 17px; flex-shrink: 0; }
.sa-nav-item:hover { background: #f0fdf4; color: #1e6b3f; }
.sa-nav-item.active { background: #f0fdf4; color: #1e6b3f; font-weight: 700; }

.sa-sidebar-footer {
  padding: 12px 10px;
  border-top: 1px solid #f3f4f6;
}
</style>

<aside class="sa-sidebar">
  <div class="sa-sidebar-logo">
    <div class="sa-sidebar-logo-icon">
      <i class="ti ti-building-mosque"></i>
    </div>
    <div class="sa-sidebar-logo-text">
      <strong>Pimpinan Daerah<br>Muhammadiyah</strong>
      <span>Superadmin</span>
    </div>
  </div>

  <nav class="sa-nav">
    <div class="sa-nav-label">Dashboard</div>
    <a href="{{ url('/dashboard') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'dashboard' ? 'active' : '' }}">
      <i class="ti ti-layout-dashboard"></i> Ringkasan Utama
    </a>

    <div class="sa-nav-label">Persetujuan</div>
    <a href="{{ url('/superadmin/persetujuan') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'persetujuan' ? 'active' : '' }}">
      <i class="ti ti-clipboard-check"></i> Antrian Persetujuan
    </a>

    <div class="sa-nav-label">Monitoring</div>
    <a href="{{ url('/superadmin/status-cabang') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'status-cabang' ? 'active' : '' }}">
      <i class="ti ti-building-community"></i> Status Cabang
    </a>
    <a href="{{ url('/superadmin/status-ranting') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'status-ranting' ? 'active' : '' }}">
      <i class="ti ti-home-2"></i> Status Ranting
    </a>
    <a href="{{ url('/superadmin/status-masjid') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'status-masjid' ? 'active' : '' }}">
      <i class="ti ti-building-mosque"></i> Status Masjid
    </a>

    <div class="sa-nav-label">Administrasi</div>
    <a href="{{ url('/superadmin/akun-admin') }}"
       class="sa-nav-item {{ ($activeNav ?? '') === 'akun-admin' ? 'active' : '' }}">
      <i class="ti ti-users-group"></i> Manajemen Akun
    </a>
  </nav>

  <div class="sa-sidebar-footer">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="sa-nav-item" style="width:100%;border:none;background:none;cursor:pointer;color:#ef4444;">
        <i class="ti ti-logout"></i> Logout
      </button>
    </form>
  </div>
</aside>