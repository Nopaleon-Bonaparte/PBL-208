<aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto flex-shrink-0">
    <nav class="p-4 space-y-6">

        <div>
            <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">DASHBOARD</p>
            <a href="/dashboard" class="flex items-center gap-3 {{ request()->is('dashboard') ? 'bg-[#f6f8eb] text-green-800' : 'text-gray-600 hover:bg-gray-50' }} px-3 py-2.5 rounded-lg font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                Ringkasan Utama
            </a>
        </div>

        <div>
            <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">PERSETUJUAN</p>
            <a href="/superadmin/persetujuan" class="flex items-center gap-3 {{ request()->is('superadmin/persetujuan') ? 'bg-[#f6f8eb] text-green-800' : 'text-gray-600 hover:bg-gray-50' }} px-3 py-2 rounded-lg font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
                Antrian Persetujuan
            </a>
        </div>

        <div>
    <p class="text-xs font-bold text-gray-400 mb-2 px-3 tracking-wider">MONITORING</p>

    <a href="/superadmin/status-cabang" class="flex items-center gap-3 {{ request()->is('superadmin/status-cabang') ? 'bg-[#f6f8eb] text-green-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }} px-3 py-2 rounded-lg font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
        </svg>
        Status Cabang
    </a>

    <a href="/superadmin/status-ranting" class="flex items-center gap-3 {{ request()->is('superadmin/status-ranting') ? 'bg-[#f6f8eb] text-green-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }} px-3 py-2 rounded-lg font-medium transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        Status Ranting
    </a>

    <a href="/superadmin/status-masjid" class="flex items-center gap-3 {{ request()->is('superadmin/status-masjid') ? 'bg-[#f6f8eb] text-green-800 font-semibold' : 'text-gray-600 hover:bg-gray-50' }} px-3 py-2 rounded-lg font-medium transition">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
    </svg>
        Status Masjid dan Musholla
    </a>
</div>

    </nav>
</aside>
