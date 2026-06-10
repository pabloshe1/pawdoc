<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.parchment-font{font-family:'Crimson Text',serif;}
.tech-font{font-family:'Chakra Petch',sans-serif;}
.bg-industrial{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
@keyframes bounce-slow{0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);}}
.animate-bounce-slow{animation:bounce-slow 3s ease-in-out infinite;}
</style>

<div class="py-10 bg-industrial min-h-screen relative parchment-font" style="color:#e2d1b3;">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="mb-10 text-center">
<h2 class="tech-font text-3xl font-bold text-[#B8860B] uppercase tracking-[0.3em] italic drop-shadow-md">Arsip Hewan Peliharaan</h2>
<p style="color:rgba(226,209,179,0.5);font-size:10px;margin-top:4px;text-transform:uppercase;letter-spacing:0.5em;">Koleksi Hewan Peliharaan Anda</p>
</div>

<div class="mb-8 bg-[#2a1d15] border-2 border-[#B8860B]/40 p-6 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] relative overflow-hidden">
<div class="tech-font mb-4">
<h3 class="text-[#B8860B] text-xs font-black uppercase tracking-[0.3em]">Temukan Petshop &amp; Klinik Terdekat</h3>
<p class="parchment-font italic text-[#e2d1b3]/60 text-sm mt-2">Temukan petshop dan klinik hewan terpercaya di sekitar wilayah Anda.</p>
</div>
<form action="{{ route('clinics.search') }}" method="GET" target="_blank" class="grid grid-cols-1 md:grid-cols-3 gap-3">
<select id="provinsi" name="province" onchange="updateKabupaten()" required
style="background-color:#1a120b;border:2px solid rgba(184,134,11,0.4);color:#B8860B;font-size:12px;font-weight:900;text-transform:uppercase;padding:10px;outline:none;cursor:pointer;font-family:'Chakra Petch',sans-serif;">
<option value="" disabled selected>-- Pilih Provinsi --</option>
<option value="Jawa Barat">Jawa Barat</option>
<option value="DKI Jakarta">DKI Jakarta</option>
<option value="Jawa Tengah">Jawa Tengah</option>
<option value="Jawa Timur">Jawa Timur</option>
<option value="Banten">Banten</option>
<option value="Sumatera Utara">Sumatera Utara</option>
<option value="Sulawesi Selatan">Sulawesi Selatan</option>
<option value="Bali">Bali</option>
</select>
<select id="kabupaten" name="city" required
style="background-color:#1a120b;border:2px solid rgba(184,134,11,0.4);color:#B8860B;font-size:12px;font-weight:900;text-transform:uppercase;padding:10px;outline:none;cursor:pointer;font-family:'Chakra Petch',sans-serif;">
<option value="" disabled selected>-- Pilih Kabupaten/Kota --</option>
</select>
<button type="submit"
style="background-color:#B8860B;color:#000;padding:10px 24px;font-weight:900;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;font-family:'Chakra Petch',sans-serif;border:none;cursor:pointer;box-shadow:4px 4px 0px #5c4033;">
Cari Sekarang
</button>
</form>
</div>

@if(isset($medicalMessages) && $medicalMessages->count() > 0)
<div class="mb-8 animate-bounce-slow">
<h3 class="tech-font text-[#B8860B] text-xs font-black uppercase tracking-[0.3em] mb-4">HASIL DIAGNOSA DARI DOKTER HEWAN</h3>
@foreach($medicalMessages as $msg)
<div class="border-l-4 border-[#B8860B] p-5 shadow-[4px_4px_0px_rgba(0,0,0,0.5)] mb-4 relative overflow-hidden" style="background-color:#2d1f0e;color:#e2d1b3;">
<div class="flex justify-between items-start border-b pb-3 mb-3" style="border-color:rgba(92,64,51,0.3);">
<h4 class="font-bold uppercase text-sm italic">Pasien: {{ $msg->pet->name }}</h4>
<span class="text-xs font-mono" style="opacity:0.5;">{{ $msg->updated_at->format('d M Y') }}</span>
</div>
<div class="mb-3">
<p class="text-xs uppercase font-black mb-1" style="opacity:0.6;">Diagnosa Dokter:</p>
<p class="text-lg italic leading-tight mb-3">"{{ $msg->diagnosis }}"</p>
<div class="p-3 border-b-2 border-[#B8860B]" style="background-color:rgba(45,31,14,0.8);">
<p class="text-xs uppercase font-black mb-1 tracking-widest" style="color:#B8860B;">Obat yang Diresepkan:</p>
<p class="text-sm font-bold tracking-widest uppercase">{{ $msg->medicine ?? 'REST & OBSERVATION' }}</p>
</div>
</div>
<div class="mt-3 flex justify-end">
<a href="{{ route('pets.report.download', $msg->id) }}"
style="background-color:#B8860B;color:#000;padding:8px 20px;font-weight:900;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;font-family:'Chakra Petch',sans-serif;text-decoration:none;display:inline-block;box-shadow:3px 3px 0px #5c4033;">
Unduh Surat Keterangan (PDF)
</a>
</div>
</div>
@endforeach
</div>
@endif

