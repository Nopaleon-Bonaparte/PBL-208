<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Antrian Persetujuan — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
@include('shared.styles')
<style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'persetujuan'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'persetujuan'])

    <main class="page-content">

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Antrian Persetujuan</h2>
        <p class="text-gray-500 font-medium">Tinjau dan kelola permintaan institusional yang tertunda.</p>
      </div>

      <div class="stat-cards" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-clipboard-list"></i></div>
            <span class="stat-pill pill-green">Total</span>
          </div>
          <div class="stat-label">Total Antrian</div>
          <div class="stat-value">24</div>
        </div>

        <div class="stat-card">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-building-bank"></i></div>
            <span class="stat-pill pill-blue">PCM</span>
          </div>
          <div class="stat-label">Dari PCM</div>
          <div class="stat-value">08</div>
        </div>

        <div class="stat-card urgent">
          <div class="stat-card-top">
            <div class="stat-card-icon"><i class="ti ti-building-mosque"></i></div>
            <span class="stat-pill pill-amber">Masjid</span>
          </div>
          <div class="stat-label">Dari Masjid</div>
          <div class="stat-value">16</div>
        </div>

      </div>

      <section style="margin-bottom:40px;">
        <h3 class="text-lg font-bold text-green-800 mb-5 px-2">Permintaan PCM (Cabang)</h3>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
          <table class="w-full text-left" style="font-size:15px;">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Tanggal</th>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Nama Entitas</th>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Kategori</th>
                <th class="p-5 font-bold text-gray-500 uppercase text-center" style="font-size:12px;">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr class="hover:bg-gray-50">
                <td class="p-5" style="font-size:15px;">24 Okt 2024</td>
                <td class="p-5 font-bold" style="font-size:15px;">PCM Batam Kota</td>
                <td class="p-5" style="font-size:15px;">Pembentukan Cabang Baru</td>
                <td class="p-5 text-center">
                  <button class="bg-green-600 text-white rounded font-bold hover:bg-green-700" style="padding:8px 18px;font-size:13px;">Review</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section style="margin-bottom:40px;">
        <h3 class="text-lg font-bold text-blue-800 mb-5 px-2">Permintaan PRM (Ranting)</h3>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 text-center text-gray-400" style="font-size:15px;">
          Tidak ada antrian dari Pimpinan Ranting saat ini.
        </div>
      </section>

      <section>
        <h3 class="text-lg font-bold text-yellow-700 mb-5 px-2">Permintaan Masjid</h3>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
          <table class="w-full text-left" style="font-size:15px;">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Tanggal</th>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Nama Entitas</th>
                <th class="p-5 font-bold text-gray-500 uppercase" style="font-size:12px;">Kategori</th>
                <th class="p-5 font-bold text-gray-500 uppercase text-center" style="font-size:12px;">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr class="hover:bg-gray-50">
                <td class="p-5" style="font-size:15px;">23 Okt 2024</td>
                <td class="p-5 font-bold" style="font-size:15px;">Masjid Al-Falah</td>
                <td class="p-5" style="font-size:15px;">Renovasi Wakaf</td>
                <td class="p-5 text-center">
                  <button class="bg-green-600 text-white rounded font-bold hover:bg-green-700" style="padding:8px 18px;font-size:13px;">Review</button>
                </td>
              </tr>
            </tbody>
          </table> 
        </div>
      </section>

    </main>
  </div>
</div>
</body>
</html>