<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Masjid/Musholla - PDM Kota Batam</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f6f8eb] text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col">

        <!-- Header -->
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

            <!-- Panggil Sidebar -->
            @include('superadmin.sidebar')

            <!-- Konten Halaman Form -->
            <main class="flex-1 p-8 overflow-y-auto">

                <div class="mb-6">
                    <a href="/superadmin/status-masjid" class="text-green-700 font-semibold text-sm hover:underline mb-2 inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                        Kembali
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Data Tempat Ibadah</h2>
                    <p class="text-gray-500 font-medium mt-1">Masukkan informasi aset masjid atau musholla baru.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-3xl">
                    <form action="/superadmin/status-masjid/simpan" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Tempat Ibadah</label>
                            <input type="text" name="nama" placeholder="Contoh: Masjid Raya Al-Falah" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 bg-white">
                                    <option value="Masjid">Masjid</option>
                                    <option value="Musholla">Musholla</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Pengelola (PCM/PRM)</label>
                                <input type="text" name="pengelola" placeholder="Contoh: PCM Nongsa" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Status Lahan</label>
                            <select name="status_lahan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 bg-white">
                                <option value="Wakaf Sertifikat">Wakaf Bersertifikat</option>
                                <option value="Proses Wakaf">Dalam Proses Wakaf</option>
                                <option value="Hak Pakai">Hak Pakai</option>
                                <option value="Sewa">Sewa</option>
                            </select>
                        </div>

                        <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
                            <a href="/superadmin/status-masjid" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
                            <button type="submit" class="px-5 py-2 bg-green-700 text-white rounded-lg font-semibold hover:bg-green-800 transition shadow-sm">
                                Simpan Data
                            </button>
                        </div>

                    </form>
                </div>

            </main>
        </div>
    </div>
</body>
</html>
