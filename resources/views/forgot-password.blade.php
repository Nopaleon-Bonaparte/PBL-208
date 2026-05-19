<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-3xl shadow-lg border border-gray-100 p-8 md:p-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-green-800 mb-2">Lupa Password?</h1>
            <p class="text-sm text-gray-500">Masukkan ID Anggota atau email terdaftar. Super Admin akan memproses permintaan reset password Anda.</p>
        </div>

        <form class="space-y-6">
            <div>
                <label class="block text-green-800 font-bold mb-2 text-sm">ID Anggota / Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-green-700">👤</span>
                    </div>
                    <input type="text" placeholder="Contoh: 4342501069" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm">
                </div>
            </div>

            <button type="button" class="w-full bg-green-800 hover:bg-green-900 text-white font-bold py-3 rounded-lg transition shadow-md">
                KIRIM PERMINTAAN RESET
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/login" class="text-sm text-green-700 font-semibold hover:underline">Kembali ke Halaman Login</a>
        </div>
    </div>
</div>
