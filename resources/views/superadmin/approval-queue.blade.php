<main class="flex-1 p-8 bg-[#f6f8eb] min-h-screen">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Antrian Persetujuan</h2>
        <p class="text-gray-500 mt-1">Kelola permohonan perubahan data dari PCM, PRM, dan Masjid.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b">
                    <th class="p-4 font-bold">Jenis Permohonan</th>
                    <th class="p-4 font-bold">Asal Organisasi (PCM/PRM)</th>
                    <th class="p-4 font-bold">Tanggal Masuk</th>
                    <th class="p-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4">
                        <span class="font-semibold block text-gray-800">Perubahan Struktur Takmir</span>
                        <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full uppercase">Update Masjid</span>
                    </td>
                    <td class="p-4 text-gray-600">PCM Batu Aji</td>
                    <td class="p-4 text-gray-500">17 April 2026</td>
                    <td class="p-4">
                        <div class="flex justify-center gap-2">
                            <button class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold hover:bg-yellow-500">Tinjau</button>
                            <button class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-bold hover:bg-green-700">Setuju</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold hover:bg-red-700">Tolak</button>
                        </div>
                    </td>
                </tr>

                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4">
                        <span class="font-semibold block text-gray-800">Pendaftaran Anggota Baru</span>
                        <span class="text-[10px] bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full uppercase">Update Anggota</span>
                    </td>
                    <td class="p-4 text-gray-600">PRM Buliang</td>
                    <td class="p-4 text-gray-500">18 April 2026</td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">Tinjau</button>
                            <button class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-bold">Setuju</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold">Tolak</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
