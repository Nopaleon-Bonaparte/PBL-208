<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --green-900: #0d2b1a;
  --green-800: #133d27;
  --green-700: #1a5233;
  --green-600: #1e6b3f;
  --green-500: #27864f;
  --green-400: #3aaa65;
  --green-300: #6ec991;
  --green-100: #d6f0e0;
  --green-50:  #eef8f2;
  --gold:      #b8942a;
  --gold-light:#e8c547;
  --amber-bg:  #fef3c7;
  --amber-text:#92400e;
  --red-text:  #b91c1c;
  --red-bg:    #fee2e2;
  --gray-50:   #f6f8eb;
  --gray-100:  #f1f3f5;
  --gray-200:  #e9ecef;
  --gray-300:  #dee2e6;
  --gray-400:  #ced4da;
  --gray-500:  #adb5bd;
  --gray-600:  #868e96;
  --gray-700:  #495057;
  --gray-800:  #343a40;
  --gray-900:  #212529;
  --sidebar-w: 220px;
  --topbar-h:  56px;
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 14px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,.06);
  --shadow-md: 0 4px 12px rgba(0,0,0,.08);
}

html, body { height: 100%; font-family: 'Plus Jakarta Sans', sans-serif; background: #f6f8eb; color: var(--gray-900); font-size: 14px; }

/* ── SHELL ────────────────────────────────── */
.app-shell { display: flex; height: 100vh; overflow: hidden; }

/* ── SIDEBAR ─────────────────────────────── */
.sidebar {
  width: var(--sidebar-w);
  background: #fff;
  border-right: 1px solid var(--gray-200);
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  overflow-y: auto;
  padding: 0 0 16px;
}
.sidebar-profile {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 20px 16px 16px;
  border-bottom: 1px solid var(--gray-100);
  margin-bottom: 8px;
}
.sidebar-avatar {
  width: 38px; height: 38px;
  border-radius: var(--radius-sm);
  background: var(--green-100);
  color: var(--green-700);
  font-weight: 700;
  font-size: 13px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.sidebar-info .sidebar-name { font-weight: 600; font-size: 13px; color: var(--gray-800); line-height: 1.3; }
.sidebar-info .sidebar-sub  { font-size: 11px; color: var(--gray-500); }

.nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 16px;
  color: var(--gray-600);
  text-decoration: none;
  font-size: 13px; font-weight: 500;
  border-radius: 0;
  border-left: 3px solid transparent;
  transition: all .15s;
  cursor: pointer;
}
.nav-item i { font-size: 18px; flex-shrink: 0; }
.nav-item:hover { background: var(--green-50); color: var(--green-700); }
.nav-item.active {
  background: var(--green-50);
  color: var(--green-700);
  border-left-color: var(--green-500);
  font-weight: 600;
}
.nav-spacer { flex: 1; }
.logout-item { margin-top: auto; color: var(--gray-500); }
.logout-item:hover { color: var(--red-text); background: var(--red-bg); }

/* ── MAIN AREA ───────────────────────────── */
.main-shell { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

/* ── TOPBAR ──────────────────────────────── */
.topbar {
  height: var(--topbar-h);
  background: var(--green-800);
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 24px;
  flex-shrink: 0;
  gap: 16px;
}
.topbar-left { display: flex; align-items: center; gap: 20px; }
.topbar-brand { color: var(--gold-light); font-weight: 700; font-size: 15px; letter-spacing: .01em; white-space: nowrap; }
.topbar-links { display: flex; gap: 4px; }
.topbar-link {
  color: rgba(255,255,255,.65);
  text-decoration: none;
  font-size: 13px; font-weight: 500;
  padding: 6px 10px;
  border-radius: var(--radius-sm);
  transition: all .15s;
}
.topbar-link:hover { color: #fff; }
.topbar-link.active { color: var(--gold-light); border-bottom: 2px solid var(--gold-light); border-radius: 0; }

.topbar-right { display: flex; align-items: center; gap: 10px; }
.search-box {
  display: flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,.1);
  border: 1px solid rgba(255,255,255,.15);
  border-radius: 20px;
  padding: 5px 14px;
  width: 200px;
}
.search-box i { color: rgba(255,255,255,.5); font-size: 15px; }
.search-box input { background: none; border: none; outline: none; color: #fff; font-size: 13px; width: 100%; }
.search-box input::placeholder { color: rgba(255,255,255,.4); }
.topbar-icon-btn {
  background: none; border: none; cursor: pointer;
  color: rgba(255,255,255,.65); font-size: 18px;
  display: flex; align-items: center; justify-content: center;
  padding: 6px;
  border-radius: var(--radius-sm);
  transition: color .15s;
}
.topbar-icon-btn:hover { color: #fff; }

/* ── PAGE CONTENT ────────────────────────── */
.page-content { flex: 1; overflow-y: auto; padding: 28px 32px; background: #f6f8eb; }

/* ── BREADCRUMB ──────────────────────────── */
.breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-500); margin-bottom: 18px; }
.breadcrumb a { color: var(--gray-500); text-decoration: none; }
.breadcrumb a:hover { color: var(--green-600); }
.breadcrumb .sep { color: var(--gray-400); }
.breadcrumb .current { color: var(--gray-700); font-weight: 500; }

/* ── PAGE HEADER ─────────────────────────── */
.page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 16px; }
.page-header-left h1 { font-size: 22px; font-weight: 700; color: var(--gray-900); line-height: 1.2; }
.page-header-left p  { font-size: 13px; color: var(--gray-500); margin-top: 4px; }

/* ── BUTTONS ─────────────────────────────── */
.btn {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 9px 18px; border-radius: var(--radius-md);
  font-size: 13px; font-weight: 600; cursor: pointer;
  border: none; text-decoration: none; transition: all .15s;
  white-space: nowrap;
}
.btn i { font-size: 16px; }
.btn-primary   { background: var(--green-700); color: #fff; }
.btn-primary:hover { background: var(--green-600); }
.btn-secondary { background: #fff; color: var(--gray-700); border: 1px solid var(--gray-300); }
.btn-secondary:hover { background: #f6f8eb; }
.btn-sm { padding: 6px 12px; font-size: 12px; }
.btn-icon { padding: 8px; border-radius: var(--radius-sm); }

/* ── STAT CARDS ──────────────────────────── */
.stat-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.stat-card {
  background: #fff;
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  padding: 18px 20px;
  position: relative;
  overflow: hidden;
}
.stat-card.urgent { border-color: var(--gold); }
.stat-card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px; }
.stat-card-icon {
  width: 40px; height: 40px;
  border-radius: var(--radius-md);
  background: var(--green-50);
  display: flex; align-items: center; justify-content: center;
}
.stat-card-icon i { font-size: 20px; color: var(--green-600); }
.stat-card.urgent .stat-card-icon { background: #fef9e7; }
.stat-card.urgent .stat-card-icon i { color: var(--gold); }
.stat-pill {
  font-size: 11px; font-weight: 600; padding: 3px 8px;
  border-radius: 20px; white-space: nowrap;
}
.pill-green  { background: var(--green-100); color: var(--green-700); }
.pill-blue   { background: #dbeafe; color: #1d4ed8; }
.pill-amber  { background: var(--amber-bg); color: var(--amber-text); }
.pill-red    { background: var(--red-bg); color: var(--red-text); }
.pill-gray   { background: var(--gray-100); color: var(--gray-600); }
.stat-label { font-size: 12px; color: var(--gray-500); font-weight: 500; margin-bottom: 4px; }
.stat-value { font-size: 28px; font-weight: 700; color: var(--gray-900); line-height: 1; }

/* ── CARDS ───────────────────────────────── */
.card {
  background: #fff;
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  overflow: hidden;
}
.card-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid var(--gray-100);
}
.card-title { font-size: 15px; font-weight: 700; color: var(--gray-800); }
.card-body  { padding: 20px; }
.card-link  { font-size: 13px; color: var(--green-600); font-weight: 600; text-decoration: none; }
.card-link:hover { color: var(--green-700); text-decoration: underline; }

/* ── TWO-COL GRID ────────────────────────── */
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.grid-3 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

/* ── TABLE ───────────────────────────────── */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; font-size: 13px; }
thead th {
  text-align: left; padding: 10px 16px;
  font-size: 11px; font-weight: 600; color: var(--gray-500);
  text-transform: uppercase; letter-spacing: .05em;
  background: #f6f8eb; border-bottom: 1px solid var(--gray-200);
}
tbody td { padding: 13px 16px; border-bottom: 1px solid var(--gray-100); color: var(--gray-700); vertical-align: middle; }
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover { background: #f6f8eb; }

/* ── STATUS BADGES ───────────────────────── */
.badge {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 3px 10px; border-radius: 20px;
  font-size: 11px; font-weight: 700; letter-spacing: .03em;
}
.badge::before { content:''; width:7px; height:7px; border-radius:50%; flex-shrink:0; }
.badge-aktif        { background: #dcfce7; color: #15803d; }
.badge-aktif::before { background: #22c55e; }
.badge-kurang       { background: #fef3c7; color: #b45309; }
.badge-kurang::before { background: #f59e0b; }
.badge-vakum        { background: var(--gray-100); color: var(--gray-600); }
.badge-vakum::before { background: var(--gray-400); }
.badge-pending      { background: #fef3c7; color: #b45309; }
.badge-pending::before { background: #f59e0b; }
.badge-disetujui    { background: #dcfce7; color: #15803d; }
.badge-disetujui::before { background: #22c55e; }
.badge-ditolak      { background: var(--red-bg); color: var(--red-text); }
.badge-ditolak::before { background: #ef4444; }
.badge-masjid       { background: var(--green-50); color: var(--green-800); }
.badge-musholla     { background: #e0f2fe; color: #0369a1; }
.badge-wakaf        { background: #fef3c7; color: #92400e; }
.badge-proses       { background: #fef9c3; color: #854d0e; }
.badge-belum        { background: var(--red-bg); color: var(--red-text); }

/* ── FORM ELEMENTS ───────────────────────── */
label { font-size: 12px; font-weight: 600; color: var(--gray-700); display: block; margin-bottom: 5px; }
input[type=text], input[type=email], input[type=number], input[type=tel],
textarea, select {
  width: 100%; padding: 9px 12px;
  border: 1px solid var(--gray-300); border-radius: var(--radius-sm);
  font-size: 13px; color: var(--gray-800); font-family: inherit;
  background: #fff; outline: none; transition: border .15s;
}
input:focus, textarea:focus, select:focus { border-color: var(--green-500); box-shadow: 0 0 0 3px rgba(39,134,79,.1); }
input::placeholder, textarea::placeholder { color: var(--gray-400); }
.form-group { margin-bottom: 14px; }
.form-row { display: grid; gap: 12px; }
.form-row-2 { grid-template-columns: 1fr 1fr; }
.form-row-3 { grid-template-columns: 1fr 1fr 1fr; }
.form-section { margin-bottom: 22px; }
.form-section-title {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: var(--gray-800);
  margin-bottom: 14px;
}
.form-section-title i { font-size: 17px; color: var(--green-600); }
.radio-group { display: flex; gap: 20px; }
.radio-group label { display: flex; align-items: center; gap: 6px; font-weight: 400; cursor: pointer; margin-bottom: 0; }

/* ── PROGRESS BAR ────────────────────────── */
.progress-bar-wrap { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
.progress-label { font-size: 13px; color: var(--gray-700); min-width: 80px; }
.progress-track { flex: 1; height: 8px; background: var(--gray-100); border-radius: 4px; overflow: hidden; }
.progress-fill  { height: 100%; border-radius: 4px; background: var(--green-500); transition: width .4s; }
.progress-pct   { font-size: 12px; font-weight: 600; color: var(--gray-700); min-width: 30px; text-align: right; }

/* ── CHART-LIKE BARS ─────────────────────── */
.demo-bar { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
.demo-bar-label { font-size: 12px; color: var(--gray-600); width: 90px; }
.demo-bar-track { flex: 1; height: 9px; background: var(--gray-100); border-radius: 4px; overflow: hidden; }
.demo-bar-fill  { height: 100%; border-radius: 4px; }
.demo-bar-pct   { font-size: 12px; font-weight: 600; color: var(--gray-700); min-width: 36px; text-align: right; }

/* ── ALERT / BANNER ──────────────────────── */
.alert {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 12px 16px; border-radius: var(--radius-md);
  font-size: 13px; margin-bottom: 20px;
}
.alert-warning { background: var(--amber-bg); color: var(--amber-text); border-left: 3px solid #f59e0b; }
.alert i { font-size: 17px; flex-shrink: 0; margin-top: 1px; }

/* ── FAB ─────────────────────────────────── */
a.fab {
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  font-size: 24px;  /* ← tambahkan ini */
}
.fab:hover { background: var(--green-600); }

/* ── FAB AS LINK ─────────────────────────── */
.fab {
  position: fixed; bottom: 28px; right: 28px;
  width: 52px; height: 52px; border-radius: 50%;
  background: var(--green-700); color: #fff;
  border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 24px; box-shadow: 0 4px 16px rgba(27,94,54,.35);
  transition: background .15s;
  text-decoration: none;
}
.fab:hover { background: var(--green-600); }

/* ── PAGINATION ──────────────────────────── */
.pagination { display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; border-top: 1px solid var(--gray-100); font-size: 13px; color: var(--gray-600); }
.pagination-pages { display: flex; gap: 4px; }
.pagination-btn {
  width: 30px; height: 30px; border-radius: var(--radius-sm);
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 500; cursor: pointer;
  border: 1px solid var(--gray-200); background: #f6f8eb; color: var(--gray-700);
  transition: all .15s;
}
.pagination-btn:hover { border-color: var(--green-400); color: var(--green-700); }
.pagination-btn.active { background: var(--green-700); border-color: var(--green-700); color: #f6f8eb; }

/* ── UPLOAD ZONE ─────────────────────────── */
.upload-zone {
  border: 2px dashed var(--gray-300); border-radius: var(--radius-md);
  padding: 28px 20px; text-align: center; cursor: pointer;
  transition: border .15s; margin-bottom: 12px;
}
.upload-zone:hover { border-color: var(--green-400); background: var(--green-50); }
.upload-zone i { font-size: 32px; color: var(--gray-400); margin-bottom: 8px; display: block; }
.upload-zone p  { font-size: 12px; color: var(--gray-500); }
.upload-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 14px; border: 1px solid var(--gray-200);
  border-radius: var(--radius-sm); margin-bottom: 8px; font-size: 13px;
}
.upload-row .file-info { display: flex; align-items: center; gap: 8px; color: var(--gray-700); }
.upload-row .file-info i { color: var(--green-600); }
.upload-done { color: var(--green-600); font-size: 18px; }

/* ── MINI STAT CARDS ─────────────────────── */
.mini-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; padding: 16px 20px; border-bottom: 1px solid var(--gray-100); }
.mini-stat-card { border: 1px solid var(--gray-200); border-radius: var(--radius-md); padding: 12px 14px; }
.mini-stat-card .msc-top { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
.mini-stat-card .msc-icon { width: 30px; height: 30px; border-radius: var(--radius-sm); background: var(--green-50); display: flex; align-items: center; justify-content: center; }
.mini-stat-card .msc-icon i { font-size: 16px; color: var(--green-600); }
.mini-stat-card .msc-label { font-size: 10px; color: var(--gray-500); text-transform: uppercase; letter-spacing: .05em; font-weight: 600; }
.mini-stat-card .msc-val   { font-size: 22px; font-weight: 700; color: var(--gray-900); }

/* ── FILTER BAR ──────────────────────────── */
.filter-bar { display: flex; align-items: center; gap: 8px; padding: 12px 20px; border-bottom: 1px solid var(--gray-100); flex-wrap: nowrap; overflow-x: auto; }
.filter-search { display: flex; align-items: center; gap: 8px; flex: 0 0 auto; width: 180px; border: 1px solid var(--gray-300); border-radius: var(--radius-sm); padding: 7px 12px; background: #fff; }
.filter-search i { font-size: 15px; color: var(--gray-400); flex-shrink: 0; }
.filter-search input { border: none; outline: none; font-size: 13px; color: var(--gray-700); background: none; width: 100%; min-width: 0; }
.filter-btn { display: inline-flex; align-items: center; gap: 5px; padding: 7px 12px; border: 1px solid var(--gray-300); border-radius: var(--radius-sm); background: #fff; font-size: 12px; font-weight: 500; color: var(--gray-600); cursor: pointer; white-space: nowrap; flex-shrink: 0; }
.filter-btn::after { content: ''; display: inline-block; width: 0; height: 0; border-left: 4px solid transparent; border-right: 4px solid transparent; border-top: 5px solid var(--gray-400); margin-left: 2px; }
.filter-btn:hover { border-color: var(--green-400); color: var(--green-700); }
.filter-btn:hover::after { border-top-color: var(--green-500); }
.filter-btn-icon { padding: 7px; }
.filter-btn-icon::after { display: none; }

/* ── MASJID GRID ─────────────────────────── */
.masjid-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 20px; }
.masjid-card {
  border: 1px solid var(--gray-200); border-radius: var(--radius-md);
  overflow: hidden; transition: box-shadow .15s;
}
.masjid-card:hover { box-shadow: var(--shadow-md); }
.masjid-card-top { display: flex; gap: 12px; padding: 14px; }
.masjid-card-icon {
  width: 44px; height: 44px; border-radius: var(--radius-sm);
  background: var(--green-50); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.masjid-card-icon i { font-size: 22px; color: var(--green-600); }
.masjid-card-meta { display: flex; gap: 12px; padding: 0 14px 10px; font-size: 12px; color: var(--gray-600); }
.masjid-card-meta span { display: flex; align-items: center; gap: 4px; }
.masjid-card-footer { border-top: 1px solid var(--gray-100); padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; }
.masjid-card-badge-row { padding: 0 14px 10px; display: flex; align-items: center; gap: 8px; }
.completeness-bar { display: flex; flex-direction: column; gap: 3px; flex: 1; }
.completeness-track { height: 4px; background: var(--gray-100); border-radius: 2px; overflow: hidden; }
.completeness-fill  { height: 100%; border-radius: 2px; }
.fill-green  { background: var(--green-500); }
.fill-yellow { background: #f59e0b; }
.fill-red    { background: #ef4444; }
.completeness-label { font-size: 10px; color: var(--gray-500); font-weight: 500; }

/* ── STATISTIK PAGE ──────────────────────── */
.stats-header { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:22px; gap:16px; }
.stats-header-left h1 { font-size:20px; font-weight:700; color:var(--gray-900); }
.stats-header-right { display:flex; gap:10px; align-items:center; }
.date-picker-btn { display:flex; align-items:center; gap:7px; padding:8px 14px; border:1px solid var(--gray-300); border-radius:var(--radius-sm); background:#fff; font-size:13px; color:var(--gray-700); cursor:pointer; }
.top-metrics { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px; }
.metric-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:16px 18px; }
.metric-card .mc-label { font-size:10px; font-weight:700; color:var(--gray-400); text-transform:uppercase; letter-spacing:.07em; margin-bottom:8px; display:flex; align-items:center; justify-content:space-between; }
.metric-card .mc-label i { font-size:16px; color:var(--green-500); }
.metric-card .mc-val   { font-size:28px; font-weight:700; color:var(--gray-900); line-height:1; }
.metric-card .mc-sub   { font-size:11px; color:var(--gray-500); margin-top:5px; }
.metric-card .mc-sub .up { color:var(--green-500); font-weight:600; }
.chart-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:20px; margin-bottom:16px; }
.chart-card-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
.chart-card-title { font-size:15px; font-weight:700; color:var(--gray-800); }
.chart-legend { display:flex; align-items:center; gap:7px; font-size:12px; color:var(--gray-600); }
.chart-legend-dot { width:10px; height:10px; border-radius:50%; background:var(--green-500); }
.two-col-stats { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
.section-label { font-size:11px; font-weight:600; color:var(--gray-400); text-transform:uppercase; letter-spacing:.07em; margin-bottom:10px; }
.ranting-mini { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px; }
.ranting-mini-card { background:#f6f8eb; border:1px solid var(--gray-100); border-radius:var(--radius-md); padding:12px 14px; text-align:center; }
.ranting-mini-card .rmv { font-size:22px; font-weight:700; color:var(--gray-800); }
.ranting-mini-card .rml { font-size:10px; color:var(--gray-500); text-transform:uppercase; letter-spacing:.05em; font-weight:600; }
.donut-wrap { display:flex; align-items:center; gap:20px; }
.donut-legend { display:flex; flex-direction:column; gap:8px; }
.donut-legend-item { display:flex; align-items:center; gap:8px; font-size:13px; color:var(--gray-700); }
.donut-dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; }
.proker-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:20px; }
.proker-card-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
.proker-item { display:flex; align-items:center; gap:14px; padding:13px 0; border-bottom:1px solid var(--gray-100); }
.proker-item:last-child { border-bottom:none; }
.proker-icon { width:36px; height:36px; border-radius:var(--radius-sm); background:var(--green-50); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.proker-icon i { font-size:18px; color:var(--green-600); }
.proker-info { flex:1; min-width:0; }
.proker-info h4 { font-size:13px; font-weight:700; color:var(--gray-800); margin-bottom:2px; }
.proker-info p  { font-size:11px; color:var(--gray-500); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.proker-bar-wrap { width:200px; flex-shrink:0; }
.proker-bar-row { display:flex; align-items:center; gap:8px; }
.proker-track { flex:1; height:7px; background:var(--gray-100); border-radius:4px; overflow:hidden; }
.proker-fill  { height:100%; border-radius:4px; background:var(--green-500); }
.proker-pct   { font-size:13px; font-weight:700; color:var(--green-700); min-width:34px; text-align:right; }

/* ── FORM CARD (sub-branches) ────────────── */
.form-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:22px 24px; margin-bottom:18px; }
.form-card-title { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; color:var(--gray-800); margin-bottom:18px; }
.form-card-title i { font-size:17px; color:var(--green-600); }
.summary-card { background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-lg); overflow:hidden; margin-bottom:16px; }
.summary-card-header { background:var(--green-700); color:#fff; padding:12px 16px; font-size:13px; font-weight:600; }
.summary-body { padding:14px 16px; }
.checklist-item { display:flex; align-items:center; gap:8px; font-size:13px; padding:5px 0; }
.checklist-item i { font-size:16px; }
.check-done   { color:var(--green-500); }
.check-warn   { color:#f59e0b; }
.check-miss   { color:var(--gray-400); }
.completeness-ring { text-align:center; margin-bottom:12px; }
.note-box { background:var(--green-50); border:1px solid var(--green-100); border-radius:var(--radius-sm); padding:12px 14px; font-size:12px; color:var(--green-800); margin-top:10px; }
.note-box strong { display:block; margin-bottom:3px; }
.autosave { font-size:12px; color:var(--gray-400); display:flex; align-items:center; gap:5px; }
.form-footer { display:flex; align-items:center; justify-content:space-between; padding:18px 0 0; border-top:1px solid var(--gray-100); margin-top:8px; }

/* ── SCROLL FIX ──────────────────────────── */
.overflow-y { overflow-y: auto; }
</style>