<div class="mb-8 bg-[#2a1d15] border-2 border-[#B8860B]/40 p-6 shadow-[8px_8px_0px_rgba(0,0,0,0.5)]">
<h3 class="tech-font text-[#B8860B] text-xs font-bold mb-4 uppercase tracking-widest italic">Daftarkan Hewan Baru</h3>
<form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3">
@csrf
<input type="text" name="name" placeholder="Nama Hewan" required
style="background-color:#1a120b;border:2px solid rgba(184,134,11,0.3);color:#e2d1b3;padding:10px 14px;font-size:13px;outline:none;font-family:'Chakra Petch',sans-serif;">
<input type="text" name="type" placeholder="Jenis (Contoh: Kucing)" required
style="background-color:#1a120b;border:2px solid rgba(184,134,11,0.3);color:#e2d1b3;padding:10px 14px;font-size:13px;outline:none;font-family:'Chakra Petch',sans-serif;">
<input type="file" name="photo" accept="image/*"
style="font-size:11px;color:#e2d1b3;align-self:center;cursor:pointer;">
<button type="submit"
style="background-color:#B8860B;color:#000;padding:10px 24px;font-weight:900;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;font-family:'Chakra Petch',sans-serif;border:none;cursor:pointer;box-shadow:4px 4px 0px #5c4033;">
Tambah ke Arsip
</button>
</form>
@if(session('success'))
<p class="tech-font text-[#B8860B] text-xs mt-3 font-bold">{{ session('success') }}</p>
@endif
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@forelse($pets as $pet)
<div class="relative group">
<div class="border-2 border-[#5c4033] p-5 shadow-[6px_6px_0px_rgba(0,0,0,0.6)] group-hover:-rotate-1 transition duration-300" style="background-color:#2d1f0e;color:#e2d1b3;">
<div class="border-2 border-[#e2d1b3]/20 mb-4 overflow-hidden aspect-square shadow-inner relative" style="background-color:#1a0d06;">
@if($pet->photo)
<img src="{{ asset('storage/' . $pet->photo) }}" class="w-full h-full object-cover" style="filter:sepia(0.5) contrast(1.1) brightness(0.9);">
@else
<div class="flex items-center justify-center h-full text-4xl" style="opacity:0.2;color:#B8860B;">?</div>
@endif
</div>
<div>
<h4 class="parchment-font text-xl font-bold italic border-b-2 pb-2 tracking-tighter" style="border-color:rgba(92,64,51,0.3);">{{ $pet->name }}</h4>
<div class="flex justify-between mt-2 tech-font" style="font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;opacity:0.6;">
<span>Jenis: {{ $pet->type }}</span>
<span>Ref: PAW-{{ $pet->id }}</span>
</div>
</div>
<div class="mt-4 pt-4 border-t-2" style="border-color:rgba(92,64,51,0.3);">
<p class="tech-font text-xs font-black uppercase tracking-widest mb-3" style="color:#B8860B;">Kirim Laporan Keluhan</p>
<form action="{{ route('pets.report') }}" method="POST" class="space-y-2">
@csrf
<input type="hidden" name="pet_id" value="{{ $pet->id }}">
<textarea name="symptoms" rows="3" placeholder="Deskripsikan gejala hewan Anda..."
style="width:100%;background-color:rgba(26,13,6,0.6);border:2px solid rgba(92,64,51,0.5);padding:8px;font-size:12px;font-family:'Crimson Text',serif;font-style:italic;resize:none;outline:none;color:#e2d1b3;" required></textarea>
<button type="submit"
style="width:100%;background-color:#3d2b1f;color:#e2d1b3;font-size:10px;font-weight:900;padding:8px;text-transform:uppercase;font-family:'Chakra Petch',sans-serif;border:none;cursor:pointer;letter-spacing:0.1em;">
Kirim ke Dokter
</button>
</form>
</div>
</div>
</div>
@empty
<div class="col-span-3 text-center py-16 border-2 border-dashed tech-font" style="border-color:rgba(184,134,11,0.3);color:rgba(226,209,179,0.4);">
Belum ada hewan yang didaftarkan.
</div>
@endforelse
</div>

</div>
</div>

<script>
const dataWilayah = {
"Jawa Barat": ["Subang","Bandung","Bekasi","Bogor","Depok","Sukabumi","Cirebon","Garut","Karawang","Purwakarta"],
"DKI Jakarta": ["Jakarta Selatan","Jakarta Pusat","Jakarta Timur","Jakarta Utara","Jakarta Barat"],
"Jawa Tengah": ["Semarang","Solo","Magelang","Tegal","Purwokerto","Kudus","Pekalongan"],
"Jawa Timur": ["Surabaya","Malang","Sidoarjo","Gresik","Banyuwangi","Madiun","Kediri"],
"Banten": ["Tangerang","Serang","Cilegon","Pandeglang","Lebak"],
"Sumatera Utara": ["Medan","Deli Serdang","Binjai","Tebing Tinggi","Pematangsiantar"],
"Sulawesi Selatan": ["Makassar","Gowa","Maros","Bone","Palopo"],
"Bali": ["Denpasar","Badung","Gianyar","Tabanan","Buleleng"]
};
function updateKabupaten(){
const provinsi=document.getElementById("provinsi").value;
const sel=document.getElementById("kabupaten");
sel.innerHTML='<option value="" disabled selected>-- Pilih Kabupaten/Kota --</option>';
if(dataWilayah[provinsi]){
dataWilayah[provinsi].forEach(kota=>{
const opt=document.createElement("option");
opt.value=kota;opt.innerHTML=kota;
sel.appendChild(opt);
});
}
}
</script>
</x-app-layout>
