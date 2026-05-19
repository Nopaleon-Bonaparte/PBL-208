<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Takmir - SIM Muhammadiyah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-green-900 text-white flex flex-col transition-all">
            <div class="p-6 text-center border-b border-green-800">
                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-3 flex items-center justify-center p-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h2 class="font-bold text-lg">Panel Takmir</h2>
                <p class="text-xs text-green-300">Pengurus Masjid</p>
            </div>

            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="#" class="flex items-center gap-3 bg-green-800 text-white px-4 py-3 rounded-xl font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                    Ringkasan
                </a>
                <a href="#" class="flex items-center gap-3 text-green-100 hover:bg-green-800 px-4 py-3 rounded-xl font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" /></svg>
                    Jadwal Kajian
                </a>
                <a href="#" class="flex items-center gap-3 text-green-100 hover:bg-green-800 px-4 py-3 rounded-xl font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    Laporan Kas
                </a>
            </nav>

            <div class="p-4 border-t border-green-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl font-bold flex items-center justify-center gap-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                        LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">

            <header class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Ahlan wa Sahlan, {{ session('username') }}</h1>
                    <p class="text-gray-500 mt-1">Kelola data dan kegiatan masjid Anda di sini.</p>
                </div>
                <div class="bg-white border border-gray-200 px-4 py-2 rounded-lg shadow-sm font-bold text-green-700">
                    Sesi: Pengurus Masjid
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Saldo Kas Saat Ini</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">Rp 4.500.000</p>
                    <p class="text-xs text-green-600 font-medium mt-2">+ Rp 500.000 jumat lalu</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Kegiatan Pekan Ini</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">3</p>
                    <p class="text-xs text-blue-600 font-medium mt-2">Kajian rutinan & TPA</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Status Legalitas</p>
                    <p class="text-2xl font-bold text-green-700 mt-2">TERDAFTAR</p>
                    <p class="text-xs text-gray-400 font-medium mt-2">Update terakhir: 2026</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-900 text-lg">Jadwal Imam & Khatib Terdekat</h3>
                    <button class="text-green-700 text-sm font-bold hover:underline">Kelola Jadwal</button>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div class="flex items-center gap-4">
                            <div class="bg-green-100 text-green-800 w-12 h-12 rounded-xl flex flex-col items-center justify-center font-bold">
                                <span class="text-xs uppercase">Jum</span>
                                <span class="text-lg leading-none">01</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Shalat Jumat</p>
                                <p class="text-sm text-gray-500">Khatib: Ustadz Fulan bin Fulan</p>
                            </div>
                        </div>
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">Terjadwal</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-100 text-blue-800 w-12 h-12 rounded-xl flex flex-col items-center justify-center font-bold">
                                <span class="text-xs uppercase">Sab</span>
                                <span class="text-lg leading-none">02</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Kajian Subuh</p>
                                <p class="text-sm text-gray-500">Pemateri: Ustadz Abdullah</p>
                            </div>
                        </div>
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">Terjadwal</span>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
