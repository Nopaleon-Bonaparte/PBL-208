<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Status Ranting — PDM Kota Batam</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.9.0/dist/tabler-icons.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
@include('shared.styles')
<style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body>
<div class="app-shell">

  @include('superadmin.sidebar', ['activeNav' => 'status-ranting'])

  <div class="main-shell">
    @include('superadmin.topbar', ['activeTopLink' => 'status-ranting'])

    <main class="page-content">

      <div class="flex justify-between items-end mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Data Ranting (Kelurahan)</h2>
          <p class="text-gray-500 font-medium mt-1">Pantau status keaktifan tingkat PRM se-Kota Batam</p>
        </div>
        <div class="flex gap-3">
          <div class="relative">
            <input type="text" placeholder="Cari ranting..." class="pl-4 pr-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 w-64 text-sm">
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
          <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
              <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Ranting</th>
              <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Cabang Induk (Kecamatan)</th>
              <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Ketua Ranting</th>
              <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
              <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">

            <tr class="hover:bg-gray-50 transition">
              <td class="p-4 text-sm font-bold text-gray-900">PRM Kibing</td>
              <td class="p-4 text-sm text-gray-600">PCM Batu Aji</td>
              <td class="p-4 text-sm text-gray-600">Supardi</td>
              <td class="p-4 text-center">
                <div class="inline-flex items-center gap-2">
                  <span class="w-3 h-3 rounded-full border-[2px] border-green-500 block"></span>
                  <span class="bg-green-500 text-white text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">Aktif</span>
                </div>
              </td>
              <td class="p-4 text-center">
                <button class="text-green-700 font-semibold text-sm hover:underline">Detail</button>
              </td>
            </tr>

            <tr class="hover:bg-gray-50 transition">
              <td class="p-4 text-sm font-bold text-gray-900">PRM Tanjung Uncang</td>
              <td class="p-4 text-sm text-gray-600">PCM Batu Aji</td>
              <td class="p-4 text-sm text-gray-600">Mulyadi</td>
              <td class="p-4 text-center">
                <div class="inline-flex items-center gap-2">
                  <span class="w-3 h-3 rounded-full border-[2px] border-green-500 block"></span>
                  <span class="bg-green-500 text-white text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">Aktif</span>
                </div>
              </td>
              <td class="p-4 text-center">
                <button class="text-green-700 font-semibold text-sm hover:underline">Detail</button>
              </td>
            </tr>

            <tr class="hover:bg-gray-50 transition">
              <td class="p-4 text-sm font-bold text-gray-900">PRM Sekanak Raya</td>
              <td class="p-4 text-sm text-gray-600">PCM Belakang Padang</td>
              <td class="p-4 text-sm text-gray-600">Hasan Basri</td>
              <td class="p-4 text-center">
                <div class="inline-flex items-center gap-2">
                  <span class="w-3 h-3 rounded-full border-[2px] border-yellow-400 block"></span>
                  <span class="bg-yellow-400 text-white text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">-Aktif</span>
                </div>
              </td>
              <td class="p-4 text-center">
                <button class="text-green-700 font-semibold text-sm hover:underline">Detail</button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

    </main>
  </div>
</div>
</body>
</html>