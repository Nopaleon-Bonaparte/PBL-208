<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard PDM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-6 text-center">
        <div class="flex justify-center mb-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Muhammadiyah_logo.svg" alt="Logo Muhammadiyah" class="w-24">
        </div>

        <h1 class="text-3xl font-bold text-green-700 mb-1">Selamat Datang</h1>
        <p class="text-gray-500 mb-8 text-sm">masuk ke dashboard Pimpinan Daerah Muhammadiyah</p>

        <div class="bg-white rounded-3xl shadow-lg p-8 text-left">
            <form action="#" method="POST">

                <div class="mb-4">
                    <label class="block text-green-700 font-semibold text-sm mb-2">Username/Id anggota</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-700">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" placeholder="Username" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-green-700 font-semibold text-sm mb-2">kata sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-700">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" placeholder="masukkan kata sandi" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-green-700 font-semibold text-sm mb-2">Masuk sebagai</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-500">
                            <i class="fas fa-key"></i>
                        </span>
                        <select class="w-full pl-10 pr-8 py-2 border border-gray-300 rounded-lg appearance-none bg-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 cursor-pointer">
                            <option value="super_admin">Super Admin</option>
                            <option value="admin_cabang">Admin Cabang</option>
                            <option value="admin_ranting">Admin Ranting</option>
                            <option value="pengurus_masjid">Pengurus Masjid</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                    Masuk
                </button>

            </form>

            <div class="text-center mt-6 text-xs text-gray-400">
                <p>Sistem ini hanya untuk anggota resmi</p>
                <p class="font-bold text-green-700 mt-1">PDM Muhammadiyah Kota Batam</p>
            </div>
        </div>
    </div>
</body>
</html>
