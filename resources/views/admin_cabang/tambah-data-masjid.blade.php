<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Edit Data Masjid — PCM Administration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@include('shared.styles')
<style>
body { font-family:'Inter',sans-serif; }
.dm-card { background:#fff; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,.07); padding:22px; max-width:680px; }
.dm-group { margin-bottom:16px; }
.dm-label { display:block; font-size:13px; font-weight:600; color:var(--gray-700); margin-bottom:6px; }
.dm-input, .dm-textarea, .dm-select { width:100%; padding:10px 12px; border:1px solid var(--gray-300);
  border-radius:8px; font-size:13px; font-family:inherit; }
.dm-textarea { min-height:72px; resize:vertical; }
.dm-radio-group { display:flex; gap:18px; }
.dm-radio-label { font-size:13px; display:flex; align-items:center; gap:6px; cursor:pointer; }
.dm-footer { display:flex; gap:10px; margin-top:8px; }
.flash.err { background:#fee2e2; color:#b91c1c; padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:16px; }
</style>
</head>
<body>
<div class="app-shell">

  @include('admin_cabang.sidebar', ['activeNav' => 'sub-branches'])

  <div class="main-shell">
    @include('admin_cabang.topbar', ['activeTopLink' => 'sub-branches'])

    <main class="page-content">

      @php $m = $masjid; @endphp

      <div class="page-header" style="margin-bottom:20px;">
        <div class="page-header-left">
          <h1>Edit Data Masjid</h1>
          <p>Sebagai admin cabang, perubahan Anda langsung diterapkan ke data.</p>
        </div>
      </div>

      @if($errors->any())
        <div class="flash err">@foreach($errors->all() as $e) {{ $e }}<br> @endforeach</div>
      @endif

      <div class="dm-card">
        <form method="POST" action="{{ url('/pcm/edit-masjid/'.$m->id_masjid) }}">
          @csrf
          @method('PUT')

          <div class="dm-group">
            <label class="dm-label">Nama Masjid/Musholla</label>
            <input class="dm-input" type="text" name="nama_masjid" required
                   value="{{ old('nama_masjid', $m->nama_masjid) }}"/>
          </div>

          <div class="dm-group">
            <label class="dm-label">Tipe Bangunan</label>
            <div class="dm-radio-group">
              <label class="dm-radio-label">
                <input type="radio" name="tipe" value="Masjid"
                  {{ old('tipe', $m->tipe) === 'Masjid' ? 'checked' : '' }}/> Masjid
              </label>
              <label class="dm-radio-label">
                <input type="radio" name="tipe" value="Musholla"
                  {{ old('tipe', $m->tipe) === 'Musholla' ? 'checked' : '' }}/> Musholla
              </label>
            </div>
          </div>

          <div class="dm-group">
            <label class="dm-label">Alamat Lengkap</label>
            <textarea class="dm-textarea" name="alamat">{{ old('alamat', $m->alamat) }}</textarea>
          </div>

          <div class="dm-group">
            <label class="dm-label">Wilayah / Kecamatan</label>
            <input class="dm-input" type="text" name="wilayah" value="{{ old('wilayah', $m->wilayah) }}"/>
          </div>

          <div class="dm-group">
            <label class="dm-label">Kontak Pengurus (No. HP)</label>
            <input class="dm-input" type="text" name="kontak_pengurus" value="{{ old('kontak_pengurus', $m->kontak_pengurus) }}"/>
          </div>

          <div class="dm-group">
            <label class="dm-label">Status Legalitas</label>
            <select class="dm-select" name="status_legalitas">
              @php $sl = old('status_legalitas', $m->status_legalitas); @endphp
              <option value="Proses"    {{ $sl === 'Proses' ? 'selected' : '' }}>Proses</option>
              <option value="Terdaftar" {{ $sl === 'Terdaftar' ? 'selected' : '' }}>Terdaftar</option>
              <option value="Belum"     {{ $sl === 'Belum' ? 'selected' : '' }}>Belum Terdaftar</option>
            </select>
          </div>

          <div class="dm-footer">
            <a href="{{ url('/pcm/sub-branches') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>

    </main>
  </div>
</div>
</body>
</html>
