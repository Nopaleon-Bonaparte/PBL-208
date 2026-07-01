<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Manajemen Hak Akses Client-Server — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
<style>
body { font-family: 'Inter', sans-serif; background: #f3f4f6; }
.main-content { padding: 40px; max-width: 800px; margin: 0 auto; }
.card { background: white; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; font-weight: bold; font-size:14px; }
.form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size:14px;}
.btn { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; font-weight: bold; width:100%; font-size:14px;}
.btn-grant { background: #10b981; }
.btn-revoke { background: #ef4444; }
.alert { padding: 12px; border-radius: 4px; margin-bottom: 20px; font-weight:bold; }
.alert-success { background: #d1fae5; color: #065f46; border:1px solid #34d399;}
.alert-danger { background: #fee2e2; color: #b91c1c; border:1px solid #f87171;}
h2 { margin-bottom: 20px; color:#111827;}
</style>
</head>
<body>
<div class="main-content">
  <h2><i class="ti ti-shield-lock text-green-700"></i> Manajemen Hak Akses (Privileges)</h2>
  <a href="/dashboard" style="display:inline-block; margin-bottom:20px; color:#10b981; text-decoration:none;">&larr; Kembali ke Dashboard</a>
  
  @if(session('priv_success'))
    <div class="alert alert-success"><i class="ti ti-check"></i> {{ session('priv_success') }}</div>
  @endif
  @if(session('priv_error'))
    <div class="alert alert-danger"><i class="ti ti-alert-triangle"></i> {{ session('priv_error') }}</div>
  @endif

  <div class="card" style="border-top: 4px solid #10b981;">
    <h3><i class="ti ti-shield-plus"></i> Pemberian Privilege (GRANT)</h3>
    <form method="POST" action="{{ url('/superadmin/hak-akses/grant') }}">
      @csrf
      <div class="form-group">
        <label>Target Role</label>
        <select name="role_id" onchange="updateGrantData(this)">
          <option value="R01" data-user="pbl_admin_cabang" data-label="Admin Cabang (R01)">Admin Cabang (R01)</option>
          <option value="R03" data-user="pbl_admin_ranting" data-label="Admin Ranting (R03)">Admin Ranting (R03)</option>
          <option value="R02" data-user="pbl_pengurus_masjid" data-label="Pengurus Masjid (R02)">Pengurus Masjid (R02)</option>
        </select>
        <input type="hidden" name="role_user" id="grant_role_user" value="pbl_admin_cabang">
        <input type="hidden" name="role_label" id="grant_role_label" value="Admin Cabang (R01)">
      </div>
      <div class="form-group">
        <label>Privilege</label>
        <select name="privilege">
          <option value="SELECT">SELECT</option>
          <option value="INSERT">INSERT</option>
          <option value="UPDATE">UPDATE</option>
          <option value="DELETE">DELETE</option>
        </select>
      </div>
      <div class="form-group">
        <label>Target Tabel</label>
        <select name="table">
          <option value="pbl_208.*">Semua Tabel (pbl_208.*)</option>
          <option value="pbl_208.masjid">masjid</option>
          <option value="pbl_208.inventaris">inventaris</option>
        </select>
      </div>
      <button type="submit" class="btn btn-grant">Jalankan GRANT</button>
    </form>
  </div>

  <div class="card" style="border-top: 4px solid #ef4444;">
    <h3><i class="ti ti-shield-minus"></i> Pencabutan Privilege (REVOKE)</h3>
    <form method="POST" action="{{ url('/superadmin/hak-akses/revoke') }}">
      @csrf
      <div class="form-group">
        <label>Target Role</label>
        <select name="role_id" onchange="updateRevokeData(this)">
          <option value="R01" data-user="pbl_admin_cabang" data-label="Admin Cabang (R01)">Admin Cabang (R01)</option>
          <option value="R03" data-user="pbl_admin_ranting" data-label="Admin Ranting (R03)">Admin Ranting (R03)</option>
          <option value="R02" data-user="pbl_pengurus_masjid" data-label="Pengurus Masjid (R02)">Pengurus Masjid (R02)</option>
        </select>
        <input type="hidden" name="role_user" id="revoke_role_user" value="pbl_admin_cabang">
        <input type="hidden" name="role_label" id="revoke_role_label" value="Admin Cabang (R01)">
      </div>
      <div class="form-group">
        <label>Privilege</label>
        <select name="privilege">
          <option value="SELECT">SELECT</option>
          <option value="INSERT">INSERT</option>
          <option value="UPDATE">UPDATE</option>
          <option value="DELETE">DELETE</option>
        </select>
      </div>
      <div class="form-group">
        <label>Target Tabel</label>
        <select name="table">
          <option value="pbl_208.*">Semua Tabel (pbl_208.*)</option>
          <option value="pbl_208.masjid">masjid</option>
          <option value="pbl_208.inventaris">inventaris</option>
        </select>
      </div>
      <button type="submit" class="btn btn-revoke">Jalankan REVOKE</button>
    </form>
  </div>
</div>

<script>
function updateGrantData(sel) {
  var opt = sel.options[sel.selectedIndex];
  document.getElementById('grant_role_user').value = opt.getAttribute('data-user');
  document.getElementById('grant_role_label').value = opt.getAttribute('data-label');
}
function updateRevokeData(sel) {
  var opt = sel.options[sel.selectedIndex];
  document.getElementById('revoke_role_user').value = opt.getAttribute('data-user');
  document.getElementById('revoke_role_label').value = opt.getAttribute('data-label');
}
</script>
</body>
</html>
