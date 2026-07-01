<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin - PDM Kota Batam</title>
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

            <aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto flex-shrink-0">
                <nav class="p-4 space-y-6">

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">DASHBOARD</p>
                        <!-- LINK INI SUDAH DIUBAH KE /dashboard -->
                        <a href="/dashboard" class="flex items-center gap-3 bg-[#f6f8eb] text-green-800 px-3 py-2.5 rounded-lg font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Ringkasan Utama
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">PERSETUJUAN</p>
                        <!-- LINK INI SUDAH DIUBAH KE /superadmin/persetujuan -->
                        <a href="/superadmin/persetujuan" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
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

                
                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">KEAMANAN</p>
                        <a href="/superadmin/hak-akses" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            Manajemen Hak Akses
                        </a>
                    </div>

                </nav>
            </aside>

            <main class="flex-1 p-8 overflow-y-auto">

                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Superadmin</h2>
                        <p class="text-gray-500 font-medium mt-1">Monitoring menyeluruh PDM Muhammadiyah Kota Batam</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Search tickets..." class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 w-64 text-sm">
                        </div>
                        <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 font-medium text-gray-700 transition text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Total Anggota</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">100</p>
                            <p class="text-sm text-green-600 font-medium">+ 20 bulan ini</p>
                        </div>
                        <div class="p-3 bg-green-50 text-green-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM8.25 9.5a3.146 3.146 0 00-1.5.388A3.75 3.75 0 0115 6.75c0 .354-.047.697-.135 1.02a3.145 3.145 0 00-1.5-.393H8.25zM12 12.75a5.25 5.25 0 015.158 4.25c.03.22.042.443.042.668v.582a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75v-.582c0-.225.012-.448.042-.668A5.25 5.25 0 0112 12.75zm-6.208 4.792A6.75 6.75 0 0112 11.25a6.75 6.75 0 016.208 6.292.75.75 0 01-.749.833H6.541a.75.75 0 01-.749-.833z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Pimpinan Cabang Muhammadiyah</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">12</p>
                            <p class="text-sm text-green-600 font-medium">Aktif dari 15 kecamatan</p>
                        </div>
                        <div class="p-3 bg-green-50 text-green-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Pimpinan Ranting Muhammadiyah</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">36</p>
                            <p class="text-sm text-green-600 font-medium">Dari 5 cabang aktif</p>
                        </div>
                        <div class="p-3 bg-green-50 text-green-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Antrian ACC</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">9</p>
                            <p class="text-sm text-green-600 font-medium">Perlu ditindaklanjuti</p>
                        </div>
                        <div class="p-3 bg-green-800 text-white rounded-xl shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                    </div>

                </div>

                <div class="space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-gray-900 text-lg">Status Cabang (Kecamatan)</h3>
                            <a href="#" class="text-green-700 font-semibold text-sm hover:underline">Lihat Semua</a>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-medium text-gray-800">Batu Aji</span>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 h-4 rounded-full border-[3px] border-green-500 block"></span>
                                    <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-md font-bold w-20 text-center uppercase tracking-wide">Aktif</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-medium text-gray-800">Batu Ampar</span>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 h-4 rounded-full border-[3px] border-green-500 block"></span>
                                    <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-md font-bold w-20 text-center uppercase tracking-wide">Aktif</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-medium text-gray-800">Belakang Padang</span>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 h-4 rounded-full border-[3px] border-yellow-400 block"></span>
                                    <span class="bg-yellow-400 text-white text-xs px-3 py-1 rounded-md font-bold w-20 text-center uppercase tracking-wide">-Aktif</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-medium text-gray-800">Nongsa</span>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 h-4 rounded-full border-[3px] border-green-500 block"></span>
                                    <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-md font-bold w-20 text-center uppercase tracking-wide">Aktif</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-medium text-gray-800">Sagulung</span>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 h-4 rounded-full border-[3px] border-red-500 block"></span>
                                    <span class="bg-red-400 text-white text-xs px-3 py-1 rounded-md font-bold w-20 text-center uppercase tracking-wide">Vakum</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-gray-900 text-lg">Antrian Persetujuan</h3>
                            <!-- LINK INI JUGA SUDAH DIUBAH KE /superadmin/persetujuan -->
                            <a href="/superadmin/persetujuan" class="text-green-700 font-semibold text-sm hover:underline">Lihat Semua</a>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-gray-800">Perubahan Takmir</span>
                                    <span class="bg-blue-50 border border-blue-200 text-blue-700 text-xs px-2.5 py-0.5 rounded-md font-semibold tracking-wide">Cabang</span>
                                </div>
                                <span class="bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs px-4 py-1 rounded-md font-bold uppercase tracking-wide">Menunggu</span>
                            </div>
                        </div>

                        <!-- LINK BUTTON INI JUGA UDAH DIUBAH -->
                        <a href="/superadmin/persetujuan" class="w-full py-3 border border-gray-200 rounded-lg text-gray-600 font-semibold text-sm hover:bg-gray-50 transition flex items-center justify-center gap-2">
                            Lihat Semua Pengajuan
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                </div>

            </main>
        </div>
    </div>

@include('shared.privilege-notification')
</body>
</html>

