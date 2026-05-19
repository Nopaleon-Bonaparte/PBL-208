<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Persetujuan - PDM Kota Batam</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="text-gray-800 antialiased" style="background-color: #f6f8eb;">

    <div class="min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="bg-green-800 text-white px-6 py-3 flex justify-between items-center z-20 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight">PDM Kota Batam</h1>
                    <p class="text-xs text-green-200">Sistem Informasi Manajemen Organisasi</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-yellow-400 hover:bg-yellow-500 text-yellow-900 px-4 py-1.5 rounded-full flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <div class="text-xs text-left leading-tight font-semibold">
                        <span class="block">9 Pengajuan</span>
                        <span class="block">Menunggu</span>
                    </div>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 px-4 py-2 rounded font-bold text-sm shadow transition cursor-pointer">
                        LOGOUT
                    </button>
                </form>

                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden border-2 border-green-600">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            <!-- SIDEBAR -->
            <aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto flex-shrink-0">
                <nav class="p-4 space-y-6">

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">DASHBOARD</p>
                        <!-- Link balik ke Dashboard -->
                        <a href="/dashboard" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Ringkasan Utama
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">PERSETUJUAN</p>
                        <!-- Menu ini yang sekarang dikasih warna hijau (aktif) -->
                        <a href="/superadmin/persetujuan" class="flex items-center gap-3 bg-[#f6f8eb] text-green-800 px-3 py-2.5 rounded-lg font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                            Antrian Persetujuan
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Riwayat Keputusan
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">MONITORING</p>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            Status cabang/ranting
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Status ranting
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                            Status Masjid dan Musholla
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">LAPORAN</p>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Data Anggota
                        </a>
                    </div>

                </nav>
            </aside>

            <!-- KONTEN UTAMA -->
            <main class="flex-1 p-8 overflow-y-auto">

                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Antrian Persetujuan</h2>
                        <p class="text-gray-500 font-medium mt-1">Kelola dan tindak lanjuti pengajuan dari Pimpinan Cabang dan Ranting</p>
                    </div>
                </div>

                <!-- TABEL PERSETUJUAN -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 text-lg">Daftar Pengajuan Masuk</h3>
                    </div>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-sm text-gray-500">
                                <th class="p-4 font-semibold">Tanggal</th>
                                <th class="p-4 font-semibold">Pengaju</th>
                                <th class="p-4 font-semibold">Jenis Pengajuan</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 text-gray-600 text-sm">05 Mei 2026</td>
                                <td class="p-4 font-bold text-gray-800">Admin Cabang Batu Aji</td>
                                <td class="p-4">Pendaftaran Pengurus Baru</td>
                                <td class="p-4 text-center">
                                    <button class="bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700 mr-2">Setujui</button>
                                    <button class="bg-red-100 text-red-600 px-3 py-1.5 rounded text-sm font-medium hover:bg-red-200">Tolak</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 text-gray-600 text-sm">04 Mei 2026</td>
                                <td class="p-4 font-bold text-gray-800">Admin Ranting Belakang Padang</td>
                                <td class="p-4">Pembaruan Status Legalitas Masjid</td>
                                <td class="p-4 text-center">
                                    <button class="bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700 mr-2">Setujui</button>
                                    <button class="bg-red-100 text-red-600 px-3 py-1.5 rounded text-sm font-medium hover:bg-red-200">Tolak</button>
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
