<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PDM Muhammadiyah Kota Batam</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-muhammadiyah { background-color: #005b00; }
        .text-muhammadiyah { color: #005b00; }
    </style>
</head>
<body class="bg-white h-screen flex flex-col items-center justify-center p-4">

    <div class="text-center mb-8 flex flex-col items-center">
        <img src="{{ asset('images/logo-muhammadiyah-official.png') }}" alt="Logo Muhammadiyah" class="w-24 h-24 object-contain mb-4 rounded-full border-2 border-gray-100 shadow-sm">

        <h1 class="text-4xl font-bold text-muhammadiyah mb-1">Selamat Datang</h1>
        <p class="text-gray-500 font-medium text-sm">masuk ke dashboard Pimpinan Daerah Muhammadiyah</p>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-[0_0_40px_rgba(0,0,0,0.05)] border border-gray-100 w-full max-w-[400px]">

        @if($errors->has('loginError'))
            <div class="bg-red-50 text-red-600 p-3 rounded-xl text-sm mb-5 text-center font-medium">
                {{ $errors->first('loginError') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-muhammadiyah font-bold text-sm mb-2">Username/Id anggota</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input type="text" name="username" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600" placeholder="Username" required>
                </div>
            </div>

            <div class="mb-7">
                <label class="block text-muhammadiyah font-bold text-sm mb-2">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input type="password" name="password" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600" placeholder="masukkan kata sandi" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-muhammadiyah text-white font-bold py-3 rounded-lg hover:bg-green-800 transition duration-200">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-xs mb-1">Sistem ini hanya untuk anggota resmi</p>
            <p class="text-muhammadiyah font-bold text-xs">PDM Muhammadiyah Kota Batam</p>
        </div>
    </div>

</body>
</html>