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

            @include('superadmin.sidebar')

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

</body>
</html>
