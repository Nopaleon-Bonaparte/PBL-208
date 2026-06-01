<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Cabang & Ranting - PDM Kota Batam</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f6f8eb] text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col">

        <header class="bg-green-800 text-white px-6 py-3 flex justify-between items-center z-20 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain" onerror="this.style.display='none'">
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight">PDM Kota Batam</h1>
                    <p class="text-xs text-green-200">Sistem Informasi Manajemen Organisasi</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 px-4 py-2 rounded font-bold text-sm shadow transition cursor-pointer">
                    LOGOUT
                </button>
            </form>
        </header>

        <div class="flex flex-1 overflow-hidden">

            @include('superadmin.sidebar')

            <main class="flex-1 p-8 overflow-y-auto">

                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Data Cabang & Ranting</h2>
                        <p class="text-gray-500 font-medium mt-1">Pantau status keaktifan PCM dan PRM se-Kota Batam</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <input type="text" placeholder="Cari cabang/ranting..." class="pl-4 pr-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 w-64 text-sm">
                        </div>
                        <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow transition">
                            + Tambah Data
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Entitas</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Pimpinan</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-sm font-bold text-gray-900">Batu Aji</td>
                                <td class="p-4 text-sm text-gray-600">Pimpinan Cabang (PCM)</td>
                                <td class="p-4 text-sm text-gray-600">Ahmad Dahlan</td>
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
                                <td class="p-4 text-sm font-bold text-gray-900">Belakang Padang</td>
                                <td class="p-4 text-sm text-gray-600">Pimpinan Cabang (PCM)</td>
                                <td class="p-4 text-sm text-gray-600">Budi Santoso</td>
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

                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-sm font-bold text-gray-900">Sagulung</td>
                                <td class="p-4 text-sm text-gray-600">Pimpinan Cabang (PCM)</td>
                                <td class="p-4 text-sm text-gray-600">Belum Ada Data</td>
                                <td class="p-4 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full border-[2px] border-red-500 block"></span>
                                        <span class="bg-red-500 text-white text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-wide">Vakum</span>
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
