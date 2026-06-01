<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Persetujuan - PDM Kota Batam</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f6f8eb] text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col">

        <header class="bg-green-800 text-white px-6 py-3 flex justify-between items-center z-20 shadow-md">
            <h1 class="font-bold text-lg">PDM Kota Batam</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 px-4 py-1.5 rounded text-xs font-bold uppercase hover:bg-red-700">Logout</button>
            </form>
        </header>

        <div class="flex flex-1 overflow-hidden">

            @include('superadmin.sidebar')

            <main class="flex-1 p-8 overflow-y-auto">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Antrian Persetujuan</h2>
                    <p class="text-gray-500 font-medium">Tinjau dan kelola permintaan institusional yang tertunda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-500 uppercase">Total Antrian</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">24</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-500 uppercase">Dari PCM</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">08</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-500 uppercase">Dari Masjid</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">16</p>
                    </div>
                </div>

                <section class="mb-8">
                    <h3 class="text-lg font-bold text-green-800 mb-4 px-2">Permintaan PCM (Cabang)</h3>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Nama Entitas</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Kategori</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 text-sm">24 Okt 2024</td>
                                    <td class="p-4 text-sm font-bold">PCM Batam Kota</td>
                                    <td class="p-4 text-sm">Pembentukan Cabang Baru</td>
                                    <td class="p-4 text-center">
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-green-700">Review</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="mb-8">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 px-2">Permintaan PRM (Ranting)</h3>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center text-gray-400 text-sm">
                        Tidak ada antrian dari Pimpinan Ranting saat ini.
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-bold text-yellow-700 mb-4 px-2">Permintaan Masjid</h3>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Nama Entitas</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Kategori</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 text-sm">23 Okt 2024</td>
                                    <td class="p-4 text-sm font-bold">Masjid Al-Falah</td>
                                    <td class="p-4 text-sm">Renovasi Wakaf</td>
                                    <td class="p-4 text-center">
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-green-700">Review</button>
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
