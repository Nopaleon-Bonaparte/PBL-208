<style>
@keyframes nav-shake {
  0%   { transform: translateX(0); }
  20%  { transform: translateX(-5px); }
  40%  { transform: translateX(5px); }
  60%  { transform: translateX(-4px); }
  80%  { transform: translateX(4px); }
  100% { transform: translateX(0); }
}
.nav-item.shaking {
  animation: nav-shake 0.35s ease;
}

/* ── SIDEBAR HEADER ── */
.sidebar-header {
  padding: 16px 14px 14px;
  border-bottom: 1px solid var(--gray-100);
  margin-bottom: 8px;
}
.sidebar-app {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 10px;
}
.sidebar-app-icon {
  width: 36px; height: 36px; border-radius: 10px;
  background: #1e6b3f;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.sidebar-app-icon i { color: #fff; font-size: 18px; }
.sidebar-app-name {
  font-size: 13px; font-weight: 700; color: var(--gray-900); line-height: 1.3;
}

.sidebar-org {
  display: flex; align-items: center; gap: 10px;
  padding: 8px 10px;
  border-radius: 10px;
  background: var(--gray-50);
  border: 1px solid var(--gray-100);
}
.sidebar-org-icon {
  width: 28px; height: 28px; border-radius: 8px;
  background: #1e6b3f;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  font-size: 12px; font-weight: 700; color: #fff;
}
.sidebar-org-name {
  font-size: 12.5px; font-weight: 600; color: var(--gray-700);
}
</style>

<aside class="sidebar">

  {{-- ── HEADER: App + Org ── --}}
  <div class="sidebar-header">
    {{-- App name --}}
    <div class="sidebar-app">
      <div class="sidebar-app-icon">
        <i class="ti ti-building-community"></i>
      </div>
      <span class="sidebar-app-name">Pimpinan Cabang<br>Muhammadiyah</span>
    </div>

    {{-- Org / cabang --}}
    <div class="sidebar-org">
      <div class="sidebar-org-icon">P</div>
      <span class="sidebar-org-name">PCM Batam Kota</span>
    </div>
  </div>

  <a href="{{ url('/pcm/membership') }}"
     class="nav-item {{ ($activeNav ?? '') === 'dashboard' ? 'active' : '' }}">
    <i class="ti ti-layout-dashboard"></i><span>Dashboard</span>
  </a>

  <a href="{{ url('/pcm/sub-branches') }}"
     class="nav-item {{ ($activeNav ?? '') === 'sub-branches' ? 'active' : '' }}">
    <i class="ti ti-building-mosque"></i><span>Data Masjid</span>
  </a>

  <a href="{{ url('/pcm/persetujuan') }}"
     class="nav-item {{ ($activeNav ?? '') === 'persetujuan' ? 'active' : '' }}">
    <i class="ti ti-checkup-list"></i><span>Antrian Persetujuan</span>
  </a>

  <a href="{{ url('/pcm/legal-status') }}"
     class="nav-item {{ ($activeNav ?? '') === 'legal-status' ? 'active' : '' }}">
    <i class="ti ti-certificate"></i><span>Manajemen Masjid</span>
  </a>

  <div class="nav-spacer"></div>

  <a href="{{ url('/pcm/settings') }}"
     class="nav-item {{ ($activeNav ?? '') === 'settings' ? 'active' : '' }}">
    <i class="ti ti-settings"></i><span>Pengaturan</span>
  </a>

  <form method="POST" action="{{ url('/logout') }}" style="margin:0;padding:0;">
    @csrf
    <button type="submit" class="nav-item logout-item"
            style="width:100%;background:none;border:none;cursor:pointer;
                   font-family:inherit;text-align:left;font-size:13px;
                   font-weight:500;color:var(--gray-500);
                   transition:background .15s,color .15s;"
            onmouseenter="this.style.background='#fff5f5';this.style.color='#dc2626';"
            onmouseleave="this.style.background='none';this.style.color='var(--gray-500)';"
            onmousedown="this.style.background='#fee2e2';this.style.color='#b91c1c';"
            onmouseup="this.style.background='#fff5f5';this.style.color='#dc2626';">
      <i class="ti ti-logout"></i><span>Logout</span>
    </button>
  </form>

</aside>

<script>
document.querySelectorAll('.nav-item').forEach(function(item) {
  item.addEventListener('click', function() {
    this.classList.remove('shaking');
    void this.offsetWidth;
    this.classList.add('shaking');
  });
});
</script>