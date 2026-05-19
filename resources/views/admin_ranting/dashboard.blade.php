<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Ranting - PDM Kota Batam</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="text-gray-800 antialiased bg-[#f6f8eb]">

    <div class="min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="bg-green-700 text-white px-6 py-3 flex justify-between items-center z-20 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1">
                    <img src="{{ asset('images/logo-muhammadiyah-official.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight">Pimpinan Ranting Muhammadiyah</h1>
                    <p class="text-xs text-green-200">Panel Admin Kelurahan/Desa</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-green-800 px-3 py-1.5 rounded-full text-xs font-semibold border border-green-600">
                    Sesi: Admin Ranting
                </div>

                <!-- TOMBOL LOGOUT -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-gray-100 text-green-800 px-4 py-2 rounded font-bold text-sm shadow transition cursor-pointer">
                        LOGOUT
                    </button>
                </form>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            <!-- SIDEBAR -->
            <aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto flex-shrink-0">
                <nav class="p-4 space-y-6">

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">DASHBOARD</p>
                        <a href="#" class="flex items-center gap-3 bg-[#f6f8eb] text-green-800 px-3 py-2.5 rounded-lg font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Ringkasan Ranting
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">MANAJEMEN</p>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                            Data Masjid/Musholla
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Data Jamaah
                        </a>
                    </div>

                </nav>
            </aside>

            <!-- KONTEN UTAMA -->
            <main class="flex-1 p-8 overflow-y-auto">

                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Ahlan wa Sahlan, {{ session('username') ?? 'Admin' }}</h2>
                        <p class="text-gray-500 font-medium mt-1">Pantau perkembangan dan kegiatan ranting Anda di sini.</p>
                    </div>
                </div>

                <!-- KOTAK STATISTIK -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Masjid / Musholla</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">4</p>
                            <p class="text-sm text-green-600 font-medium">Dalam naungan ranting</p>
                        </div>
                        <div class="p-3 bg-green-50 text-green-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Total Jamaah</p>
                            <p class="text-4xl font-bold text-gray-900 mb-2">125</p>
                            <p class="text-sm text-blue-600 font-medium">Jamaah aktif</p>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-500 mb-1 tracking-wider uppercase">Laporan Kas Ranting</p>
                            <p class="text-2xl font-bold text-gray-900 mb-2 mt-1">Rp 1.250.000</p>
                            <p class="text-sm text-green-600 font-medium">Bulan ini</p>
                        </div>
                        <div class="p-3 bg-green-800 text-white rounded-xl shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- DAFTAR MASJID -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 text-lg">Status Masjid & Musholla</h3>
                        <a href="#" class="text-green-700 font-semibold text-sm hover:underline">Kelola Data</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">Masjid Al-Ikhlas</span>
                                <span class="text-xs text-gray-500">Takmir: Budi Santoso</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-md font-bold uppercase tracking-wide">Aktif</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">Masjid At-Taqwa</span>
                                <span class="text-xs text-gray-500">Takmir: Rahman Hakim</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-md font-bold uppercase tracking-wide">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
