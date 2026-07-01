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

/* ── MODALS & FORMS ── */
.aa-modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; align-items:center; justify-content:center; }
.aa-modal-overlay.open { display:flex; }
.aa-modal-box { background:#fff; border-radius:16px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto; box-shadow:0 20px 60px rgba(0,0,0,.2); }
.aa-modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px 16px; border-bottom:1px solid #f3f4f6; }
.aa-modal-header h3 { font-size:16px; font-weight:700; color:#111827; }
.aa-modal-close { width:32px; height:32px; border:none; background:#f3f4f6; border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; color:#4b5563; }
.aa-modal-body { padding:20px 24px; }
.aa-form-group { margin-bottom:16px; }
.aa-form-group label { display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:5px; text-transform:uppercase; letter-spacing:.03em; }
.aa-form-group input, .aa-form-group select, .aa-form-group textarea {
  width:100%; padding:9px 12px; border:1.5px solid #d1d5db; border-radius:8px;
  font-size:13px; color:#1f2937; font-family:inherit; background:#fff; outline:none;
}
.aa-form-group input:focus, .aa-form-group select:focus, .aa-form-group textarea:focus { border-color:#1e6b3f; box-shadow:0 0 0 3px rgba(30,107,63,.1); }
.aa-form-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
.aa-modal-footer { display:flex; justify-content:flex-end; gap:10px; padding:16px 24px; border-top:1px solid #f3f4f6; }
.aa-btn-cancel { padding:9px 18px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px; font-weight:600; color:#374151; background:#fff; cursor:pointer; font-family:inherit; }
.aa-btn-save { padding:9px 22px; background:#1e6b3f; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit; display:inline-flex; align-items:center; gap:6px; }
.req { color:#dc2626; }

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
.btn-ajukan {
  display: flex; align-items: center; gap: 6px;
  background: #fff; color: var(--green-700);
  border: 1.5px solid var(--green-600);
  padding: 9px 18px; border-radius: 10px;
  font-size: 13px; font-weight: 700; cursor: pointer; font-family: inherit;
  transition: background .15s;
}
.btn-ajukan:hover { background: var(--green-50); }

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

  @include('pengurus_masjid.Sidebar', ['activeNav' => 'informasi'])

  <div class="main-shell">
    @include('pengurus_masjid.Topbar', ['activeTopLink' => 'informasi'])

    <main class="page-content">

      {{-- ── HERO ── --}}
      <div class="masjid-hero">
        <div>
          <div class="hero-badges">
            <span class="hero-badge hb-masjid">{{ $masjid->tipe ?? 'Masjid' }}</span>
            <span class="hero-badge hb-wakaf">{{ $masjid->status_legalitas ?? 'Proses' }}</span>
            <span class="hero-badge hb-pbb">SK: {{ $masjid->no_sk ?? '-' }}</span>
          </div>
          <div class="hero-title">{{ $masjid->nama_masjid ?? 'Nama Masjid' }}</div>
          <div class="hero-loc"><i class="ti ti-map-pin"></i> {{ $masjid->alamat ?? 'Alamat belum diisi' }}</div>
        </div>
        <div class="hero-stats">
          <div class="hero-stat"><div class="hero-stat-label">Kapasitas</div><div class="hero-stat-val">{{ number_format($masjid->kapasitas ?? 0) }}</div></div>
          <div class="hero-stat"><div class="hero-stat-label">Takmir</div><div class="hero-stat-val">{{ count($takmir) }}</div></div>
          <div class="hero-stat"><div class="hero-stat-label">Inventaris</div><div class="hero-stat-val">{{ count($inventaris) }}</div></div>
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

      @if(session('success'))
        <div style="background:#dcfce7;color:#15803d;border:1px solid #86efac;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;">
          <i class="ti ti-circle-check" style="margin-right:6px;vertical-align:middle;"></i>{{ session('success') }}
        </div>
      @endif
      @if($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;">
          <i class="ti ti-alert-circle" style="margin-right:6px;vertical-align:middle;"></i>
          @foreach($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
      @endif

      {{-- ════════════════ TAB: INFORMASI ════════════════ --}}
      <div class="tab-panel active" id="panel-informasi">
        <div class="info-grid">
          <div>
            <div class="info-card">
              <h3>Data Umum <i class="ti ti-info-circle" style="color:var(--gray-300);font-size:16px;"></i></h3>
              <div class="info-row-2">
                <div class="info-field"><label>Nama Resmi</label><div class="val">{{ $masjid->nama_masjid ?? '-' }}</div></div>
                <div class="info-field"><label>Tipe Bangunan</label><div class="val">{{ $masjid->tipe ?? '-' }}</div></div>
              </div>
              <div class="info-row-2">
                <div class="info-field"><label>Kecamatan</label><div class="val">{{ $masjid->kecamatan ?? '-' }}</div></div>
                <div class="info-field"><label>Kelurahan</label><div class="val">{{ $masjid->kelurahan ?? '-' }}</div></div>
              </div>
              <div class="info-row-2">
                <div class="info-field"><label>Kapasitas Jamaah</label><div class="val">{{ number_format($masjid->kapasitas ?? 0) }}</div></div>
                <div class="info-field"><label>Status Lahan</label><div class="val">{{ $masjid->status_tanah ?? '-' }}</div></div>
              </div>
              <div class="info-field">
                <label>Alamat Lengkap</label>
                <div class="val sm">{{ $masjid->alamat ?? 'Belum diisi' }}</div>
              </div>
            </div>

            <div class="info-card">
              <h3>Lokasi / Wilayah</h3>
              <div class="map-placeholder">
                <div class="map-pin"><i class="ti ti-map-pin-filled"></i></div>
                <span>{{ $masjid->wilayah ?? 'Kota Batam' }}</span>
              </div>
            </div>
          </div>

          <div>
            <div class="info-card">
              <h3>Kontak & Akun</h3>
              <div class="info-field" style="margin-bottom:12px;">
                <label>Kontak Pengurus</label>
                <div class="val">{{ $masjid->kontak_pengurus ?? '-' }}</div>
              </div>
              <div class="info-field" style="margin-bottom:12px;">
                <label>Ranting (PRM)</label>
                <div class="val">{{ $masjid->nama_ranting ?? '-' }}</div>
              </div>
              <div class="info-field">
                <label>Cabang Induk (PCM)</label>
                <div class="val">{{ $masjid->nama_cabang ?? '-' }}</div>
              </div>
            </div>

            <div class="info-card">
              <h3>Informasi Akun Default</h3>
              <div class="info-field" style="margin-bottom:10px;">
                <label>Username</label>
                <div class="val" style="font-family:monospace;color:#1e6b3f;">{{ $masjid->default_username ?? '-' }}</div>
              </div>
              <div class="info-field">
                <label>Password Default</label>
                <div class="val" style="font-family:monospace;color:#1e6b3f;">{{ $masjid->default_password ?? '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="verify-footer">
          <div class="verify-left">
            @if(($masjid->status_data ?? '') === 'approved')
              <span class="verify-badge"><i class="ti ti-shield-check"></i> TERVERIFIKASI PCM</span>
              <span class="verify-meta">Status Data: Aktif/Terverifikasi</span>
            @else
              <span class="verify-badge" style="background:#fff7ed;color:#c2410c;"><i class="ti ti-clock"></i> PROSES VERIFIKASI</span>
              <span class="verify-meta">Menunggu persetujuan Admin Cabang</span>
            @endif
          </div>
          <div class="verify-actions">
            <button class="btn-ajukan" onclick="openAjukanModal()">
              <i class="ti ti-edit"></i> Ajukan Perubahan Data
            </button>
            <button class="btn-print" onclick="window.print()"><i class="ti ti-printer"></i> Cetak Halaman</button>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: INVENTARIS ════════════════ --}}
      <div class="tab-panel" id="panel-inventaris">
        <div class="inv-header">
          <h2>{{ $masjid->nama_masjid }} — Inventaris</h2>
          <button class="btn-download" onclick="openInventarisModal()"><i class="ti ti-plus"></i> Tambah Inventaris</button>
        </div>

        <div class="inv-stats">
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-gray"><i class="ti ti-clipboard-list"></i></div>
            <div class="inv-stat-label">Total Aset</div>
            <div class="inv-stat-val">{{ count($inventaris) }}</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-green"><i class="ti ti-circle-check"></i></div>
            <div class="inv-stat-label">Kondisi Baik</div>
            <div class="inv-stat-val">{{ $inventaris->where('kondisi', 'baik')->count() }}</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-amber"><i class="ti ti-tool"></i></div>
            <div class="inv-stat-label">Rusak Ringan</div>
            <div class="inv-stat-val">{{ $inventaris->where('kondisi', 'rusak ringan')->count() }}</div>
          </div>
          <div class="inv-stat-card">
            <div class="inv-stat-icon isi-yellow"><i class="ti ti-alert-circle"></i></div>
            <div class="inv-stat-label">Rusak Berat</div>
            <div class="inv-stat-val">{{ $inventaris->where('kondisi', 'rusak berat')->count() }}</div>
          </div>
        </div>

        <div class="inv-table-card">
          <div class="inv-table-head">
            <h3>Daftar Inventaris</h3>
          </div>
          <table class="inv-table">
            <thead>
              <tr><th>Nama Aset</th><th>Kategori</th><th>Kondisi</th><th>Tanggal Pengadaan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              @forelse($inventaris as $item)
              <tr>
                <td>{{ $item->nama_barang }}</td>
                <td><span class="cat-pill cat-sarana">Aset</span></td>
                <td>
                  @php
                    $dotColor = match($item->kondisi) {
                      'baik' => 'kd-baik',
                      'rusak ringan' => 'kd-perbaikan',
                      'rusak berat' => 'kd-rusak',
                      default => 'kd-baik'
                    };
                  @endphp
                  <span class="kondisi-dot {{ $dotColor }}"></span>{{ ucfirst($item->kondisi) }}
                </td>
                <td>{{ $item->tanggal_pengadaan ? \Carbon\Carbon::parse($item->tanggal_pengadaan)->format('d M Y') : '-' }}</td>
                <td>
                  <form method="POST" action="{{ url('/masjid/inventaris/'.$item->id_inventaris) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus inventaris ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inv-action-icon ia-delete" style="border:none;background:none;cursor:pointer;"><i class="ti ti-trash"></i></button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" style="text-align:center;color:var(--gray-400);padding:30px;">Belum ada data inventaris.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <div class="inv-pagination">
            <span>Menampilkan {{ count($inventaris) }} aset</span>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: TAKMIR ════════════════ --}}
      <div class="tab-panel" id="panel-takmir">
        <div class="takmir-header">
          <h2>Struktur Organisasi Takmir</h2>
          <div class="takmir-tools">
            <button class="tt-btn add" onclick="openTakmirModal()"><i class="ti ti-plus"></i></button>
          </div>
        </div>

        <div class="takmir-grid">
          @forelse($takmir as $person)
          <div class="takmir-card">
            @php
              $words = explode(' ', $person->nama);
              $initials = '';
              foreach (array_slice($words, 0, 2) as $w) {
                if (!empty($w)) $initials .= strtoupper($w[0]);
              }
            @endphp
            <div class="takmir-avatar">{{ $initials ?: 'T' }}</div>
            <div class="takmir-name">{{ $person->nama }}</div>
            <span class="takmir-role tr-seksi">{{ strtoupper($person->jabatan) }}</span>
            <div class="takmir-contact"><i class="ti ti-phone"></i> {{ $person->no_hp ?? '-' }}</div>
            @if($person->masa_jabatan_mulai && $person->masa_jabatan_selesai)
              <div class="takmir-contact" style="font-size:11px;color:var(--gray-400);">
                <i class="ti ti-calendar"></i> {{ \Carbon\Carbon::parse($person->masa_jabatan_mulai)->format('Y') }} s/d {{ \Carbon\Carbon::parse($person->masa_jabatan_selesai)->format('Y') }}
              </div>
            @endif
            <div style="margin-top:12px; display:flex; justify-content:flex-end;">
              <form method="POST" action="{{ url('/masjid/takmir/'.$person->id_takmir) }}" onsubmit="return confirm('Hapus personel takmir ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inv-action-icon ia-delete" style="border:none;background:none;cursor:pointer;display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:700;"><i class="ti ti-trash"></i> Hapus</button>
              </form>
            </div>
          </div>
          @empty
          @endforelse
          
          <div class="takmir-card add-card" onclick="openTakmirModal()">
            <div class="plus-icon"><i class="ti ti-user-plus"></i></div>
            Tambah Personel
          </div>
        </div>

        <div class="takmir-meta">
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-calendar"></i></div>
            <div><div class="tm-label">Masa Bakti</div><div class="tm-val">Periode Aktif</div></div>
          </div>
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-file-text"></i></div>
            <div><div class="tm-label">Nomor SK</div><div class="tm-val">{{ $masjid->no_sk ?? '-' }}</div></div>
          </div>
          <div class="tm-card">
            <div class="tm-icon"><i class="ti ti-users"></i></div>
            <div><div class="tm-label">Total Personel</div><div class="tm-val">{{ count($takmir) }} Anggota</div></div>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: LEGALITAS ════════════════ --}}
      <div class="tab-panel" id="panel-legalitas">
        <div style="display:flex;justify-content:flex-end;margin-bottom:14px;">
          <button class="btn btn-primary btn-sm" onclick="openLegalitasModal()">
            <i class="ti ti-plus"></i> Tambah Legalitas
          </button>
        </div>

        <div class="legal-grid">
          @forelse($legalitas as $leg)
          <div class="legal-card">
            <div class="legal-card-top">
              <h4>{{ $leg->jenis_sertifikat }}</h4>
              <span class="legal-status-pill {{ $leg->status === 'aktif' ? 'lsp-done' : 'lsp-proses' }}">
                {{ ucfirst($leg->status) }}
              </span>
            </div>
            <p class="desc">Nomor Dokumen</p>
            <div class="doc-no">{{ $leg->nomor_sertifikat ?? '-' }}</div>
            @if($leg->tanggal_terbit)
              <div style="font-size:12px;color:var(--gray-500);margin-top:6px;">
                <i class="ti ti-calendar"></i> Terbit: {{ \Carbon\Carbon::parse($leg->tanggal_terbit)->format('d M Y') }}
              </div>
            @endif
            <div style="margin-top:12px; display:flex; justify-content:flex-end; gap:6px;">
              <button class="inv-action-icon ia-edit" onclick="openEditLegalitasModal('{{ $leg->id_legalitas }}', '{{ $leg->jenis_sertifikat }}', '{{ $leg->nomor_sertifikat }}', '{{ $leg->status }}')" style="border:none;background:none;cursor:pointer;font-size:12px;font-weight:700;"><i class="ti ti-pencil"></i> Edit</button>
            </div>
          </div>
          @empty
          <div class="empty" style="grid-column:1/-1;">
            <i class="ti ti-certificate"></i>
            Belum ada data legalitas.
          </div>
          @endforelse
        </div>

        <div class="verify-footer">
          <div class="verify-left">
            <span class="verify-badge"><i class="ti ti-shield-check"></i> STATUS LEGALITAS: {{ strtoupper($masjid->status_legalitas ?? 'Proses') }}</span>
          </div>
        </div>
      </div>

      {{-- ════════════════ TAB: PENGAJUAN ════════════════ --}}
      <div class="tab-panel" id="panel-pengajuan">
        <div class="pengajuan-stats">
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-clipboard-list"></i></div>
            <div class="pj-stat-label">Total Pengajuan</div>
            <div class="pj-stat-val">{{ count($pengajuan) }}</div>
            <div class="pj-stat-sub">Seluruh riwayat permohonan</div>
          </div>
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-clock-hour-4"></i></div>
            <div class="pj-stat-label">Sedang Diproses</div>
            <div class="pj-stat-val" style="color:#b45309;">{{ $pengajuan->where('status', 'pending')->count() }}</div>
            <div class="pj-stat-sub">Menunggu approval Admin Cabang</div>
          </div>
          <div class="pj-stat-card">
            <div class="pj-stat-top"><i class="ti ti-checks"></i></div>
            <div class="pj-stat-label">Disetujui</div>
            <div class="pj-stat-val" style="color:var(--green-700);">{{ $pengajuan->where('status', 'approved')->count() }}</div>
            <div class="pj-stat-sub">Jumlah permohonan disetujui</div>
          </div>
        </div>

        <div class="pengajuan-header">
          <div class="pj-filters">
            <button class="pj-filter-pill active">Semua</button>
          </div>
          <button class="btn-new-request" onclick="openPengajuanModal()"><i class="ti ti-plus"></i> Buat Pengajuan Baru</button>
        </div>

        <div class="pj-table-card">
          <table class="pj-table">
            <thead>
              <tr><th>ID Pengajuan</th><th>Deskripsi</th><th>Tanggal</th><th>Status</th><th>Catatan Admin / Alasan</th></tr>
            </thead>
            <tbody>
              @forelse($pengajuan as $pj)
              <tr class="{{ $pj->status === 'pending' ? 'row-highlight' : '' }}">
                <td class="pj-id">#{{ $pj->id_pengajuan }}</td>
                <td>
                  <div class="pj-note" style="font-weight:600;font-style:normal;color:var(--gray-800);">
                    {{ $pj->deskripsi }}
                  </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($pj->created_at)->format('d M Y') }}</td>
                <td>
                  @php
                    $badgeClass = match($pj->status) {
                      'approved' => 'ps-disetujui',
                      'rejected' => 'ps-ditolak',
                      default => 'ps-proses'
                    };
                  @endphp
                  <span class="pj-status-pill {{ $badgeClass }}">{{ strtoupper($pj->status) }}</span>
                </td>
                <td>
                  @if($pj->status === 'rejected')
                    <span class="pj-note danger">{{ $pj->alasan_penolakan ?? 'Pengajuan ditolak oleh Admin Cabang.' }}</span>
                  @elseif($pj->status === 'approved')
                    <span class="pj-note">Disetujui.</span>
                  @else
                    <span class="pj-note warn">Menunggu persetujuan Admin Cabang.</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" style="text-align:center;color:var(--gray-400);padding:20px;">Belum ada pengajuan.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
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

<!-- ── MODAL TAMBAH INVENTARIS ── -->
<div class="aa-modal-overlay" id="inventarisModalOverlay" onclick="closeOnBgInventaris(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-box" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Inventaris Baru</h3>
      <button class="aa-modal-close" onclick="closeInventarisModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/masjid/inventaris') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Nama Barang / Aset <span class="req">*</span></label>
          <input type="text" name="nama_barang" placeholder="Contoh: AC Daikin Inverter 2 PK" required>
        </div>
        <div class="aa-form-group">
          <label>Jumlah Unit <span class="req">*</span></label>
          <input type="number" name="jumlah" min="1" value="1" required>
        </div>
        <div class="aa-form-group">
          <label>Kondisi Barang <span class="req">*</span></label>
          <select name="kondisi" required>
            <option value="baik">Baik</option>
            <option value="rusak ringan">Rusak Ringan</option>
            <option value="rusak berat">Rusak Berat</option>
          </select>
        </div>
        <div class="aa-form-group">
          <label>Tanggal Pengadaan</label>
          <input type="date" name="tanggal_pengadaan" value="{{ date('Y-m-d') }}">
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeInventarisModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Inventaris</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL TAMBAH TAKMIR ── -->
<div class="aa-modal-overlay" id="takmirModalOverlay" onclick="closeOnBgTakmir(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-user-plus" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Personel Takmir</h3>
      <button class="aa-modal-close" onclick="closeTakmirModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/masjid/takmir') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Nama Lengkap <span class="req">*</span></label>
          <input type="text" name="nama" placeholder="Contoh: Drs. H. Ahmad Fauzi" required>
        </div>
        <div class="aa-form-group">
          <label>Jabatan / Peran <span class="req">*</span></label>
          <input type="text" name="jabatan" placeholder="Contoh: Ketua, Sekretaris, Seksi Dakwah" required>
        </div>
        <div class="aa-form-group">
          <label>Nomor WhatsApp / HP</label>
          <input type="text" name="no_hp" placeholder="Contoh: 081234567890">
        </div>
        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Masa Jabatan Mulai</label>
            <input type="date" name="masa_jabatan_mulai" value="{{ date('Y-m-d') }}">
          </div>
          <div class="aa-form-group">
            <label>Masa Jabatan Selesai</label>
            <input type="date" name="masa_jabatan_selesai" value="{{ date('Y-m-d', strtotime('+3 years')) }}">
          </div>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeTakmirModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Takmir</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL TAMBAH LEGALITAS ── -->
<div class="aa-modal-overlay" id="legalitasModalOverlay" onclick="closeOnBgLegalitas(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-certificate" style="margin-right:6px;color:#1e6b3f;"></i>Tambah Legalitas Baru</h3>
      <button class="aa-modal-close" onclick="closeLegalitasModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/masjid/legalitas') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Jenis Sertifikat / Dokumen <span class="req">*</span></label>
          <input type="text" name="jenis_sertifikat" placeholder="Contoh: Sertifikat Wakaf (AIW), SK Pendirian, IMB" required>
        </div>
        <div class="aa-form-group">
          <label>Nomor Sertifikat / Dokumen</label>
          <input type="text" name="nomor_sertifikat" placeholder="Contoh: W2.BTM.05.01.2001">
        </div>
        <div class="aa-form-group">
          <label>Tanggal Terbit</label>
          <input type="date" name="tanggal_terbit" value="{{ date('Y-m-d') }}">
        </div>
        <div class="aa-form-group">
          <label>Status Dokumen</label>
          <select name="status">
            <option value="aktif">Aktif</option>
            <option value="tidak aktif">Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeLegalitasModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Legalitas</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL EDIT LEGALITAS ── -->
<div class="aa-modal-overlay" id="editLegalitasModalOverlay" onclick="closeOnBgEditLegalitas(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-edit" style="margin-right:6px;color:#1e6b3f;"></i>Edit Legalitas</h3>
      <button class="aa-modal-close" onclick="closeEditLegalitasModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" id="editLegalitasForm" action="">
      @csrf
      @method('PUT')
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Jenis Sertifikat / Dokumen <span class="req">*</span></label>
          <input type="text" name="jenis_sertifikat" id="edit_legalitas_jenis" required>
        </div>
        <div class="aa-form-group">
          <label>Nomor Sertifikat / Dokumen</label>
          <input type="text" name="nomor_sertifikat" id="edit_legalitas_nomor">
        </div>
        <div class="aa-form-group">
          <label>Status Dokumen</label>
          <select name="status" id="edit_legalitas_status">
            <option value="aktif">Aktif</option>
            <option value="tidak aktif">Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeEditLegalitasModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-device-floppy"></i> Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL TAMBAH PENGAJUAN ── -->
<div class="aa-modal-overlay" id="pengajuanModalOverlay" onclick="closeOnBgPengajuan(event)">
  <div class="aa-modal-box">
    <div class="aa-modal-header">
      <h3><i class="ti ti-clipboard-list" style="margin-right:6px;color:#1e6b3f;"></i>Buat Pengajuan Baru</h3>
      <button class="aa-modal-close" onclick="closePengajuanModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/masjid/pengajuan') }}">
      @csrf
      <div class="aa-modal-body">
        <div class="aa-form-group">
          <label>Deskripsi Pengajuan / Permohonan <span class="req">*</span></label>
          <textarea name="deskripsi" placeholder="Tuliskan detail permohonan Anda di sini (maksimal 500 karakter)..." required style="width:100%; min-height:120px; padding:10px; border:1.5px solid #d1d5db; border-radius:8px; font-family:inherit; outline:none; font-size:13px;"></textarea>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closePengajuanModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-send"></i> Kirim Pengajuan</button>
      </div>
    </form>
  </div>
</div>

<!-- ── MODAL AJUKAN PERUBAHAN DATA ── -->
<div class="aa-modal-overlay" id="ajukanModalOverlay" onclick="closeOnBgAjukan(event)">
  <div class="aa-modal-box" style="max-width:580px;">
    <div class="aa-modal-header">
      <h3><i class="ti ti-edit" style="margin-right:6px;color:#1e6b3f;"></i>Ajukan Perubahan Data Masjid</h3>
      <button class="aa-modal-close" onclick="closeAjukanModal()"><i class="ti ti-x"></i></button>
    </div>
    <form method="POST" action="{{ url('/masjid/pengajuan') }}">
      @csrf
      <input type="hidden" name="jenis_pengajuan" value="ubah_data">
      <div class="aa-modal-body">
        <p style="font-size:12.5px;color:var(--gray-500);margin-bottom:16px;">Isi field yang ingin diubah. Field yang dikosongkan tidak akan diperbarui.</p>

        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Nama Resmi Masjid</label>
            <input type="text" name="nama_masjid" placeholder="{{ $masjid->nama_masjid ?? '' }}" value="{{ $masjid->nama_masjid ?? '' }}">
          </div>
          <div class="aa-form-group">
            <label>Tipe Bangunan</label>
            <select name="tipe">
              <option value="Masjid" {{ ($masjid->tipe ?? '') === 'Masjid' ? 'selected' : '' }}>Masjid</option>
              <option value="Musholla" {{ ($masjid->tipe ?? '') === 'Musholla' ? 'selected' : '' }}>Musholla</option>
            </select>
          </div>
        </div>

        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" placeholder="Kecamatan" value="{{ $masjid->kecamatan ?? '' }}">
          </div>
          <div class="aa-form-group">
            <label>Kelurahan</label>
            <input type="text" name="kelurahan" placeholder="Kelurahan" value="{{ $masjid->kelurahan ?? '' }}">
          </div>
        </div>

        <div class="aa-form-row-2">
          <div class="aa-form-group">
            <label>Kapasitas Jamaah</label>
            <input type="number" name="kapasitas" placeholder="Contoh: 500" value="{{ $masjid->kapasitas ?? '' }}" min="0">
          </div>
          <div class="aa-form-group">
            <label>Status Lahan</label>
            <select name="status_tanah">
              <option value="">-- Pilih --</option>
              <option value="Wakaf" {{ ($masjid->status_tanah ?? '') === 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
              <option value="Milik Sendiri" {{ ($masjid->status_tanah ?? '') === 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
              <option value="Sewa" {{ ($masjid->status_tanah ?? '') === 'Sewa' ? 'selected' : '' }}>Sewa</option>
              <option value="Pinjam Pakai" {{ ($masjid->status_tanah ?? '') === 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
            </select>
          </div>
        </div>

        <div class="aa-form-group">
          <label>Alamat Lengkap</label>
          <textarea name="alamat" rows="2" style="width:100%;padding:9px 12px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;outline:none;resize:vertical;">{{ $masjid->alamat ?? '' }}</textarea>
        </div>

        <div class="aa-form-group">
          <label>Kontak Pengurus</label>
          <input type="text" name="kontak_pengurus" placeholder="Contoh: 08123456789" value="{{ $masjid->kontak_pengurus ?? '' }}">
        </div>

        <div class="aa-form-group">
          <label>Keterangan / Alasan Perubahan <span class="req">*</span></label>
          <textarea name="deskripsi" placeholder="Jelaskan alasan pengajuan perubahan data ini..." required rows="3" style="width:100%;padding:9px 12px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;outline:none;resize:vertical;"></textarea>
        </div>
      </div>
      <div class="aa-modal-footer">
        <button type="button" class="aa-btn-cancel" onclick="closeAjukanModal()">Batal</button>
        <button type="submit" class="aa-btn-save"><i class="ti ti-send"></i> Kirim Pengajuan</button>
      </div>
    </form>
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

function openInventarisModal() {
  document.getElementById('inventarisModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeInventarisModal() {
  document.getElementById('inventarisModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgInventaris(e) {
  if (e.target === document.getElementById('inventarisModalOverlay')) closeInventarisModal();
}

function openTakmirModal() {
  document.getElementById('takmirModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeTakmirModal() {
  document.getElementById('takmirModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgTakmir(e) {
  if (e.target === document.getElementById('takmirModalOverlay')) closeTakmirModal();
}

function openLegalitasModal() {
  document.getElementById('legalitasModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeLegalitasModal() {
  document.getElementById('legalitasModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgLegalitas(e) {
  if (e.target === document.getElementById('legalitasModalOverlay')) closeLegalitasModal();
}

function openEditLegalitasModal(id, jenis, nomor, status) {
  const form = document.getElementById('editLegalitasForm');
  form.action = "{{ url('/masjid/legalitas') }}/" + id;
  document.getElementById('edit_legalitas_jenis').value = jenis;
  document.getElementById('edit_legalitas_nomor').value = nomor;
  document.getElementById('edit_legalitas_status').value = status;
  
  document.getElementById('editLegalitasModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeEditLegalitasModal() {
  document.getElementById('editLegalitasModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgEditLegalitas(e) {
  if (e.target === document.getElementById('editLegalitasModalOverlay')) closeEditLegalitasModal();
}

function openPengajuanModal() {
  document.getElementById('pengajuanModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closePengajuanModal() {
  document.getElementById('pengajuanModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgPengajuan(e) {
  if (e.target === document.getElementById('pengajuanModalOverlay')) closePengajuanModal();
}

function openAjukanModal() {
  document.getElementById('ajukanModalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeAjukanModal() {
  document.getElementById('ajukanModalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeOnBgAjukan(e) {
  if (e.target === document.getElementById('ajukanModalOverlay')) closeAjukanModal();
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') {
    closeInventarisModal();
    closeTakmirModal();
    closeLegalitasModal();
    closeEditLegalitasModal();
    closePengajuanModal();
    closeAjukanModal();
  }
});
</script>
</body>
</html>