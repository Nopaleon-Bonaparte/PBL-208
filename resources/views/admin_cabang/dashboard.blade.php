<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Cabang - SIM Muhammadiyah</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex h-screen">
        <div class="w-64 bg-green-900 text-white flex flex-col p-6">
            <h1 class="text-xl font-bold mb-8">Admin Cabang</h1>
            <nav class="space-y-4 flex-1">
                <a href="#" class="block py-2 px-4 bg-green-800 rounded-lg">Dashboard</a>
                <a href="#" class="block py-2 px-4 hover:bg-green-800 rounded-lg transition">Data Ranting</a>
                <a href="#" class="block py-2 px-4 hover:bg-green-800 rounded-lg transition">Data Masjid</a>
                <a href="#" class="block py-2 px-4 hover:bg-green-800 rounded-lg transition">Laporan Bulanan</a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left py-2 px-4 text-red-400 hover:text-red-300 font-bold">
                    Logout
                </button>
            </form>
        </div>

        <div class="flex-1 p-10">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Halo, {{ session('username') }}</h2>
                    <p class="text-gray-500">Selamat datang di panel kendali Cabang.</p>
                </div>
                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 font-bold text-green-700">
                    Sesi: Admin Cabang
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Ranting</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $total_ranting }}</h3>
                    <p class="text-xs text-green-600 mt-2 font-bold">Di wilayah cabang Anda</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium mb-1">Masjid Terkelola</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $total_masjid }}</h3>
                    <p class="text-xs text-blue-600 mt-2 font-bold">Aktif beroperasi</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium mb-1">Menunggu Persetujuan</p>
                    <h3 class="text-3xl font-bold text-red-600">3</h3>
                    <p class="text-xs text-gray-400 mt-2 font-bold">Update data dari ranting</p>
                </div>
            </div>
        </div>
    </div>

@include('shared.privilege-notification')
</body>
</html>

