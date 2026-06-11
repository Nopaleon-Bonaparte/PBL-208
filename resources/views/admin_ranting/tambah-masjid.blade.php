<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tempat Ibadah - PDM Kota Batam</title>
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

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-gray-100 text-green-800 px-4 py-2 rounded font-bold text-sm shadow transition cursor-pointer">
                        LOGOUT
                    </button>
                </form>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            <aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto flex-shrink-0">
                <nav class="p-4 space-y-6">

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">DASHBOARD</p>
                        <a href="/admin-ranting/dashboard" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Ringkasan Ranting
                        </a>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">MANAJEMEN</p>
                        <a href="/admin-ranting/masjid" class="flex items-center gap-3 bg-[#f6f8eb] text-green-800 px-3 py-2.5 rounded-lg font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                            Data Masjid/Musholla
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-lg font-medium transition mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Data Jamaah
                        </a>
                    </div>

                </nav>
            </aside>

            <main class="flex-1 p-8 overflow-y-auto">

                <div class="mb-6">
                    <a href="/admin-ranting/masjid" class="text-green-700 hover:underline flex items-center gap-1 text-sm font-semibold mb-4 inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Data Tempat Ibadah</h2>
                    <p class="text-gray-500 font-medium mt-1">Masukkan informasi aset masjid atau musholla baru di tingkat ranting.</p>
                </div>

                <form action="/admin-ranting/masjid/simpan" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-3xl">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Tempat Ibadah</label>
                        <input type="text" name="nama" placeholder="Contoh: Masjid Al-Ikhlas" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent text-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-sm">
                                <option value="Masjid">Masjid</option>
                                <option value="Musholla">Musholla</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pengelola</label>
                            <input type="text" name="pengelola" placeholder="Contoh: PRM Ranting A" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-600 text-sm">
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status Lahan</label>
                        <select name="status_lahan" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-sm">
                            <option value="Wakaf Bersertifikat">Wakaf Bersertifikat</option>
                            <option value="Proses Wakaf">Proses Wakaf</option>
                            <option value="Hak Pakai">Hak Pakai</option>
                            <option value="Sewa">Sewa</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-5">
                        <a href="/admin-ranting/masjid" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-50 transition">Batal</a>
                        <button type="submit" class="px-5 py-2.5 bg-green-700 text-white rounded-lg font-semibold text-sm hover:bg-green-800 transition shadow-sm">Simpan Data</button>
                    </div>
                </form>

            </main>
        </div>
    </div>

</body>
</html>
