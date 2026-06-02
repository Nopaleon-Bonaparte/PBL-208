<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Persetujuan - PDM Batam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f4f7f5] flex h-screen overflow-hidden font-sans">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @include('layouts.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Antrian Persetujuan</h2>
                <p class="text-gray-600 mt-1">Kelola dan tindak lanjuti pengajuan dari Pimpinan Cabang dan Ranting</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Daftar Pengajuan Masuk</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="py-3 px-4 text-sm font-semibold text-gray-500">Tanggal</th>
                                <th class="py-3 px-4 text-sm font-semibold text-gray-500">Pengaju</th>
                                <th class="py-3 px-4 text-sm font-semibold text-gray-500">Jenis Pengajuan</th>
                                <th class="py-3 px-4 text-sm font-semibold text-gray-500 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4 text-sm text-gray-600">05 Mei 2026</td>
                                <td class="py-4 px-4 text-sm font-bold text-gray-900">Admin Cabang Batu Aji</td>
                                <td class="py-4 px-4 text-sm text-gray-600">Pendaftaran Pengurus Baru</td>
                                <td class="py-4 px-4 flex justify-center gap-3">
                                    <button class="bg-[#16a34a] hover:bg-green-700 text-white px-5 py-1.5 rounded text-sm font-semibold transition-colors">
                                        Setujui
                                    </button>
                                    <button class="bg-red-100 hover:bg-red-200 text-red-600 px-5 py-1.5 rounded text-sm font-semibold transition-colors">
                                        Tolak
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4 text-sm text-gray-600">04 Mei 2026</td>
                                <td class="py-4 px-4 text-sm font-bold text-gray-900">Admin Ranting Belakang Padang</td>
                                <td class="py-4 px-4 text-sm text-gray-600">Pembaruan Status Legalitas Masjid</td>
                                <td class="py-4 px-4 flex justify-center gap-3">
                                    <button class="bg-[#16a34a] hover:bg-green-700 text-white px-5 py-1.5 rounded text-sm font-semibold transition-colors">
                                        Setujui
                                    </button>
                                    <button class="bg-red-100 hover:bg-red-200 text-red-600 px-5 py-1.5 rounded text-sm font-semibold transition-colors">
                                        Tolak
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
