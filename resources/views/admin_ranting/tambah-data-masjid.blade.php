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

      <!-- NOTICE -->
      <div class="dm-notice">
        <i class="ti ti-alert-triangle"></i>
        Pastikan seluruh data legalitas dan wakaf telah diverifikasi sesuai dengan dokumen fisik sebelum dikirim ke Superadmin.
      </div>

      <!-- PAGE HEADER -->
      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Tambah Masjid / Musholla Baru</h1>
          <p>Pendaftaran entitas rumah ibadah baru ke dalam sistem PRM Admin.</p>
        </div>
      </div>

      <form>
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
              <input class="dm-input" type="text" placeholder="Masukkan nama resmi"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Tipe Bangunan</label>
              <div class="dm-radio-group">
                <label class="dm-radio-label"><input type="radio" name="tipe" checked/> Masjid</label>
                <label class="dm-radio-label"><input type="radio" name="tipe"/> Musholla</label>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Alamat Lengkap</label>
              <textarea class="dm-textarea" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <div class="dm-grid-2">
              <div class="dm-group">
                <label class="dm-label">Kecamatan</label>
                <select class="dm-select">
                  <option value="">Pilih Kecamatan</option>
                  <option>Batam Kota</option>
                  <option>Sekupang</option>
                  <option>Nongsa</option>
                  <option>Batu Aji</option>
                  <option>Lubuk Baja</option>
                  <option>Sagulung</option>
                  <option>Galang</option>
                  <option>Belakang Padang</option>
                </select>
              </div>
              <div class="dm-group">
                <label class="dm-label">Kelurahan/Desa</label>
                <select class="dm-select">
                  <option value="">Pilih Kelurahan</option>
                  <option>Belian</option>
                  <option>Teluk Tering</option>
                  <option>Sukajadi</option>
                  <option>Sungai Panas</option>
                  <option>Baloi Permai</option>
                </select>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Kapasitas Jamaah</label>
              <input class="dm-input" type="number" value="0" style="max-width:180px;"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nomor SK Pendirian</label>
              <input class="dm-input" type="text" placeholder="Contoh: 123/SK/PCM/2023"/>
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
                <select class="dm-select">
                  <option>Tanah Wakaf</option>
                  <option>Hak Milik</option>
                  <option>Sewa</option>
                  <option>Pinjam Pakai</option>
                </select>
              </div>
              <div class="dm-group">
                <label class="dm-label">Jenis Sertifikat</label>
                <select class="dm-select">
                  <option>AIW (Akta Ikrar Wakaf)</option>
                  <option>SHM</option>
                  <option>SHGB</option>
                  <option>Belum Bersertifikat</option>
                </select>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nomor Sertifikat/AIW</label>
              <input class="dm-input" type="text" placeholder="Masukkan nomor sertifikat"/>
            </div>

            <div class="dm-group">
              <label class="dm-label">Nama Nazir (Penerima Wakaf)</label>
              <input class="dm-input" type="text" placeholder="Nama lengkap nazir"/>
            </div>
          </div>

          <!-- DATA INVENTARIS & FASILITAS -->
          <div class="dm-card">
            <div class="dm-section-title">
              <i class="ti ti-tool"></i> Data Inventaris &amp; Fasilitas
            </div>

            <div class="dm-grid-2">
              <div class="dm-group">
                <label class="dm-label">Sound System</label>
                <select class="dm-select">
                  <option value="">Pilih Kondisi</option>
                  <option>Baik</option>
                  <option>Perlu Perbaikan</option>
                  <option>Tidak Ada</option>
                </select>
              </div>
              <div class="dm-group">
                <label class="dm-label">Pendingin Ruangan (AC)</label>
                <input class="dm-input" type="number" placeholder="Jumlah unit"/>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Alat Kebersihan</label>
              <div class="dm-check-row">
                <label class="dm-check-label"><input type="checkbox"/> Vacuum Cleaner</label>
                <label class="dm-check-label"><input type="checkbox"/> Mesin Poles</label>
                <label class="dm-check-label"><input type="checkbox"/> Set Sapu &amp; Pel</label>
              </div>
            </div>

            <div class="dm-group">
              <label class="dm-label">Sarana Lainnya</label>
              <textarea class="dm-textarea" placeholder="Contoh: Karpet, Genset, CCTV, dll." style="min-height:60px;"></textarea>
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
            <div class="dm-dropzone">
              <i class="ti ti-camera-plus"></i>
              <div class="dz-name">Foto Utama Bangunan</div>
              <div class="dz-hint">Klik atau seret file JPG/PNG (Max 5MB)</div>
            </div>
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div><div>Scan SK Pendirian</div><div class="dm-doc-sub">PDF, Max 10MB</div></div>
              </div>
              <button type="button" class="dm-btn-upload"><i class="ti ti-upload"></i> Upload</button>
            </div>
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div><div>Scan AIW / Sertifikat</div><div class="dm-doc-sub">PDF, Max 10MB</div></div>
              </div>
              <button type="button" class="dm-btn-upload"><i class="ti ti-upload"></i> Upload</button>
            </div>
            <div class="dm-doc-row">
              <div class="dm-doc-left">
                <i class="ti ti-file-text"></i>
                <div><div>Scan KTP Takmir</div><div class="dm-doc-sub">Sudah Terunggah (ktp_takmir.pdf)</div></div>
              </div>
              <i class="ti ti-circle-check dm-doc-done"></i>
            </div>
          </div>

          <!-- DATA TAKMIR -->
          <div class="dm-takmir-card">
            <div class="dm-takmir-title">
              <i class="ti ti-users-group"></i> Data Takmir Awal
            </div>
            <div class="dm-group">
              <label class="dm-label">Nama Ketua Takmir</label>
              <input class="dm-input" type="text" placeholder="Nama lengkap"/>
            </div>
            <div class="dm-grid-2">
              <div class="dm-group">
                <label class="dm-label">NIK</label>
                <input class="dm-input" type="text" placeholder="16 digit"/>
              </div>
              <div class="dm-group">
                <label class="dm-label">Nomor WhatsApp</label>
                <input class="dm-input" type="text" placeholder="08xx"/>
              </div>
            </div>
          </div>

          <!-- RINGKASAN -->
          <div class="dm-ringkasan">
            <div class="dm-ringkasan-title">
              <i class="ti ti-clipboard-check"></i> Ringkasan Pengajuan
            </div>
            <div class="dm-rs-label">KELENGKAPAN DATA &nbsp; 65%</div>
            <div class="dm-rs-bar-wrap"><div class="dm-rs-bar-fill"></div></div>
            <div class="dm-rs-item dm-rs-done"><i class="ti ti-circle-check"></i> Informasi Dasar (Lengkap)</div>
            <div class="dm-rs-item dm-rs-done"><i class="ti ti-circle-check"></i> Data Takmir (Lengkap)</div>
            <div class="dm-rs-item dm-rs-pending"><i class="ti ti-clock"></i> Legalitas &amp; Wakaf (Belum Lengkap)</div>
            <div class="dm-rs-item dm-rs-pending"><i class="ti ti-clock"></i> Unggah Dokumen (2/3 Selesai)</div>
            <div class="dm-rs-note">
              <strong>CATATAN ADMIN</strong>
              Data akan diproses oleh Superadmin dalam 2×24 jam setelah pengiriman.
            </div>
          </div>

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
            Kirim ke Superadmin <i class="ti ti-send" style="font-size:14px;"></i>
          </button>
        </div>
      </div>

      </form>

    </main>
  </div>
</div>
</body>
</html>