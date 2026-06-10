<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.parchment-font{font-family:'Crimson Text',serif;}
.tech-font{font-family:'Chakra Petch',sans-serif;}
.bg-industrial{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
</style>
<div class="py-8 bg-industrial min-h-screen relative z-10 tech-font">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="font-bold text-2xl text-[#B8860B] tracking-[0.3em] uppercase italic">Petshop & Klinik Hewan Terdekat</h2>
        <p class="text-[#e2d1b3]/40 text-[9px] uppercase tracking-[0.5em] mt-1">Menampilkan hasil untuk: <span class="text-[#B8860B]">{{ $city ?? $province ?? 'Lokasi Terdekat' }}</span></p>
    </div>
    <a href="{{ route('pets.index') }}" class="bg-[#2a1d15] border-2 border-[#B8860B]/40 text-[#B8860B] px-4 py-2 text-[9px] font-black uppercase tracking-widest hover:bg-[#B8860B] hover:text-black transition">Kembali</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 p-4">
            <h3 class="text-[#B8860B] text-[9px] font-black uppercase tracking-[0.3em] mb-1">Hasil Pencarian</h3>
            <p class="text-[#e2d1b3]/50 text-[8px] parchment-font italic">Klik tombol di bawah untuk buka peta lengkap atau hubungi langsung</p>
        </div>

        @php
        $suggestions = [
            [
                'nama'  => 'Petshop & Klinik Hewan',
                'tag'   => 'Klinik Hewan',
                'desc'  => 'Layanan pemeriksaan, vaksin, dan perawatan hewan peliharaan',
                'query' => 'Klinik Hewan',
            ],
            [
                'nama'  => 'Pet Shop & Grooming',
                'tag'   => 'Grooming',
                'desc'  => 'Perawatan bulu, mandi, dan potong kuku untuk hewan kesayangan',
                'query' => 'Pet Shop Grooming',
            ],
            [
                'nama'  => 'Toko Perlengkapan Hewan',
                'tag'   => 'Pet Store',
                'desc'  => 'Makanan, kandang, mainan, dan aksesoris hewan lengkap',
                'query' => 'Toko Perlengkapan Hewan',
            ],
            [
                'nama'  => 'Apotek Hewan',
                'tag'   => 'Apotek',
                'desc'  => 'Obat-obatan, vitamin, dan suplemen khusus hewan peliharaan',
                'query' => 'Apotek Hewan',
            ],
        ];
        $lokasi = ($city ?? '') . ' ' . ($province ?? '');
        @endphp

        @foreach($suggestions as $shop)
        <div class="bg-[#2a1d15] border-2 border-[#B8860B]/20 p-5 relative overflow-hidden group hover:border-[#B8860B]/60 transition">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 border-2 border-[#B8860B]/30 flex items-center justify-center flex-shrink-0 text-[#B8860B] font-black text-lg" style="background-color:#1a120b;">{{ substr($shop['tag'],0,2) }}</div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <h4 class="text-[#e2d1b3] text-sm font-black uppercase tracking-wider">{{ $shop['nama'] }}</h4>
                        <span class="text-[8px] font-black uppercase tracking-widest px-2 py-0.5 border border-[#B8860B]/40 text-[#B8860B]">{{ $shop['tag'] }}</span>
                    </div>
                    <p class="text-[#e2d1b3]/50 text-[10px] parchment-font italic mb-2">{{ $shop['desc'] }}</p>
                    <p class="text-[#e2d1b3]/30 text-[9px] uppercase tracking-widest">{{ trim($lokasi) }}</p>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                {{-- Lihat di Maps --}}
                <a href="https://www.google.com/maps/search/{{ urlencode($shop['query'].' '.$lokasi) }}"
                   target="_blank"
                   class="flex-1 text-center bg-[#B8860B] text-black px-3 py-2 text-[9px] font-black uppercase tracking-widest hover:bg-[#e2d1b3] transition shadow-[2px_2px_0px_#5c4033]">
                    Lihat di Maps
                </a>
                {{-- Hubungi — cari di Google supaya muncul nomor telepon tempat tersebut --}}
                <a href="https://www.google.com/search?q={{ urlencode('nomor telepon '.$shop['query'].' '.$lokasi) }}"
                   target="_blank"
                   class="px-3 py-2 text-[9px] font-black uppercase tracking-widest border-2 border-[#B8860B]/40 text-[#B8860B] hover:bg-[#B8860B]/10 transition"
                   title="Cari nomor telepon di Google">
                    Hubungi
                </a>
            </div>
        </div>
        @endforeach

        <a href="https://www.google.com/maps/search/{{ $mapQuery }}"
           target="_blank"
           class="block w-full text-center bg-[#1a120b] border-2 border-[#B8860B]/40 text-[#B8860B] px-6 py-4 text-[10px] font-black uppercase tracking-[0.3em] hover:bg-[#B8860B] hover:text-black transition shadow-[4px_4px_0px_rgba(0,0,0,0.5)]">
            Buka Semua Hasil di Google Maps
        </a>
    </div>

    <div class="space-y-4">
        <div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 p-4">
            <h3 class="text-[#B8860B] text-[9px] font-black uppercase tracking-[0.3em] mb-1">Peta Wilayah</h3>
            <p class="text-[#e2d1b3]/50 text-[8px] parchment-font italic">{{ $city ?? $province ?? 'Indonesia' }}</p>
        </div>
        <div class="border-4 border-[#B8860B]/30 overflow-hidden shadow-[8px_8px_0px_rgba(0,0,0,0.5)]" style="height:500px;">
            <iframe width="100%" height="100%" style="border:0;filter:sepia(0.3) contrast(1.1);" loading="lazy" allowfullscreen
                src="https://maps.google.com/maps?q={{ $mapQuery }}&output=embed&z=13"></iframe>
        </div>
        <div class="bg-[#2a1d15] border-2 border-[#B8860B]/20 p-5">
            <h4 class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest mb-3">Tips Memilih Petshop</h4>
            <ul class="space-y-2 text-[#e2d1b3]/60 text-[10px] parchment-font italic">
                <li>- Pastikan dokter hewan memiliki izin praktek resmi</li>
                <li>- Cek ulasan dan rating di Google Maps sebelum datang</li>
                <li>- Hubungi terlebih dahulu untuk konfirmasi jadwal</li>
                <li>- Bawa catatan riwayat kesehatan hewan peliharaan</li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-10 text-center">
    <p class="text-[#B8860B]/30 text-[8px] font-mono tracking-[0.8em] uppercase">Data Lokasi Disediakan oleh Google Maps — PawDoc v3.4.1</p>
</div>

</div>
</div>
</x-app-layout>
