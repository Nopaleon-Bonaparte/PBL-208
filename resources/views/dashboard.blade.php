<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SuperAdmin - PDM Batam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @include('layouts.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">

            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard SuperAdmin</h2>
                    <p class="text-gray-500">Monitoring menyeluruh PDM Muhammadiyah Kota Batam</p>
                </div>
                <div class="flex gap-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" placeholder="Search tickets..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <button class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Total Anggota</p>
                        <h3 class="text-3xl font-bold text-gray-800">100</h3>
                        <p class="text-xs text-green-600 font-semibold mt-1">+ 20 bulan ini</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-xl text-green-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Pimpinan Cabang</p>
                        <h3 class="text-3xl font-bold text-gray-800">12</h3>
                        <p class="text-xs text-green-600 font-semibold mt-1">Aktif dari 15 kecamatan</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-xl text-green-600">
                        <i class="fas fa-sitemap text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Pimpinan Ranting</p>
                        <h3 class="text-3xl font-bold text-gray-800">36</h3>
                        <p class="text-xs text-gray-500 mt-1">Dari 5 cabang</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-xl text-green-600">
                        <i class="fas fa-user-check text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Antrian ACC</p>
                        <h3 class="text-3xl font-bold text-gray-800">9</h3>
                        <p class="text-xs text-red-500 font-semibold mt-1">Perlu ditindaklanjuti</p>
                    </div>
                    <div class="bg-green-700 p-3 rounded-xl text-white">
                        <i class="fas fa-check-double text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800">Status Cabang (Kecamatan)</h3>
                        <a href="#" class="text-sm text-green-700 font-semibold">Lihat Semua</a>
                    </div>
                    <ul class="space-y-4">
                        @foreach(['Batu Aji' => 'AKTIF', 'Batu Ampar' => 'AKTIF', 'Belakang Padang' => 'NON-AKTIF', 'Nongsa' => 'AKTIF', 'Sagulung' => 'VAKUM'] as $kec => $status)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-700">{{ $kec }}</span>
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $status == 'AKTIF' ? 'bg-green-100 text-green-700' : ($status == 'VAKUM' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $status }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800">Antrian Persetujuan</h3>
                        <a href="#" class="text-sm text-green-700 font-semibold">Lihat Semua</a>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-4 flex justify-between items-center mb-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-[10px] font-bold uppercase">Cabang</div>
                            <span class="text-sm font-semibold text-gray-700">Perubahan Takmir</span>
                        </div>
                        <span class="text-[10px] font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded">MENUNGGU</span>
                    </div>
                    <button class="w-full py-3 text-sm font-semibold text-gray-400 hover:text-green-700 transition-colors">
                        Lihat Semua Pengajuan <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
