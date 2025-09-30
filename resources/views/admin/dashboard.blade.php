<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold font-[Montserrat]">SITERKENAL</div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-blue-700">📊 Dashboard</a>
            <a href="{{ route('admin.ppid') }}" class="block py-2 px-3 rounded hover:bg-blue-700">📑 Layanan Informasi PPID</a>
            <a href="{{ route('admin.rehab') }}" class="block py-2 px-3 rounded hover:bg-blue-700">💊 Layanan Rehabilitasi</a>
            
            <div>
                <p class="px-3 text-sm text-gray-200 mt-3">📌 Permohonan Kegiatan</p>
                <a href="{{ route('admin.kegiatan.sosialisasi') }}" class="block py-2 px-5 hover:bg-blue-700">1. Sosialisasi</a>
                <a href="{{ route('admin.kegiatan.magang') }}" class="block py-2 px-5 hover:bg-blue-700">2. Magang</a>
                <a href="{{ route('admin.kegiatan.urine') }}" class="block py-2 px-5 hover:bg-blue-700">3. Tes Urine</a>
                <a href="{{ route('admin.kegiatan.tat') }}" class="block py-2 px-5 hover:bg-blue-700">4. TAT</a>
            </div>

            <div>
                <p class="px-3 text-sm text-gray-200 mt-3">📌 Pengaduan Masyarakat</p>
                <a href="{{ route('admin.pengaduan.gratifikasi') }}" class="block py-2 px-5 hover:bg-blue-700">1. Gratifikasi</a>
                <a href="{{ route('admin.pengaduan.whistle') }}" class="block py-2 px-5 hover:bg-blue-700">2. Whistle Blowing</a>
                <a href="{{ route('admin.pengaduan.narkoba') }}" class="block py-2 px-5 hover:bg-blue-700">3. Penyalahgunaan Narkoba</a>
                <a href="{{ route('admin.pengaduan.kritik') }}" class="block py-2 px-5 hover:bg-blue-700">4. Kritik & Saran</a>
            </div>

            <a href="{{ route('admin.manage') }}" class="block py-2 px-3 rounded hover:bg-blue-700">👤 Tambah Admin</a>
        </nav>

        <div class="p-4 border-t border-blue-600">
            <a href="{{ route('admin.profile') }}" class="block py-2 hover:bg-blue-700 rounded">⚙️ Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left py-2 hover:bg-blue-700 rounded">🚪 Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        <h1 class="text-2xl font-bold font-[Montserrat] text-blue-900 mb-6">Dashboard Admin</h1>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-gray-600">Jumlah Data PPID</h2>
                <p class="text-3xl font-bold">120</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-gray-600">Jumlah Data Rehabilitasi</h2>
                <p class="text-3xl font-bold">80</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-gray-600">Pengunjung Hari Ini</h2>
                <p class="text-3xl font-bold">25</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="mt-8 bg-white p-6 rounded shadow">
            <h2 class="text-lg font-bold mb-4">Grafik Data Layanan</h2>
            <canvas id="chartLayanan"></canvas>
        </div>
    </main>
</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartLayanan');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [
                { label: 'PPID', data: [12,19,3,5,2,3], borderColor: 'blue' },
                { label: 'Rehab', data: [2,29,5,5,12,3], borderColor: 'green' },
            ]
        }
    });
</script>
