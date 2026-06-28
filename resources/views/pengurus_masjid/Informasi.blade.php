<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Informasi Masjid — Panel Pengurus Masjid</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family: 'Inter', sans-serif; }

/* ── HERO HEADER ── */
.masjid-hero {
  background: linear-gradient(135deg, #1a4d33 0%, #0f3322 100%);
  border-radius: 16px;
  padding: 24px 28px;
  color: #fff;
  margin-bottom: 20px;
  display: flex; justify-content: space-between; align-items: flex-start;
  gap: 24px;
}
.hero-badges { display: flex; gap: 8px; margin-bottom: 10px; }
.hero-badge {
  font-size: 11px; font-weight: 700; padding: 3px 11px;
  border-radius: 999px; letter-spacing: .02em;
}
.hb-masjid { background: rgba(255,255,255,.15); color: #a7f3d0; }
.hb-wakaf  { background: #f59e0b; color: #fff; }
.hb-pbb    { background: rgba(255,255,255,.12); color: #e5e7eb; }
.hero-title { font-size: 26px; font-weight: 700; margin-bottom: 6px; }
.hero-loc { font-size: 13px; color: #cfe8da; display: flex; align-items: center; gap: 6px; }
.hero-stats { display: flex; gap: 10px; flex-shrink: 0; }
.hero-stat {
  background: rgba(255,255,255,.08);
  border-radius: 10px;
  padding: 10px 18px;
  text-align: center;
  min-width: 80px;
}
.hero-stat-label { font-size: 10.5px; color: #cfe8da; text-transform: uppercase; letter-spacing: .03em; margin-bottom: 4px; }
.hero-stat-val { font-size: 19px; font-weight: 700; }

/* ── TABS ── */
.masjid-tabs {
  display: flex; gap: 28px;
  border-bottom: 1px solid var(--gray-200);
  margin-bottom: 24px;
  padding: 0 4px;
}
.masjid-tab {
  padding: 10px 2px 12px;
  font-size: 13.5px; font-weight: 600; color: var(--gray-500);
  border-bottom: 2px solid transparent;
  cursor: pointer; transition: color .15s, border-color .15s;
  background: none; border-left: none; border-right: none; border-top: none;
  font-family: inherit;
}
.masjid-tab:hover { color: var(--green-600); }
.masjid-tab.active { color: var(--green-700); border-bottom-color: var(--green-700); }

.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* ── INFORMASI TAB ── */
.info-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 20px; }
.info-card {
  background: #fff; border: 1px solid var(--gray-200); border-radius: 14px;
  padding: 22px; margin-bottom: 20px;
}
.info-card h3 {
  font-size: 15px; font-weight: 700; color: var(--green-700);
  margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between;
}
.info-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px; }
.info-field label { font-size: 11px; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: .03em; display: block; margin-bottom: 4px; }
.info-field .val { font-size: 14px; font-weight: 600; color: var(--gray-900); }
.info-field .val.sm { font-size: 13px; font-weight: 500; color: var(--gray-700); }

.map-placeholder {
  height: 200px; border-radius: 10px;
  background:
    radial-gradient(circle at center, transparent 0, transparent 7px, var(--gray-100) 7px, var(--gray-100) 8px, transparent 8px),
    var(--gray-50);
  background-size: 22px 22px;
  border: 1px solid var(--gray-200);
  display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 6px;
  color: var(--gray-500); font-size: 12.5px; margin-top: 10px;
}
.map-pin { width: 28px; height: 28px; border-radius: 50%; border: 3px solid var(--green-600); display: flex; align-items: center; justify-content: center; color: var(--green-600); font-size: 14px; }

.gallery-main {
  width: 100%; height: 150px; border-radius: 10px;
  background: linear-gradient(135deg, var(--green-100), var(--green-200));
  display: flex; align-items: flex-end; padding: 10px;
  position: relative; overflow: hidden; margin-bottom: 10px;
}
.gallery-main .gtag { background: rgba(0,0,0,.55); color: #fff; font-size: 11px; padding: 4px 10px; border-radius: 6px; }
.gallery-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.gallery-thumb {
  height: 76px; border-radius: 8px;
  background: linear-gradient(135deg, var(--green-50), var(--green-100));
  display: flex; align-items: flex-end; padding: 8px;
  font-size: 10.5px; color: var(--gray-600); font-weight: 600;
}
.gallery-thumb.more {
  background: var(--gray-50); border: 1px dashed var(--gray-300);
  align-items: center; justify-content: center; flex-direction: column; gap: 2px; color: var(--gray-400);
}

.completeness-row { margin-bottom: 14px; }
.completeness-row:last-of-type { margin-bottom: 18px; }
.cr-top { display: flex; justify-content: space-between; font-size: 12.5px; margin-bottom: 6px; }
.cr-top span:first-child { color: var(--gray-700); font-weight: 500; }
.cr-top span:last-child { font-weight: 700; }
.cr-bar { height: 7px; border-radius: 999px; background: var(--gray-100); overflow: hidden; }
.cr-fill { height: 100%; border-radius: 999px; }
.btn-complete {
  width: 100%; padding: 10px; border: 1.5px solid var(--green-600);
  border-radius: 10px; background: #fff; color: var(--green-700);
  font-weight: 700; font-size: 13px; cursor: pointer; font-family: inherit;
  transition: background .15s;
}
.btn-complete:hover { background: var(--green-50); }

.verify-footer {
  display: flex; justify-content: space-between; align-items: center;
  background: #fff; border: 1px solid var(--gray-200); border-radius: 14px;
  padding: 14px 22px;
}
.verify-left { display: flex; align-items: center; gap: 14px; }
.verify-badge {
  display: flex; align-items: center; gap: 6px;
  background: var(--green-50); color: var(--green-700);
  font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;
}
.verify-meta { font-size: 12.5px; color: var(--gray-500); }
.verify-actions { display: flex; align-items: center; gap: 18px; }
.verify-actions a { font-size: 13px; font-weight: 600; color: var(--green-700); text-decoration: none; }
.btn-print {
  display: flex; align-items: center; gap: 6px;
  background: var(--green-800); color: #fff; padding: 9px 18px; border-radius: 10px;
  font-size: 13px; font-weight: 700; cursor: pointer; border: none; font-family: inherit;
}

/* ── INVENTARIS TAB ── */
.inv-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.inv-header h2 { font-size: 20px; font-weight: 700; color: var(--gray-900); }
.btn-download {
  display: flex; align-items: center; gap: 6px;
  background: var(--green-800); color: #fff; padding: 10px 18px; border-radius: 10px;
  font-size: 13px; font-weight: 700; cursor: pointer; border: none; font-family: inherit;
}
.inv-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px; }
.inv-stat-card {
  background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 18px 20px;
}
.inv-stat-icon {
  width: 36px; height: 36px; border-radius: 10px; margin-bottom: 12px;
  display: flex; align-items: center; justify-content: center; font-size: 17px;
}
.isi-gray  { background: var(--gray-100); color: var(--gray-600); }
.isi-green { background: var(--green-50); color: var(--green-700); }
.isi-amber { background: #fff7ed; color: #d97706; }
.isi-yellow{ background: #fffbeb; color: #ca8a04; }
.inv-stat-label { font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .03em; margin-bottom: 4px; }
.inv-stat-val { font-size: 24px; font-weight: 700; color: var(--gray-900); }

.inv-table-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; }
.inv-table-head { display: flex; justify-content: space-between; align-items: center; padding: 18px 22px; border-bottom: 1px solid var(--gray-100); }
.inv-table-head h3 { font-size: 15px; font-weight: 700; color: var(--gray-900); }
.inv-search { display: flex; align-items: center; gap: 8px; background: var(--gray-100); border: 1px solid var(--gray-200); border-radius: 8px; padding: 7px 12px; width: 220px; }
.inv-search input { background: none; border: none; outline: none; font-size: 13px; width: 100%; font-family: inherit; }
.inv-filter-btn { width: 36px; height: 36px; border: 1px solid var(--gray-200); border-radius: 8px; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--gray-600); margin-left: 8px; }
.inv-table { width: 100%; border-collapse: collapse; }
.inv-table th { text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .03em; padding: 12px 22px; border-bottom: 1px solid var(--gray-100); }
.inv-table td { padding: 14px 22px; font-size: 13.5px; color: var(--gray-800); border-bottom: 1px solid var(--gray-100); }
.inv-table tr:last-child td { border-bottom: none; }
.cat-pill { font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 999px; }
.cat-sound { background: #eff6ff; color: #1d4ed8; }
.cat-elektronik { background: #f5f3ff; color: #7c3aed; }
.cat-sarana { background: #fffbeb; color: #b45309; }
.kondisi-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; margin-right: 6px; }
.kd-baik { background: #10b981; }
.kd-perbaikan { background: #f59e0b; }
.kd-rusak { background: #ef4444; }
.inv-action-icon { width: 30px; height: 30px; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; margin-right: 4px; }
.ia-edit { background: var(--green-50); color: var(--green-700); }
.ia-delete { background: #fef2f2; color: #dc2626; }
.inv-pagination { display: flex; justify-content: space-between; align-items: center; padding: 14px 22px; font-size: 12.5px; color: var(--gray-500); }
.inv-pagination .pages { display: flex; gap: 4px; }
.pg-btn { width: 28px; height: 28px; border: 1px solid var(--gray-200); border-radius: 6px; background: #fff; display: flex; align-items: center; justify-content: center; font-size: 12.5px; cursor: pointer; color: var(--gray-700); }
.pg-btn.active { background: var(--green-700); color: #fff; border-color: var(--green-700); }

/* ── TAKMIR TAB ── */
.takmir-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.takmir-header h2 { font-size: 18px; font-weight: 700; color: var(--gray-900); }
.takmir-tools { display: flex; gap: 8px; }
.tt-btn { width: 36px; height: 36px; border: 1px solid var(--gray-200); border-radius: 8px; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--gray-600); }
.tt-btn.add { background: var(--green-700); color: #fff; border-color: var(--green-700); }

.takmir-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px; }
.takmir-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 18px; }
.takmir-avatar {
  width: 52px; height: 52px; border-radius: 50%; margin-bottom: 12px;
  background: linear-gradient(135deg, var(--green-100), var(--green-300));
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; font-weight: 700; color: var(--green-800);
}
.takmir-name { font-size: 14px; font-weight: 700; color: var(--gray-900); margin-bottom: 6px; line-height: 1.3; }
.takmir-role { font-size: 10.5px; font-weight: 700; padding: 3px 10px; border-radius: 999px; display: inline-block; margin-bottom: 10px; }
.tr-ketua { background: var(--green-700); color: #fff; }
.tr-sekretaris, .tr-bendahara { background: var(--gray-100); color: var(--gray-700); }
.tr-seksi { background: #fffbeb; color: #92400e; }
.takmir-contact { font-size: 12px; color: var(--gray-600); display: flex; align-items: center; gap: 6px; margin-bottom: 5px; }
.takmir-card.add-card {
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  border: 1.5px dashed var(--gray-300); cursor: pointer; color: var(--gray-400); gap: 8px;
  font-size: 12.5px; font-weight: 600;
}
.takmir-card.add-card .plus-icon {
  width: 40px; height: 40px; border-radius: 50%; background: var(--gray-100);
  display: flex; align-items: center; justify-content: center; font-size: 18px;
}

.takmir-meta { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
.tm-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 16px 20px; display: flex; align-items: center; gap: 12px; }
.tm-icon { width: 36px; height: 36px; border-radius: 10px; background: var(--green-50); color: var(--green-700); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.tm-label { font-size: 10.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .03em; }
.tm-val { font-size: 15px; font-weight: 700; color: var(--gray-900); margin-top: 2px; }

/* ── LEGALITAS TAB ── */
.legal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
.legal-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 20px; }
.legal-card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
.legal-card h4 { font-size: 14px; font-weight: 700; color: var(--gray-900); }
.legal-status-pill { font-size: 10.5px; font-weight: 700; padding: 3px 10px; border-radius: 999px; }
.lsp-done { background: var(--green-50); color: var(--green-700); }
.lsp-proses { background: #fffbeb; color: #b45309; }
.legal-card p.desc { font-size: 12.5px; color: var(--gray-500); margin-bottom: 4px; }
.legal-card .doc-no { font-size: 13px; font-weight: 600; color: var(--gray-800); }

/* ── PENGAJUAN TAB ── */
.pengajuan-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 20px; }
.pj-stat-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 18px 20px; }
.pj-stat-top { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; color: var(--gray-400); font-size: 16px; }
.pj-stat-label { font-size: 12px; font-weight: 600; color: var(--gray-500); }
.pj-stat-val { font-size: 28px; font-weight: 700; color: var(--gray-900); margin: 4px 0 2px; }
.pj-stat-sub { font-size: 11.5px; color: var(--gray-400); }

.pengajuan-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
.pj-filters { display: flex; gap: 8px; align-items: center; }
.pj-filter-pill { font-size: 12.5px; font-weight: 600; padding: 6px 14px; border-radius: 999px; border: 1px solid var(--gray-200); background: #fff; color: var(--gray-600); cursor: pointer; }
.pj-filter-pill.active { background: var(--green-700); color: #fff; border-color: var(--green-700); }
.btn-new-request { display: flex; align-items: center; gap: 6px; background: var(--green-700); color: #fff; padding: 9px 16px; border-radius: 9px; font-size: 13px; font-weight: 700; border: none; cursor: pointer; font-family: inherit; }

.pj-table-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; overflow: hidden; margin-bottom: 20px; }
.pj-table { width: 100%; border-collapse: collapse; }
.pj-table th { text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: .03em; padding: 12px 20px; border-bottom: 1px solid var(--gray-100); background: var(--gray-50); }
.pj-table td { padding: 14px 20px; font-size: 13px; color: var(--gray-800); border-bottom: 1px solid var(--gray-100); vertical-align: top; }
.pj-table tr:last-child td { border-bottom: none; }
.pj-table tr.row-highlight { background: #fffbeb; }
.pj-id { font-weight: 700; color: var(--green-700); }
.pj-jenis { display: flex; align-items: center; gap: 8px; }
.pj-status-pill { font-size: 10.5px; font-weight: 700; padding: 4px 11px; border-radius: 999px; display: inline-block; }
.ps-proses { background: #fffbeb; color: #b45309; }
.ps-disetujui { background: var(--green-50); color: var(--green-700); }
.ps-ditolak { background: #fef2f2; color: #dc2626; }
.pj-note { font-size: 12px; font-style: italic; color: var(--gray-500); }
.pj-note.warn { color: #b45309; }
.pj-note.danger { color: #dc2626; }

.flow-card { background: #fff; border: 1px solid var(--gray-200); border-radius: 14px; padding: 22px; }
.flow-card h4 { font-size: 14px; font-weight: 700; color: var(--gray-900); margin-bottom: 18px; }
.flow-steps { display: flex; align-items: flex-start; }
.flow-step { flex: 1; text-align: center; }
.flow-icon { width: 44px; height: 44px; border-radius: 12px; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.fi-done { background: var(--green-700); color: #fff; }
.fi-pending { background: var(--gray-100); color: var(--gray-400); }
.flow-step h5 { font-size: 12.5px; font-weight: 700; color: var(--gray-800); margin-bottom: 4px; }
.flow-step p { font-size: 11px; color: var(--gray-500); line-height: 1.4; padding: 0 8px; }
.flow-step.is-pending h5, .flow-step.is-pending p { color: var(--gray-400); }
</style>
</head>
<body>
<div class="app-shell">

  @include('pengurus_masjid.sidebar', ['activeNav' => 'informasi'])

  <div class="main-shell">
    @include('pengurus_masjid.topbar', ['activeTopLink' => 'informasi'])

    <main class="page-content">

      {{-- ── HERO ── --}}
      <div class="masjid-hero">
        <div>
          <div class="hero-badges">
            <span class="hero-badge hb-masjid">Masjid</span>
            <span class="hero-badge hb-wakaf">Wakaf</span>
            <span class="hero-badge hb-pbb">PBB: 12.34.56.78</span>
          </div>
          <div class="hero-title">Masjid Agung Batam</div>
          <div class="hero-loc"><i class="ti ti-map-pin"></i> Jl. Engku Putri, Kel. Belian, Kec. Batam Kota, Kota Batam, Kepulauan Riau</div>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="hero-stat-label">Kapasitas</div><div class="hero-stat-val">2.500</div></div>
          <div class="hero-stat"><div class="hero-stat-label">Takmir</div><div class="hero-stat-val">25</div></div>
          <div class="hero-stat"><div class="hero-stat-label">Inventaris</div><div class="hero-stat-val">142</div></div>
        </div>
      </div>

      {{-- ── TABS ── --}}
      <div class="masjid-tabs">
        <button class="masjid-tab active" data-tab="informasi">Informasi</button>
        <button class="masjid-tab" data-tab="inventaris">Inventaris</button>
        <button class="masjid-tab" data-tab="takmir">Takmir</button>
        <button class="masjid-tab" data-tab="legalitas">Legalitas</button>
        <button class="masjid-tab" data-tab="pengajuan">Pengajuan</button>
      </div>

      {{-- ════════════════ TAB: INFORMASI ════════════════ --}}
      <div class="tab-panel active" id="panel-informasi">
        <div class="info-grid">

          <div>
            <div class="info-card">
              <h3>Data Umum <i class="ti ti-info-circle" style="color:var(--gray-300);font-size:16px;"></i></h3>
              <div class="info-row-2">
                <div class="info-field"><label>Nama Resmi</label><div class="val">Masjid Agung Batam</div></div>
                <div class="info-field"><label>Tahun Berdiri</label><div class="val">2001</div></div>
              </div>
              <div class="info-row-2">
                <div class="info-field"><label>ID Nasional</label><div class="val">MSJ-BTM-0001</div></div>
                <div class="info-field"><label>Status Tanah</label><div class="val">Sertifikat Hak Milik (Wakaf)</div></div>
              </div>
              <div class="info-field">
                <label>Alamat Lengkap</label>
                <div class="val sm">Jl. Engku Putri No. 1, Kel. Belian, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29444</div>
              </div>
            </div>

            <div class="info-card">
              <h3>Lokasi Strategis <span style="font-size:11.5px;color:var(--gray-400);font-weight:500;">Lat: 1.1102, Long: 104.0529</span></h3>
              <div class="map-placeholder">
                <div class="map-pin"><i class="ti ti-map-pin-filled"></i></div>
                <span>Koordinat Terverifikasi</span>
              </div>
            </div>
          </div>

          <div>
            <div class="info-card">
              <h3>Foto Galeri</h3>
              <div class="gallery-main"><span class="gtag">Tampak Depan (Utama)</span></div>
              <div class="gallery-grid">
                <div class="gallery-thumb">Interior</div>
                <div class="gallery-thumb">Aerial View</div>
              </div>
              <div class="gallery-grid" style="margin-top:8px;">
                <div class="gallery-thumb">Halaman</div>
                <div class="gallery-thumb more"><i class="ti ti-camera-plus"></i> +9 Lainnya</div>
              </div>
            </div>

            <div class="info-card">
              <h3>Kelengkapan Data</h3>

              <div class="completeness-row">
                <div class="cr-top"><span>Dokumen Legalitas</span><span style="color:var(--green-700);">100%</span></div>
                <div class="cr-bar"><div class="cr-fill" style="width:100%;background:var(--green-600);"></div></div>
              </div>
              <div class="completeness-row">
                <div class="cr-top"><span>Profil & Kontak</span><span style="color:var(--green-700);">90%</span></div>
                <div class="cr-bar"><div class="cr-fill" style="width:90%;background:var(--green-600);"></div></div>
              </div>
              <div class="completeness-row">
                <div class="cr-top"><span>Struktur Takmir</span><span style="color:#b45309;">75%</span></div>
                <div class="cr-bar"><div class="cr-fill" style="width:75%;background:#d97706;"></div></div>
              </div>
              <div class="completeness-row">
                <div class="cr-top"><span>Inventaris Aset</span><span style="color:#dc2626;">45%</span></div>
                <div class="cr-bar"><div class="cr-fill" style="width:45%;background:#ef4444;"></div></div>
              </div>

              <button class="btn-complete">Lengkapi Data Sekarang</button>
            </div>
          </div>

        </div>

        <div class="verify-footer">
          <div class="verify-left">
            <span class="verify-badge"><i class="ti ti-shield-check"></i> TERVERIFIKASI PCM</span>
            <span class="verify-meta">Terakhir diperbarui: 12 Jun 2026 oleh Admin Cabang</span>
          </div>
          <div class="verify-actions">
            <a href="#"><i class="ti ti-download" style="margin-right:4px;"></i>Unduh Profil PDF</a>
            <button class="btn-print"><i class="ti ti-printer"></i> Cetak Barcode Wakaf</button>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: INVENTARIS ════════════════ --}}
      <div class="tab-panel" id="panel-inventaris">

        <div class="inv-header">
          <h2>Masjid Agung Batam — Inventaris</h2>
          <button class="btn-download"><i class="ti ti-download"></i> Unduh Laporan Inventaris</button>
        </div>

        <div class="inv-stats">
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-gray"><i class="ti ti-clipboard-list"></i></div>
            <div class="inv-stat-label">Total Aset</div>
            <div class="inv-stat-val">142</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-green"><i class="ti ti-circle-check"></i></div>
            <div class="inv-stat-label">Kondisi Baik</div>
            <div class="inv-stat-val">119</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-amber"><i class="ti ti-tool"></i></div>
            <div class="inv-stat-label">Perlu Perbaikan</div>
            <div class="inv-stat-val">17</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-yellow"><i class="ti ti-coin"></i></div>
            <div class="inv-stat-label">Nilai Aset</div>
            <div class="inv-stat-val">Rp 560jt</div>
          </div>
        </div>

        <div class="inv-table-card">
          <div class="inv-table-head">
            <h3>Daftar Inventaris</h3>
            <div style="display:flex;align-items:center;">
              <div class="inv-search"><i class="ti ti-search"></i><input type="text" placeholder="Cari aset..."/></div>
              <button class="inv-filter-btn"><i class="ti ti-filter"></i></button>
            </div>
          </div>
          <table class="inv-table">
            <thead>
              <tr><th>Nama Aset</th><th>Kategori</th><th>Kondisi</th><th>Tahun Perolehan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>Sound System Toa ZA-2150</td>
                <td><span class="cat-pill cat-sound">Sound System</span></td>
                <td><span class="kondisi-dot kd-baik"></span>Baik</td>
                <td>2022</td>
                <td><span class="inv-action-icon ia-edit"><i class="ti ti-pencil"></i></span><span class="inv-action-icon ia-delete"><i class="ti ti-trash"></i></span></td>
              </tr>
              <tr>
                <td>AC Daikin Inverter 2 PK</td>
                <td><span class="cat-pill cat-elektronik">Elektronik</span></td>
                <td><span class="kondisi-dot kd-perbaikan"></span>Perbaikan</td>
                <td>2021</td>
                <td><span class="inv-action-icon ia-edit"><i class="ti ti-pencil"></i></span><span class="inv-action-icon ia-delete"><i class="ti ti-trash"></i></span></td>
              </tr>
              <tr>
                <td>Mimbar Kayu Jati Ukir</td>
                <td><span class="cat-pill cat-sarana">Sarana</span></td>
                <td><span class="kondisi-dot kd-baik"></span>Baik</td>
                <td>2019</td>
                <td><span class="inv-action-icon ia-edit"><i class="ti ti-pencil"></i></span><span class="inv-action-icon ia-delete"><i class="ti ti-trash"></i></span></td>
              </tr>
              <tr>
                <td>Proyektor Epson EB-X06</td>
                <td><span class="cat-pill cat-elektronik">Elektronik</span></td>
                <td><span class="kondisi-dot kd-baik"></span>Baik</td>
                <td>2023</td>
                <td><span class="inv-action-icon ia-edit"><i class="ti ti-pencil"></i></span><span class="inv-action-icon ia-delete"><i class="ti ti-trash"></i></span></td>
              </tr>
              <tr>
                <td>Ampli Power Mixer Hardwell</td>
                <td><span class="cat-pill cat-sound">Sound System</span></td>
                <td><span class="kondisi-dot kd-rusak"></span>Rusak</td>
                <td>2020</td>
                <td><span class="inv-action-icon ia-edit"><i class="ti ti-pencil"></i></span><span class="inv-action-icon ia-delete"><i class="ti ti-trash"></i></span></td>
              </tr>
            </tbody>
          </table>
          <div class="inv-pagination">
            <span>Menampilkan 5 dari 142 aset</span>
            <div class="pages">
              <button class="pg-btn"><i class="ti ti-chevron-left"></i></button>
              <button class="pg-btn active">1</button>
              <button class="pg-btn">2</button>
              <button class="pg-btn">3</button>
              <button class="pg-btn"><i class="ti ti-chevron-right"></i></button>
            </div>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: TAKMIR ════════════════ --}}
      <div class="tab-panel" id="panel-takmir">

        <div class="takmir-header">
          <h2>Struktur Organisasi Takmir</h2>
          <div class="takmir-tools">
            <button class="tt-btn"><i class="ti ti-filter"></i></button>
            <button class="tt-btn add"><i class="ti ti-plus"></i></button>
          </div>
        </div>

        <div class="takmir-grid">
          <div class="takmir-card">
            <div class="takmir-avatar">HF</div>
            <div class="takmir-name">H. Farhan Saputra, M.A.</div>
            <span class="takmir-role tr-ketua">KETUA</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 812-7000-1011</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> farhan@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">DW</div>
            <div class="takmir-name">Drs. Dedi Wahyudi</div>
            <span class="takmir-role tr-sekretaris">SEKRETARIS</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 813-6500-2233</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> dedi@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">IS</div>
            <div class="takmir-name">Ir. H. Iskandar</div>
            <span class="takmir-role tr-bendahara">BENDAHARA</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 811-7700-4455</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> iskandar@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">UR</div>
            <div class="takmir-name">Ustadz Rizal Hakim</div>
            <span class="takmir-role tr-seksi">SEKSI DAKWAH</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 877-3300-6677</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> rizal@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">BS</div>
            <div class="takmir-name">Bambang Setiawan</div>
            <span class="takmir-role tr-seksi">SEKSI SARPRAS</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 856-9900-2211</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> bambang@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">HM</div>
            <div class="takmir-name">H. Maman Suherman</div>
            <span class="takmir-role tr-seksi">SEKSI SOSIAL</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 899-4400-8899</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> maman@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card">
            <div class="takmir-avatar">RP</div>
            <div class="takmir-name">Rendi Pratama</div>
            <span class="takmir-role tr-seksi">SEKSI HUMAS & IT</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> +62 815-2200-3344</div>
            <div class="takmir-contact"><i class="ti ti-mail"></i> rendi@masjidagungbatam.or.id</div>
          </div>
          <div class="takmir-card add-card">
            <div class="plus-icon"><i class="ti ti-user-plus"></i></div>
            Tambah Personel
          </div>
        </div>

        <div class="takmir-meta">
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-calendar"></i></div>
            <div><div class="tm-label">Masa Bakti</div><div class="tm-val">2024 - 2027</div></div>
          </div>
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-file-text"></i></div>
            <div><div class="tm-label">Nomor SK</div><div class="tm-val">SK/PCM-BTK/012/I/24</div></div>
          </div>
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-users"></i></div>
            <div><div class="tm-label">Total Personel</div><div class="tm-val">25 Anggota</div></div>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: LEGALITAS ════════════════ --}}
      <div class="tab-panel" id="panel-legalitas">

        <div class="legal-grid">
          <div class="legal-card">
            <div class="legal-card-top">
              <h4>Sertifikat Wakaf (AIW/APAIW)</h4>
              <span class="legal-status-pill lsp-done">Lengkap</span>
            </div>
            <p class="desc">Nomor Dokumen</p>
            <div class="doc-no">W2.BTM.05.01.2001</div>
          </div>

          <div class="legal-card">
            <div class="legal-card-top">
              <h4>SK Pendirian Masjid</h4>
              <span class="legal-status-pill lsp-done">Lengkap</span>
            </div>
            <p class="desc">Nomor Dokumen</p>
            <div class="doc-no">451/SK-PCM/BTK/2001</div>
          </div>

          <div class="legal-card">
            <div class="legal-card-top">
              <h4>IMB / PBG Bangunan</h4>
              <span class="legal-status-pill lsp-done">Lengkap</span>
            </div>
            <p class="desc">Nomor Dokumen</p>
            <div class="doc-no">IMB-2002-00871/BTM</div>
          </div>

          <div class="legal-card">
            <div class="legal-card-top">
              <h4>NPWP Lembaga</h4>
              <span class="legal-status-pill lsp-proses">Proses Pengajuan</span>
            </div>
            <p class="desc">Nomor Dokumen</p>
            <div class="doc-no">Menunggu penerbitan KPP</div>
          </div>
        </div>

        <div class="verify-footer">
          <div class="verify-left">
            <span class="verify-badge"><i class="ti ti-shield-check"></i> STATUS LEGALITAS: WAKAF SAH</span>
            <span class="verify-meta">Diverifikasi oleh Admin Cabang pada 12 Jun 2026</span>
          </div>
          <div class="verify-actions">
            <a href="#"><i class="ti ti-download" style="margin-right:4px;"></i>Unduh Semua Dokumen</a>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: PENGAJUAN ════════════════ --}}
      <div class="tab-panel" id="panel-pengajuan">

        <div class="pengajuan-stats">
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-clipboard-list"></i></div>
            <div class="pj-stat-label">Total Pengajuan</div>
            <div class="pj-stat-val">9</div>
            <div class="pj-stat-sub">Dalam kurun waktu tahun 2026</div>
          </div>
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-clock-hour-4"></i></div>
            <div class="pj-stat-label">Sedang Diproses</div>
            <div class="pj-stat-val" style="color:#b45309;">1</div>
            <div class="pj-stat-sub">Menunggu approval Admin Cabang</div>
          </div>
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-checks"></i></div>
            <div class="pj-stat-label">Tingkat Approval</div>
            <div class="pj-stat-val" style="color:var(--green-700);">88%</div>
            <div class="pj-stat-sub">8 dari 9 pengajuan disetujui</div>
          </div>
        </div>

        <div class="pengajuan-header">
          <div class="pj-filters">
            <button class="pj-filter-pill active">Semua</button>
            <button class="pj-filter-pill">Sedang Diproses</button>
            <button class="pj-filter-pill">Disetujui</button>
            <button class="pj-filter-pill">Ditolak</button>
          </div>
          <button class="btn-new-request"><i class="ti ti-plus"></i> Buat Pengajuan Baru</button>
        </div>

        <div class="pj-table-card">
          <table class="pj-table">
            <thead>
              <tr><th>ID Pengajuan</th><th>Jenis</th><th>Tanggal</th><th>Status</th><th>Catatan Admin</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr class="row-highlight">
                <td class="pj-id">#REQ-2026-091</td>
                <td><div class="pj-jenis"><i class="ti ti-file-text" style="color:var(--gray-400);"></i>Renovasi Atap Utama</div></td>
                <td>02 Jun 2026</td>
                <td><span class="pj-status-pill ps-proses">SEDANG DIPROSES</span></td>
                <td><span class="pj-note warn">Menunggu verifikasi RAB dari Admin Cabang.</span></td>
                <td><i class="ti ti-eye" style="color:var(--gray-400);cursor:pointer;"></i></td>
              </tr>
              <tr>
                <td class="pj-id">#REQ-2026-077</td>
                <td><div class="pj-jenis"><i class="ti ti-coin" style="color:var(--gray-400);"></i>Pencairan Dana Operasional</div></td>
                <td>18 Mei 2026</td>
                <td><span class="pj-status-pill ps-disetujui">DISETUJUI</span></td>
                <td><span class="pj-note">Dana telah dicairkan ke rekening masjid via Bank Syariah Indonesia.</span></td>
                <td><i class="ti ti-eye" style="color:var(--gray-400);cursor:pointer;"></i></td>
              </tr>
              <tr>
                <td class="pj-id">#REQ-2026-058</td>
                <td><div class="pj-jenis"><i class="ti ti-users" style="color:var(--gray-400);"></i>Perubahan Struktur Takmir</div></td>
                <td>30 Apr 2026</td>
                <td><span class="pj-status-pill ps-ditolak">DITOLAK</span></td>
                <td><span class="pj-note danger">SK Pengangkatan belum ditandatangani Ketua PCM. Unggah ulang dokumen yang valid.</span></td>
                <td><i class="ti ti-eye" style="color:var(--gray-400);cursor:pointer;"></i></td>
              </tr>
              <tr>
                <td class="pj-id">#REQ-2026-019</td>
                <td><div class="pj-jenis"><i class="ti ti-certificate" style="color:var(--gray-400);"></i>Update Dokumen NPWP</div></td>
                <td>10 Feb 2026</td>
                <td><span class="pj-status-pill ps-disetujui">DISETUJUI</span></td>
                <td><span class="pj-note">Berkas diteruskan ke KPP untuk proses penerbitan.</span></td>
                <td><i class="ti ti-eye" style="color:var(--gray-400);cursor:pointer;"></i></td>
              </tr>
            </tbody>
          </table>
          <div class="inv-pagination">
            <span>Menampilkan 1-4 dari 9 pengajuan</span>
            <div class="pages">
              <button class="pg-btn"><i class="ti ti-chevron-left"></i></button>
              <button class="pg-btn active">1</button>
              <button class="pg-btn">2</button>
              <button class="pg-btn">3</button>
              <button class="pg-btn"><i class="ti ti-chevron-right"></i></button>
            </div>
          </div>
        </div>

        <div class="flow-card">
          <h4>Alur Pengajuan ke Admin Cabang</h4>
          <div class="flow-steps">
            <div class="flow-step">
              <div class="flow-icon fi-done"><i class="ti ti-file-plus"></i></div>
              <h5>Input Data</h5>
              <p>Pengurus masjid melengkapi berkas & formulir.</p>
            </div>
            <div class="flow-step">
              <div class="flow-icon fi-done"><i class="ti ti-list-check"></i></div>
              <h5>Verifikasi</h5>
              <p>Validasi administratif oleh Admin Cabang.</p>
            </div>
            <div class="flow-step">
              <div class="flow-icon fi-done"><i class="ti ti-eye-check"></i></div>
              <h5>Review Cabang</h5>
              <p>Keputusan akhir dan pertimbangan kebijakan.</p>
            </div>
            <div class="flow-step is-pending">
              <div class="flow-icon fi-pending"><i class="ti ti-file-check"></i></div>
              <h5>Hasil Akhir</h5>
              <p>Notifikasi persetujuan atau penolakan.</p>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<script>
document.querySelectorAll('.masjid-tab').forEach(function(tab) {
  tab.addEventListener('click', function() {
    document.querySelectorAll('.masjid-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    this.classList.add('active');
    document.getElementById('panel-' + this.dataset.tab).classList.add('active');
  });
});
</script>
</body>
</html>