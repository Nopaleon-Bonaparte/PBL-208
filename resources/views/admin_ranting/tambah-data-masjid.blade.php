<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Tambah Masjid / Musholla — PRM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>

/* ── CARD PRESS EFFECT ── */
.masjid-card {
  cursor: pointer;
  overflow: visible !important;
  transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
  user-select: none;
  will-change: transform;
}
.masjid-card:hover {
  transform: translateY(-3px) !important;
  box-shadow: 0 8px 20px rgba(30,107,63,.18) !important;
  border-color: var(--green-400) !important;
  background: #fff !important;
}
.masjid-card.shaking {
  animation: card-shake 0.35s ease !important;
  background: #d6f0e0 !important;
  border-color: var(--green-500) !important;
  box-shadow: 0 4px 14px rgba(30,107,63,.22) !important;
}
@keyframes card-shake {
  0%   { transform: rotate(0deg) scale(1); }
  20%  { transform: rotate(-2deg) scale(0.97); }
  40%  { transform: rotate(2deg) scale(0.97); }
  60%  { transform: rotate(-1.2deg) scale(0.99); }
  80%  { transform: rotate(1deg) scale(0.99); }
  100% { transform: rotate(0deg) scale(1); }
}
/* Override font */
body { font-family: 'Inter', sans-serif !important; }

/* ── NOTICE BANNER ── */
.dm-notice {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 8px;
  padding: 12px 16px;
  font-size: 13px;
  color: #92400e;
  margin-bottom: 20px;
}
.dm-notice i { font-size: 16px; color: #d97706; flex-shrink: 0; }

/* ── TWO-COL LAYOUT ── */
.dm-layout {
  display: grid;
  grid-template-columns: 1fr 300px;
  gap: 20px;
  align-items: start;
}

/* ── SECTION CARD ── */
.dm-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.07);
  padding: 20px 22px;
  margin-bottom: 16px;
}
.dm-card:last-child { margin-bottom: 0; }

.dm-section-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  color: var(--gray-900);
  margin-bottom: 16px;
}
.dm-section-title i { font-size: 17px; color: var(--green-600); }
.dm-subgroup-title {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: .04em;
  text-transform: uppercase;
  color: var(--green-700);
  margin-bottom: 10px;
}

/* ── FORM ELEMENTS ── */
.dm-group { margin-bottom: 14px; }
.dm-group:last-child { margin-bottom: 0; }
.dm-label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: var(--gray-700);
  margin-bottom: 5px;
}
.dm-input, .dm-select, .dm-textarea {
  width: 100%;
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  color: var(--gray-800);
  background: #fff;
  border: 1px solid var(--gray-300);
  border-radius: 8px;
  padding: 8px 11px;
  outline: none;
  transition: border-color .15s;
  box-sizing: border-box;
}
.dm-input:focus, .dm-select:focus, .dm-textarea:focus {
  border-color: var(--green-400);
  box-shadow: 0 0 0 3px rgba(39,134,79,.08);
}
.dm-input::placeholder, .dm-textarea::placeholder { color: var(--gray-400); }
.dm-textarea { resize: vertical; min-height: 78px; }
.dm-radio-group { display: flex; gap: 20px; margin-top: 2px; }
.dm-radio-label {
  display: flex; align-items: center; gap: 6px;
  font-size: 13px; color: var(--gray-700); cursor: pointer;
}
.dm-radio-label input[type="radio"] { accent-color: var(--green-600); }
.dm-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.dm-check-row { display: flex; gap: 16px; flex-wrap: wrap; margin-top: 4px; }
.dm-check-label {
  display: flex; align-items: center; gap: 6px;
  font-size: 13px; color: var(--gray-700); cursor: pointer;
}
.dm-check-label input[type="checkbox"] { accent-color: var(--green-600); }

/* ── RIGHT SIDEBAR ── */
.dm-sidebar { display: flex; flex-direction: column; gap: 16px; }

/* upload card */
.dm-upload-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.07);
  padding: 18px 18px 14px;
}
.dm-upload-title {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: var(--gray-900);
  margin-bottom: 14px;
}
.dm-upload-title i { font-size: 17px; color: var(--green-600); }
.dm-dropzone {
  border: 2px dashed var(--gray-300);
  border-radius: 10px;
  padding: 28px 16px;
  text-align: center;
  cursor: pointer;
  transition: border-color .15s, background .15s;
  margin-bottom: 14px;
}
.dm-dropzone:hover { border-color: var(--green-400); background: var(--green-50); }
.dm-dropzone i { font-size: 28px; color: var(--gray-400); display: block; margin-bottom: 8px; }
.dm-dropzone .dz-name { font-size: 13px; font-weight: 600; color: var(--gray-700); }
.dm-dropzone .dz-hint { font-size: 11px; color: var(--gray-500); margin-top: 3px; }

.dm-doc-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 9px 0; border-top: 1px solid var(--gray-100); gap: 8px;
}
.dm-doc-left {
  display: flex; align-items: center; gap: 8px;
  font-size: 12.5px; color: var(--gray-700); font-weight: 500;
  flex: 1; min-width: 0;
}
.dm-doc-left i { font-size: 15px; color: var(--gray-400); flex-shrink: 0; }
.dm-doc-sub { font-size: 11px; color: var(--gray-400); font-weight: 400; }
.dm-btn-upload {
  display: flex; align-items: center; gap: 5px;
  background: var(--green-700); color: #fff;
  border: none; border-radius: 7px;
  padding: 6px 12px; font-size: 12px; font-weight: 600;
  font-family: 'Inter', sans-serif;
  cursor: pointer; white-space: nowrap; flex-shrink: 0;
}
.dm-doc-done { color: var(--green-600); font-size: 16px; }

