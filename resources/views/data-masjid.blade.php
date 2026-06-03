<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Masjid & Musholla - PDM Batam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f4f7f5] flex h-screen overflow-hidden font-sans">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @include('layouts.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8 relative">

            <div class="flex justify-between items-end mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Masjid & Musholla</h2>
                    <p class="text-gray-500 mt-1">Inventaris dan status lahan amal usaha tempat ibadah</p>
                </div>

                <div class="flex gap-3">
                    <input type="text" placeholder="Cari masjid/musholla..." class="px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-green-500 text-sm w-64">

                    <button onclick="toggleModal()" class="bg-[#007b3e] hover:bg-green-800 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-colors shadow-sm">
                        <span>+</span> Tambah Data
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Tempat Ibadah</th>
                            <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Pengelola</th>
                            <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status Lahan</th>
                            <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4 text-sm font-bold text-gray-900">Masjid Raya Al-Falah</td>
                            <td class="py-4 px-4 text-sm text-gray-600">Masjid</td>
                            <td class="py-4 px-4 text-sm text-gray-600">PCM Nongsa</td>
                            <td class="py-4 px-4 text-center">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs font-bold uppercase">Wakaf Sertifikat</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <a href="#" class="text-green-700 font-bold text-sm hover:underline">Detail</a>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4 text-sm font-bold text-gray-900">Musholla At-Taqwa</td>
                            <td class="py-4 px-4 text-sm text-gray-600">Musholla</td>
                            <td class="py-4 px-4 text-sm text-gray-600">PRM Kibing</td>
                            <td class="py-4 px-4 text-center">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-xs font-bold uppercase">Proses Wakaf</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <a href="#" class="text-green-700 font-bold text-sm hover:underline">Detail</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4 text-sm font-bold text-gray-900">Masjid Baitul Makmur</td>
                            <td class="py-4 px-4 text-sm text-gray-600">Masjid</td>
                            <td class="py-4 px-4 text-sm text-gray-600">PCM Batu Aji</td>
                            <td class="py-4 px-4 text-center">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-xs font-bold uppercase">Hak Pakai</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <a href="#" class="text-green-700 font-bold text-sm hover:underline">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <div id="modal-tambah" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">

        <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-xl relative">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tambah Data Tempat Ibadah</h3>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="#" method="POST">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Tempat Ibadah</label>
                    <input type="text" placeholder="Contoh: Masjid Darussalam" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 bg-white">
                            <option>Masjid</option>
                            <option>Musholla</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status Lahan</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 bg-white">
                            <option>Wakaf Sertifikat</option>
                            <option>Proses Wakaf</option>
                            <option>Hak Pakai</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pengelola (Cabang/Ranting)</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 bg-white">
                        <option>Pilih Pengelola...</option>
                        <option>PCM Nongsa</option>
                        <option>PCM Batu Aji</option>
                        <option>PRM Kibing</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                    <button type="button" onclick="toggleModal()" class="px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-lg font-bold transition-colors">Batal</button>
                    <button type="submit" class="bg-[#007b3e] hover:bg-green-800 text-white px-6 py-2 rounded-lg font-bold transition-colors">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('modal-tambah');
            // Menambah atau menghapus class 'hidden' untuk memunculkan/menyembunyikan modal
            modal.classList.toggle('hidden');
        }
    </script>

</body>
</html>