/* takmir card */
.dm-takmir-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.07);
  padding: 18px 18px 14px;
}
.dm-takmir-title {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; font-weight: 700; color: var(--gray-900);
  margin-bottom: 14px;
}
.dm-takmir-title i { font-size: 17px; color: var(--green-600); }

/* ringkasan card */
.dm-ringkasan {
  background: var(--green-800);
  border-radius: 12px;
  padding: 16px 18px;
  color: #fff;
}
.dm-ringkasan-title {
  display: flex; align-items: center; gap: 8px;
  font-size: 13px; font-weight: 700; margin-bottom: 12px;
}
.dm-ringkasan-title i { font-size: 16px; }
.dm-rs-label {
  font-size: 10px; font-weight: 700; letter-spacing: .06em;
  color: rgba(255,255,255,.6); margin-bottom: 5px;
}
.dm-rs-bar-wrap {
  background: rgba(255,255,255,.15);
  border-radius: 999px; height: 6px; margin-bottom: 12px; overflow: hidden;
}
.dm-rs-bar-fill {
  background: var(--green-300); height: 100%;
  border-radius: 999px; width: 65%;
}
.dm-rs-item {
  display: flex; align-items: center; gap: 7px;
  font-size: 12px; color: rgba(255,255,255,.85); margin-bottom: 6px;
}
.dm-rs-item i { font-size: 14px; }
.dm-rs-done { color: var(--green-300); }
.dm-rs-pending { color: rgba(255,255,255,.45); }
.dm-rs-note {
  margin-top: 12px; background: rgba(255,255,255,.08);
  border-radius: 8px; padding: 10px 12px;
  font-size: 11.5px; color: rgba(255,255,255,.7);
}
.dm-rs-note strong { color: rgba(255,255,255,.9); display: block; margin-bottom: 3px; }

/* ── BOTTOM BAR ── */
.dm-bottom-bar {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 0 0; margin-top: 4px;
}
.dm-bottom-bar-left { font-size: 12px; color: var(--gray-500); }
.dm-bottom-bar-right { display: flex; gap: 10px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_ranting.sidebar', ['activeNav' => 'data-masjid'])

  <div class="main-shell">
    @include('admin_ranting.topbar', ['activeTopLink' => 'data-masjid'])

    <main class="page-content">

      @php
        $isEdit = ($mode ?? 'create') === 'edit';
        $m = $masjid ?? null;
        $alat_data = [];
        if ($m && !empty($m->alat_kebersihan)) {
            if (str_starts_with($m->alat_kebersihan, '{')) {
                $alat_data = json_decode($m->alat_kebersihan, true) ?: [];
            } else {
                foreach (explode(',', $m->alat_kebersihan) as $item) {
                    $alat_data[trim($item)] = ['kondisi' => '', 'jumlah' => ''];
                }
            }
        }
        $sarana_data = [];
        if ($m && !empty($m->sarana_lainnya)) {
            if (str_starts_with($m->sarana_lainnya, '{')) {
                $sarana_data = json_decode($m->sarana_lainnya, true) ?: [];
            } else {
                $sarana_data['keterangan_tambahan'] = $m->sarana_lainnya;
            }
        }
      @endphp

      @if($errors->any())
        <div class="dm-notice" style="background:#fee2e2;border-color:#fca5a5;color:#b91c1c;">
          <i class="ti ti-alert-circle"></i>
          <div>@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
        </div>
      @endif
      @if(session('success'))
        <div class="dm-notice" style="background:#dcfce7;border-color:#86efac;color:#15803d;">
          <i class="ti ti-circle-check"></i> {{ session('success') }}
        </div>
      @endif

      <!-- NOTICE -->
      <div class="dm-notice">
        <i class="ti ti-alert-triangle"></i>
        Pastikan seluruh data legalitas dan wakaf telah diverifikasi sesuai dengan dokumen fisik sebelum diajukan ke admin cabang.
      </div>

      <!-- PAGE HEADER -->
      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Tambah Masjid / Musholla Baru</h1>
          <p>Pendaftaran masjid/musholla baru. Data diajukan ke admin cabang untuk disetujui.</p>
        </div>
      </div>

      <form method="POST" action="{{ $isEdit ? url(($mode_base ?? '/prm').'/edit-masjid/'.$m->id_masjid) : url('/prm/tambah-masjid') }}" enctype="multipart/form-data">
        @csrf
        @if($isEdit) @method('PUT') @endif
      <div class="dm-layout">

        <!-- LEFT COL -->
        <div>

          <!-- INFORMASI DASAR -->
          <div class="dm-card">
            <div class="dm-section-title">
              <i class="ti ti-info-circle"></i> Informasi Dasar
            </div>

            <div class="dm-group">
              <label class="dm-label">Nama Masjid/Musholla</label>
              <input class="dm-input" type="text" name="nama_masjid" required value="{{ old('nama_masjid', $m->nama_masjid ?? '') }}" placeholder="Masukkan nama resmi"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Tipe Bangunan</label>
              <div class="dm-radio-group">
                <label class="dm-radio-label"><input type="radio" name="tipe" value="Masjid" {{ old('tipe', $m->tipe ?? 'Masjid') === 'Masjid' ? 'checked' : '' }}/> Masjid</label>
                <label class="dm-radio-label"><input type="radio" name="tipe" value="Musholla" {{ old('tipe', $m->tipe ?? '') === 'Musholla' ? 'checked' : '' }}/> Musholla</label>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Alamat Lengkap</label>
              <textarea class="dm-textarea" name="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat', $m->alamat ?? '') }}</textarea>
            </div>

            {{-- Kecamatan & Kelurahan disimpan otomatis dari data ranting, tidak ditampilkan di form --}}
            <input type="hidden" name="kecamatan" value="{{ old('kecamatan', $m->kecamatan ?? $kecamatanRanting ?? '') }}">
            <input type="hidden" name="kelurahan" id="selectKelurahan" value="{{ old('kelurahan', $m->kelurahan ?? '') }}">


            <div class="dm-group">
              <label class="dm-label">Kapasitas Jamaah</label>
              <input class="dm-input" type="number" name="kapasitas" value="{{ old('kapasitas', $m->kapasitas ?? 0) }}" style="max-width:180px;"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nomor SK Pendirian</label>
              <input class="dm-input" type="text" name="no_sk" value="{{ old('no_sk', $m->no_sk ?? '') }}" placeholder="Contoh: 123/SK/PCM/2023"/>
            </div>
          </div>

          <!-- STATUS LEGALITAS & WAKAF -->
          <div class="dm-card">
            <div class="dm-section-title">
              <i class="ti ti-scale"></i> Status Legalitas &amp; Wakaf
            </div>

            <div class="dm-grid-2">
              <div class="dm-group">
                <label class="dm-label">Status Tanah</label>
                @php $st = old('status_tanah', $m->status_tanah ?? ''); @endphp
                <select class="dm-select" name="status_tanah">
                  @foreach(['Tanah Wakaf','Hak Milik','Sewa','Pinjam Pakai'] as $opt)
                    <option value="{{ $opt }}" {{ $st === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
              </div>
              <div class="dm-group">
                <label class="dm-label">Jenis Sertifikat</label>
                @php $js = old('jenis_sertifikat', $m->jenis_sertifikat ?? ''); @endphp
                <select class="dm-select" name="jenis_sertifikat">
                  @foreach(['AIW (Akta Ikrar Wakaf)','SHM','SHGB','Belum Bersertifikat'] as $opt)
                    <option value="{{ $opt }}" {{ $js === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nomor Sertifikat/AIW</label>
              <input class="dm-input" type="text" name="no_sertifikat" value="{{ old('no_sertifikat', $m->no_sertifikat ?? '') }}" placeholder="Masukkan nomor sertifikat"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nama Nazir (Penerima Wakaf)</label>
              <input class="dm-input" type="text" name="nama_nazir" value="{{ old('nama_nazir', $m->nama_nazir ?? '') }}" placeholder="Nama lengkap nazir"/>
            </div>
          </div>

          <!-- DATA INVENTARIS & FASILITAS -->
          <div class="dm-card">
            <div class="dm-section-title">
              <i class="ti ti-tool"></i> Data Inventaris &amp; Fasilitas
            </div>

            <div class="dm-subgroup-title" style="font-size: 15px; font-weight: 700; color: var(--green-800); border-bottom: 2px solid var(--green-100); padding-bottom: 6px; margin-bottom: 15px;">UNIT</div>
            
            <div class="dm-grid-2" style="gap: 20px; margin-bottom: 20px;">
              <!-- Kategori Barang Elektronik -->
              <div style="background: #f9fafb; padding: 15px; border-radius: 10px; border: 1px solid #e5e7eb;">
                <div style="font-weight: 700; font-size: 12px; color: var(--gray-500); text-transform: uppercase; margin-bottom: 12px; letter-spacing: 0.05em;">
                  Barang Elektronik
                </div>
                
                <!-- Sound System Checkbox & Dropdown -->
                <div class="dm-group" style="margin-bottom: 14px;">
                  @php 
                    $ss = old('sound_system', $m->sound_system ?? ''); 
                    $ssQty = old('jumlah_sound_system', $m->jumlah_sound_system ?? '');
                  @endphp
                  <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                    <input type="checkbox" id="checkSoundSystem" onchange="toggleSoundSystem()" {{ $ss || $ssQty ? 'checked' : '' }} style="margin-right: 8px;"/> Sound System
                  </label>
                  <div id="soundSystemSelectContainer" style="margin-top: 8px; display: {{ $ss || $ssQty ? 'block' : 'none' }}; padding-left: 20px;">
                    <div class="dm-grid-2" style="gap: 10px;">
                      <select class="dm-select" name="sound_system" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                        <option value="">Pilih Kondisi</option>
                        @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                          <option value="{{ $opt }}" {{ $ss === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                      </select>
                      <input class="dm-input" type="number" name="jumlah_sound_system" value="{{ $ssQty }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                    </div>
                  </div>
                </div>

                <!-- AC Checkbox & Input -->
                <div class="dm-group" style="margin-bottom: 0;">
                  @php 
                    $acVal = old('jumlah_ac', $m->jumlah_ac ?? ''); 
                    $acCond = old('kondisi_ac', $m->kondisi_ac ?? '');
                  @endphp
                  <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                    <input type="checkbox" id="checkAC" onchange="toggleAC()" {{ ($acVal !== '' && $acVal !== null) || $acCond ? 'checked' : '' }} style="margin-right: 8px;"/> Pendingin Ruangan (AC)
                  </label>
                  <div id="acInputContainer" style="margin-top: 8px; display: {{ ($acVal !== '' && $acVal !== null) || $acCond ? 'block' : 'none' }}; padding-left: 20px;">
                    <div class="dm-grid-2" style="gap: 10px;">
                      <select class="dm-select" name="kondisi_ac" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                        <option value="">Pilih Kondisi</option>
                        @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                          <option value="{{ $opt }}" {{ $acCond === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                      </select>
                      <input class="dm-input" type="number" name="jumlah_ac" value="{{ $acVal }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Kategori Alat Kebersihan -->
              <div style="background: #f9fafb; padding: 15px; border-radius: 10px; border: 1px solid #e5e7eb;">
                <div style="font-weight: 700; font-size: 12px; color: var(--gray-500); text-transform: uppercase; margin-bottom: 12px; letter-spacing: 0.05em;">
                  Alat Kebersihan
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 14px;">
                  <!-- Vacuum Cleaner -->
                  @php $hasVacuum = isset($alat_data['Vacuum Cleaner']); @endphp
                  <div class="dm-group" style="margin-bottom: 0;">
                    <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                      <input type="checkbox" name="alat_kebersihan_list[]" value="Vacuum Cleaner" onchange="toggleAlatDetail('Vacuum_Cleaner')" {{ $hasVacuum ? 'checked' : '' }} style="margin-right: 8px;"/> Vacuum Cleaner
                    </label>
                    <div id="container_Vacuum_Cleaner" style="margin-top: 8px; display: {{ $hasVacuum ? 'block' : 'none' }}; padding-left: 20px;">
                      <div class="dm-grid-2" style="gap: 10px;">
                        <select class="dm-select" name="alat_kondisi[Vacuum Cleaner]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                          <option value="">Pilih Kondisi</option>
                          @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                            <option value="{{ $opt }}" {{ ($alat_data['Vacuum Cleaner']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                          @endforeach
                        </select>
                        <input class="dm-input" type="number" name="alat_jumlah[Vacuum Cleaner]" value="{{ $alat_data['Vacuum Cleaner']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                      </div>
                    </div>
                  </div>

                  <!-- Mesin Poles -->
                  @php $hasPoles = isset($alat_data['Mesin Poles']); @endphp
                  <div class="dm-group" style="margin-bottom: 0;">
                    <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                      <input type="checkbox" name="alat_kebersihan_list[]" value="Mesin Poles" onchange="toggleAlatDetail('Mesin_Poles')" {{ $hasPoles ? 'checked' : '' }} style="margin-right: 8px;"/> Mesin Poles
                    </label>
                    <div id="container_Mesin_Poles" style="margin-top: 8px; display: {{ $hasPoles ? 'block' : 'none' }}; padding-left: 20px;">
                      <div class="dm-grid-2" style="gap: 10px;">
                        <select class="dm-select" name="alat_kondisi[Mesin Poles]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                          <option value="">Pilih Kondisi</option>
                          @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                            <option value="{{ $opt }}" {{ ($alat_data['Mesin Poles']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                          @endforeach
                        </select>
                        <input class="dm-input" type="number" name="alat_jumlah[Mesin Poles]" value="{{ $alat_data['Mesin Poles']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                      </div>
                    </div>
                  </div>

                  <!-- Set Sapu & Pel -->
                  @php $hasSapu = isset($alat_data['Set Sapu & Pel']); @endphp
                  <div class="dm-group" style="margin-bottom: 0;">
                    <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                      <input type="checkbox" name="alat_kebersihan_list[]" value="Set Sapu & Pel" onchange="toggleAlatDetail('Set_Sapu_Pel')" {{ $hasSapu ? 'checked' : '' }} style="margin-right: 8px;"/> Set Sapu &amp; Pel
                    </label>
                    <div id="container_Set_Sapu_Pel" style="margin-top: 8px; display: {{ $hasSapu ? 'block' : 'none' }}; padding-left: 20px;">
                      <div class="dm-grid-2" style="gap: 10px;">
                        <select class="dm-select" name="alat_kondisi[Set Sapu & Pel]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                          <option value="">Pilih Kondisi</option>
                          @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                            <option value="{{ $opt }}" {{ ($alat_data['Set Sapu & Pel']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                          @endforeach
                        </select>
                        <input class="dm-input" type="number" name="alat_jumlah[Set Sapu & Pel]" value="{{ $alat_data['Set Sapu & Pel']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Kategori Sarana Lainnya -->
            <div style="background: #f9fafb; padding: 15px; border-radius: 10px; border: 1px solid #e5e7eb; margin-top: 20px;">
              <div style="font-weight: 700; font-size: 12px; color: var(--gray-500); text-transform: uppercase; margin-bottom: 12px; letter-spacing: 0.05em;">
                Sarana Lainnya
              </div>
              
              <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 15px;">
                <!-- Karpet -->
                @php $hasKarpet = isset($sarana_data['Karpet']); @endphp
                <div class="dm-group" style="margin-bottom: 0;">
                  <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                    <input type="checkbox" name="sarana_list[]" value="Karpet" onchange="toggleSaranaDetail('Karpet')" {{ $hasKarpet ? 'checked' : '' }} style="margin-right: 8px;"/> Karpet
                  </label>
                  <div id="container_Karpet" style="margin-top: 8px; display: {{ $hasKarpet ? 'block' : 'none' }}; padding-left: 20px;">
                    <div class="dm-grid-2" style="gap: 10px;">
                      <select class="dm-select" name="sarana_kondisi[Karpet]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                        <option value="">Pilih Kondisi</option>
                        @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                          <option value="{{ $opt }}" {{ ($sarana_data['Karpet']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                      </select>
                      <input class="dm-input" type="number" name="sarana_jumlah[Karpet]" value="{{ $sarana_data['Karpet']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                    </div>
                  </div>
                </div>

                <!-- Genset -->
                @php $hasGenset = isset($sarana_data['Genset']); @endphp
                <div class="dm-group" style="margin-bottom: 0;">
                  <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                    <input type="checkbox" name="sarana_list[]" value="Genset" onchange="toggleSaranaDetail('Genset')" {{ $hasGenset ? 'checked' : '' }} style="margin-right: 8px;"/> Genset
                  </label>
                  <div id="container_Genset" style="margin-top: 8px; display: {{ $hasGenset ? 'block' : 'none' }}; padding-left: 20px;">
                    <div class="dm-grid-2" style="gap: 10px;">
                      <select class="dm-select" name="sarana_kondisi[Genset]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                        <option value="">Pilih Kondisi</option>
                        @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                          <option value="{{ $opt }}" {{ ($sarana_data['Genset']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                      </select>
                      <input class="dm-input" type="number" name="sarana_jumlah[Genset]" value="{{ $sarana_data['Genset']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                    </div>
                  </div>
                </div>

                <!-- CCTV -->
                @php $hasCctv = isset($sarana_data['CCTV']); @endphp
                <div class="dm-group" style="margin-bottom: 0;">
                  <label class="dm-check-label" style="display: flex; align-items: center; font-weight: 600;">
                    <input type="checkbox" name="sarana_list[]" value="CCTV" onchange="toggleSaranaDetail('CCTV')" {{ $hasCctv ? 'checked' : '' }} style="margin-right: 8px;"/> CCTV
                  </label>
                  <div id="container_CCTV" style="margin-top: 8px; display: {{ $hasCctv ? 'block' : 'none' }}; padding-left: 20px;">
                    <div class="dm-grid-2" style="gap: 10px;">
                      <select class="dm-select" name="sarana_kondisi[CCTV]" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;">
                        <option value="">Pilih Kondisi</option>
                        @foreach(['Baik','Perlu Perbaikan','Tidak Ada'] as $opt)
                          <option value="{{ $opt }}" {{ ($sarana_data['CCTV']['kondisi'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                      </select>
                      <input class="dm-input" type="number" name="sarana_jumlah[CCTV]" value="{{ $sarana_data['CCTV']['jumlah'] ?? '' }}" placeholder="Jumlah" style="background: #fff; font-size: 12px; padding: 6px 10px; height: auto;"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="dm-group" style="margin-bottom: 0;">
                <label class="dm-label" style="font-weight: 700; font-size: 11px; color: var(--gray-500); text-transform: uppercase;">Sarana Tambahan Lainnya</label>
                <textarea class="dm-textarea" name="sarana_keterangan_tambahan" placeholder="Tuliskan sarana lain jika ada..." style="min-height:50px; background: #fff;">{{ old('sarana_keterangan_tambahan', $sarana_data['keterangan_tambahan'] ?? '') }}</textarea>
              </div>
            </div>
          </div>

        </div><!-- /left col -->

        <!-- RIGHT SIDEBAR -->
        <div class="dm-sidebar">

          <!-- UPLOAD -->
          <div class="dm-upload-card">
            <div class="dm-upload-title">
              <i class="ti ti-cloud-upload"></i> Upload Foto &amp; Dokumen
            </div>
            
            <div class="dm-dropzone" onclick="document.getElementById('file_foto_bangunan').click()" style="cursor: pointer; background-size: cover; background-position: center; {{ ($m && $m->foto_bangunan) ? 'background-image: url('.asset('storage/' . $m->foto_bangunan).');' : '' }}">
              <input type="file" name="foto_bangunan" id="file_foto_bangunan" accept="image/*" style="display: none;" onchange="previewFoto(this)">
              <i class="ti ti-camera-plus" id="previewIcon" style="{{ ($m && $m->foto_bangunan) ? 'display: none;' : '' }}"></i>
              <div class="dz-name" id="previewName" style="{{ ($m && $m->foto_bangunan) ? 'display: none;' : '' }}">Foto Utama Bangunan</div>
              <div class="dz-hint" id="previewHint" style="{{ ($m && $m->foto_bangunan) ? 'display: none;' : '' }}">Klik untuk pilih file JPG/PNG (Max 5MB)</div>
            </div>

            <!-- Scan SK Pendirian -->
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div>
                  <div>Scan SK Pendirian</div>
                  <div class="dm-doc-sub" id="skHint">
                    @if($m && $m->file_sk)
                      Sudah Terunggah (<a href="{{ asset('storage/' . $m->file_sk) }}" target="_blank" style="color: #1e6b3f; text-decoration: underline;">Lihat File</a>)
                    @else
                      PDF, Max 10MB
                    @endif
                  </div>
                </div>
              </div>
              <input type="file" name="file_sk" id="file_sk" accept="application/pdf" style="display: none;" onchange="updateDocLabel(this, 'skHint')">
              <button type="button" class="dm-btn-upload" onclick="document.getElementById('file_sk').click()"><i class="ti ti-upload"></i> Pilih File</button>
            </div>

            <!-- Scan AIW / Sertifikat -->
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div>
                  <div>Scan AIW / Sertifikat</div>
                  <div class="dm-doc-sub" id="sertifikatHint">
                    @if($m && $m->file_sertifikat)
                      Sudah Terunggah (<a href="{{ asset('storage/' . $m->file_sertifikat) }}" target="_blank" style="color: #1e6b3f; text-decoration: underline;">Lihat File</a>)
                    @else
                      PDF, Max 10MB
                    @endif
                  </div>
                </div>
              </div>
              <input type="file" name="file_sertifikat" id="file_sertifikat" accept="application/pdf" style="display: none;" onchange="updateDocLabel(this, 'sertifikatHint')">
              <button type="button" class="dm-btn-upload" onclick="document.getElementById('file_sertifikat').click()"><i class="ti ti-upload"></i> Pilih File</button>
            </div>

            <!-- Scan KTP Takmir -->
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div>
                  <div>Scan KTP Takmir</div>
                  <div class="dm-doc-sub" id="ktpHint">
                    @if($m && $m->file_ktp)
                      Sudah Terunggah (<a href="{{ asset('storage/' . $m->file_ktp) }}" target="_blank" style="color: #1e6b3f; text-decoration: underline;">Lihat File</a>)
                    @else
                      PDF, Max 10MB
                    @endif
                  </div>
                </div>
              </div>
              <input type="file" name="file_ktp" id="file_ktp" accept="application/pdf" style="display: none;" onchange="updateDocLabel(this, 'ktpHint')">
              <button type="button" class="dm-btn-upload" onclick="document.getElementById('file_ktp').click()"><i class="ti ti-upload"></i> Pilih File</button>
            </div>
          </div>

          <!-- DATA TAKMIR -->
          <div class="dm-takmir-card">
            <div class="dm-takmir-title">
              <i class="ti ti-users-group"></i> Data Takmir Awal
            </div>
            <div class="dm-group">
              <label class="dm-label">Nama Ketua Takmir</label>
              <input class="dm-input" type="text" name="takmir_nama" value="{{ old('takmir_nama', $m->takmir_nama ?? '') }}" placeholder="Nama lengkap"/>
            </div>
            <div class="dm-grid-2">
              <div class="dm-group">
                <label class="dm-label">NIK</label>
                <input class="dm-input" type="text" name="takmir_nik" value="{{ old('takmir_nik', $m->takmir_nik ?? '') }}" placeholder="16 digit"/>
              </div>
              <div class="dm-group">
                <label class="dm-label">Nomor WhatsApp</label>
                <input class="dm-input" type="text" name="takmir_wa" value="{{ old('takmir_wa', $m->takmir_wa ?? $m->kontak_pengurus ?? '') }}" placeholder="08xx"/>
              </div>
            </div>
            
            <div style="margin-top: 14px; padding-top: 14px; border-top: 1px dashed var(--gray-200);">
              <div class="dm-group">
                <label class="dm-label">Username Akun Takmir</label>
                <input class="dm-input" type="text" name="default_username" value="{{ old('default_username', $m->default_username ?? '') }}" placeholder="Username login takmir"/>
              </div>
              <div class="dm-group">
                <label class="dm-label">Email Akun Takmir</label>
                <input class="dm-input" type="email" name="email" value="{{ old('email', $m->email ?? '') }}" placeholder="Email takmir"/>
              </div>
              <div class="dm-group" style="margin-bottom: 0;">
                <label class="dm-label">Password Akun {{ $isEdit ? '(Kosongkan jika tidak diubah)' : '' }}</label>
                <input class="dm-input" type="password" name="default_password" placeholder="Minimal 6 karakter"/>
              </div>
            </div>
          </div>

          <!-- RINGKASAN -->
          <div class="dm-ringkasan">
            <div class="dm-ringkasan-title">
              <i class="ti ti-clipboard-check"></i> Ringkasan Pengajuan
            </div>
            <div class="dm-rs-label" id="completenessLabel">KELENGKAPAN DATA &nbsp; 0%</div>
            <div class="dm-rs-bar-wrap"><div class="dm-rs-bar-fill" id="completenessBar" style="width: 0%;"></div></div>
            <div class="dm-rs-item" id="rsItemDasar"><i class="ti ti-clock"></i> Informasi Dasar (Belum Lengkap)</div>
            <div class="dm-rs-item" id="rsItemTakmir"><i class="ti ti-clock"></i> Data Takmir (Belum Lengkap)</div>
            <div class="dm-rs-item" id="rsItemLegalitas"><i class="ti ti-clock"></i> Legalitas &amp; Wakaf (Belum Lengkap)</div>
            <div class="dm-rs-item" id="rsItemDokumen"><i class="ti ti-clock"></i> Unggah Dokumen (0/4 Selesai)</div>

        </div><!-- /right sidebar -->

      </div><!-- /dm-layout -->

      <!-- BOTTOM BAR -->
      <div class="dm-bottom-bar">
        <div class="dm-bottom-bar-left">
          <i class="ti ti-device-floppy" style="font-size:14px;vertical-align:middle;margin-right:4px;"></i>
          Tersimpan otomatis pukul 14:20
        </div>
        <div class="dm-bottom-bar-right">
          <button type="button" class="btn btn-secondary">Simpan Draft</button>
          <button type="submit" class="btn btn-primary">
            Ajukan ke Admin Cabang <i class="ti ti-send" style="font-size:14px;"></i>
          </button>
        </div>
      </div>

      </form>

    </main>
  </div>
</div>
<script>
function previewFoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const dropzone = input.closest('.dm-dropzone');
      dropzone.style.backgroundImage = `url(${e.target.result})`;
      dropzone.style.backgroundSize = 'cover';
      dropzone.style.backgroundPosition = 'center';
      
      document.getElementById('previewIcon').style.display = 'none';
      document.getElementById('previewName').style.display = 'none';
      document.getElementById('previewHint').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function updateDocLabel(input, hintId) {
  if (input.files && input.files[0]) {
    document.getElementById(hintId).innerHTML = `<span style="color: #10b981; font-weight: 600;">Terpilih: ${input.files[0].name}</span>`;
  }
}

function calculateFormCompleteness() {
  // 1. Dasar
  const nama_masjid = document.querySelector('input[name="nama_masjid"]')?.value.trim();
  const alamat = document.querySelector('textarea[name="alamat"]')?.value.trim();
  const kecamatan = document.querySelector('select[name="kecamatan"]')?.value;
  const kelurahan = document.querySelector('select[name="kelurahan"]')?.value;
  
  let dasarFilled = 0;
  if (nama_masjid) dasarFilled++;
  if (alamat) dasarFilled++;
  if (kecamatan) dasarFilled++;
  if (kelurahan) dasarFilled++;
  const dasarPct = (dasarFilled / 4) * 100;
  
  const itemDasar = document.getElementById('rsItemDasar');
  if (itemDasar) {
    if (dasarFilled === 4) {
      itemDasar.className = 'dm-rs-item dm-rs-done';
      itemDasar.innerHTML = '<i class="ti ti-circle-check"></i> Informasi Dasar (Lengkap)';
    } else {
      itemDasar.className = 'dm-rs-item dm-rs-pending';
      itemDasar.innerHTML = '<i class="ti ti-clock"></i> Informasi Dasar (Belum Lengkap)';
    }
  }

  // 2. Takmir
  const takmir_nama = document.querySelector('input[name="takmir_nama"]')?.value.trim();
  const takmir_nik = document.querySelector('input[name="takmir_nik"]')?.value.trim();
  const takmir_wa = document.querySelector('input[name="takmir_wa"]')?.value.trim();
  const default_username = document.querySelector('input[name="default_username"]')?.value.trim();
  const default_password = document.querySelector('input[name="default_password"]')?.value.trim();
  const isEdit = "{{ $isEdit }}" === "1";
  const hasExistingPassword = "{{ $m && $m->default_password }}" !== "";
  
  let takmirRequired = 4;
  let takmirFilled = 0;
  if (takmir_nama) takmirFilled++;
  if (takmir_nik) takmirFilled++;
  if (takmir_wa) takmirFilled++;
  if (default_username) takmirFilled++;
  
  if (!isEdit && !hasExistingPassword) {
    takmirRequired = 5;
    if (default_password) takmirFilled++;
  }
  
  const takmirPct = (takmirFilled / takmirRequired) * 100;
  const itemTakmir = document.getElementById('rsItemTakmir');
  if (itemTakmir) {
    if (takmirFilled === takmirRequired) {
      itemTakmir.className = 'dm-rs-item dm-rs-done';
      itemTakmir.innerHTML = '<i class="ti ti-circle-check"></i> Data Takmir (Lengkap)';
    } else {
      itemTakmir.className = 'dm-rs-item dm-rs-pending';
      itemTakmir.innerHTML = '<i class="ti ti-clock"></i> Data Takmir (Belum Lengkap)';
    }
  }

  // 3. Legalitas
  const status_tanah = document.querySelector('select[name="status_tanah"]')?.value;
  const jenis_sertifikat = document.querySelector('select[name="jenis_sertifikat"]')?.value;
  const no_sertifikat = document.querySelector('input[name="no_sertifikat"]')?.value.trim();
  const nama_nazir = document.querySelector('input[name="nama_nazir"]')?.value.trim();
  
  let legalitasFilled = 0;
  if (status_tanah) legalitasFilled++;
  if (jenis_sertifikat) legalitasFilled++;
  if (no_sertifikat) legalitasFilled++;
  if (nama_nazir) legalitasFilled++;
  const legalitasPct = (legalitasFilled / 4) * 100;
  
  const itemLegalitas = document.getElementById('rsItemLegalitas');
  if (itemLegalitas) {
    if (legalitasFilled === 4) {
      itemLegalitas.className = 'dm-rs-item dm-rs-done';
      itemLegalitas.innerHTML = '<i class="ti ti-circle-check"></i> Legalitas &amp; Wakaf (Lengkap)';
    } else {
      itemLegalitas.className = 'dm-rs-item dm-rs-pending';
      itemLegalitas.innerHTML = '<i class="ti ti-clock"></i> Legalitas &amp; Wakaf (Belum Lengkap)';
    }
  }

  // 4. Dokumen
  let docCount = 0;
  const hasFoto = document.getElementById('file_foto_bangunan')?.files.length > 0 || "{{ $m && $m->foto_bangunan }}" !== "";
  const hasSk = document.getElementById('file_sk')?.files.length > 0 || "{{ $m && $m->file_sk }}" !== "";
  const hasSertifikat = document.getElementById('file_sertifikat')?.files.length > 0 || "{{ $m && $m->file_sertifikat }}" !== "";
  const hasKtp = document.getElementById('file_ktp')?.files.length > 0 || "{{ $m && $m->file_ktp }}" !== "";
  
  if (hasFoto) docCount++;
  if (hasSk) docCount++;
  if (hasSertifikat) docCount++;
  if (hasKtp) docCount++;
  
  const docPct = (docCount / 4) * 100;
  const itemDokumen = document.getElementById('rsItemDokumen');
  if (itemDokumen) {
    if (docCount === 4) {
      itemDokumen.className = 'dm-rs-item dm-rs-done';
    } else {
      itemDokumen.className = 'dm-rs-item dm-rs-pending';
    }
    itemDokumen.innerHTML = `<i class="${docCount === 4 ? 'ti ti-circle-check' : 'ti ti-clock'}"></i> Unggah Dokumen (${docCount}/4 Selesai)`;
  }

  // Total
  const totalPct = Math.round((dasarPct + takmirPct + legalitasPct + docPct) / 4);
  const lbl = document.getElementById('completenessLabel');
  if (lbl) lbl.innerHTML = `KELENGKAPAN DATA &nbsp; ${totalPct}%`;
  
  const bar = document.getElementById('completenessBar');
  if (bar) bar.style.width = `${totalPct}%`;
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

const savedKelurahan = "{{ old('kelurahan', $m->kelurahan ?? '') }}";
// Kecamatan terkunci sesuai wilayah ranting yang login (null = bebas pilih)
const kecamatanRanting = "{{ $kecamatanRanting ?? '' }}";

function updateKelurahanOptions() {
  const kecSelect = document.getElementById('selectKecamatan');
  const kelSelect = document.getElementById('selectKelurahan');
  if (!kecSelect || !kelSelect) return;
  
  // Gunakan kecamatan ranting jika ada (select di-disabled), atau gunakan nilai select
  const selectedKec = kecamatanRanting || kecSelect.value;
  kelSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
  
  if (selectedKec && BATAM_WILAYAH[selectedKec]) {
    BATAM_WILAYAH[selectedKec].forEach(function (kel) {
      const opt = document.createElement('option');
      opt.value = kel;
      opt.innerText = kel;
      if (kel === savedKelurahan) {
        opt.selected = true;
      }
      kelSelect.appendChild(opt);
    });
  }
}

// Attach event listeners to all inputs in the form
document.querySelectorAll('input, select, textarea').forEach(el => {
  el.addEventListener('input', calculateFormCompleteness);
  el.addEventListener('change', calculateFormCompleteness);
});

// Run once on load
updateKelurahanOptions();
calculateFormCompleteness();

function toggleSoundSystem() {
  const checkbox = document.getElementById('checkSoundSystem');
  const container = document.getElementById('soundSystemSelectContainer');
  if (checkbox.checked) {
    container.style.display = 'block';
  } else {
    container.style.display = 'none';
    container.querySelectorAll('select, input').forEach(el => el.value = '');
  }
}

function toggleAC() {
  const checkbox = document.getElementById('checkAC');
  const container = document.getElementById('acInputContainer');
  if (checkbox.checked) {
    container.style.display = 'block';
  } else {
    container.style.display = 'none';
    container.querySelectorAll('select, input').forEach(el => el.value = '');
  }
}

function toggleAlatDetail(idName) {
  const checkbox = document.querySelector(`input[onchange="toggleAlatDetail('${idName}')"]`);
  const container = document.getElementById(`container_${idName}`);
  if (!checkbox || !container) return;
  
  if (checkbox.checked) {
    container.style.display = 'block';
  } else {
    container.style.display = 'none';
    container.querySelectorAll('select, input').forEach(el => el.value = '');
  }
}

function toggleSaranaDetail(idName) {
  const checkbox = document.querySelector(`input[onchange="toggleSaranaDetail('${idName}')"]`);
  const container = document.getElementById(`container_${idName}`);
  if (!checkbox || !container) return;
  
  if (checkbox.checked) {
    container.style.display = 'block';
  } else {
    container.style.display = 'none';
    container.querySelectorAll('select, input').forEach(el => el.value = '');
  }
}

document.querySelectorAll('.masjid-card').forEach(card => {
  card.addEventListener('mousedown', function() {
    this.classList.add('shaking');
    setTimeout(() => this.classList.remove('shaking'), 350);
  });
});
</script>
</body>
</html>