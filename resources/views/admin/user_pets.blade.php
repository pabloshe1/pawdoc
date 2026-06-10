<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.parchment-font{font-family:'Crimson Text',serif;}
.tech-font{font-family:'Chakra Petch',sans-serif;}
.bg-industrial{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
</style>
<div class="py-12 bg-industrial min-h-screen relative z-10 parchment-font" style="color:#e2d1b3;">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="mb-10 flex justify-between items-center pb-5" style="border-bottom:2px solid rgba(184,134,11,0.3);">
<div>
<h2 class="tech-font text-3xl font-bold italic uppercase tracking-widest" style="color:#B8860B;">Arsip Hewan Milik: {{ $user->name }}</h2>
<p class="tech-font mt-2" style="color:rgba(226,209,179,0.5);font-size:10px;text-transform:uppercase;letter-spacing:0.5em;">Data Hewan Peliharaan Pengguna</p>
</div>
<a href="{{ route('admin.dashboard') }}"
style="color:#B8860B;font-size:12px;border:2px solid #B8860B;padding:8px 24px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;font-family:'Chakra Petch',sans-serif;"
onmouseover="this.style.backgroundColor='#B8860B';this.style.color='#1a120b';"
onmouseout="this.style.backgroundColor='';this.style.color='#B8860B';">
Kembali ke Dasbor
</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
@forelse($pets as $pet)
<div class="relative group">
<div style="background-color:#2d1f0e;border:2px solid #5c4033;padding:20px;box-shadow:6px 6px 0px rgba(0,0,0,0.6);">
<div style="border:2px solid rgba(226,209,179,0.2);margin-bottom:16px;overflow:hidden;aspect-ratio:1;background-color:#1a0d06;position:relative;">
@if($pet->photo)
<img src="{{ asset('storage/' . $pet->photo) }}" style="width:100%;height:100%;object-fit:cover;filter:sepia(0.5) contrast(1.1);">
@else
<div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:3rem;opacity:0.2;color:#B8860B;">?</div>
@endif
</div>
<div style="color:#e2d1b3;">
<h4 class="parchment-font" style="font-size:1.25rem;font-weight:700;font-style:italic;border-bottom:2px solid rgba(92,64,51,0.3);padding-bottom:8px;">{{ $pet->name }}</h4>
<div class="tech-font" style="display:flex;justify-content:space-between;margin-top:8px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;opacity:0.6;">
<span>Jenis: {{ $pet->type }}</span>
<span>PAW-{{ $pet->id }}</span>
</div>
</div>
</div>
</div>
@empty
<div class="col-span-3 text-center py-16" style="border:2px dashed rgba(184,134,11,0.3);">
<p class="parchment-font italic" style="color:rgba(226,209,179,0.4);letter-spacing:0.1em;font-size:0.875rem;">Pengguna ini belum mendaftarkan hewan peliharaan.</p>
</div>
@endforelse
</div>

</div>
</div>
</x-app-layout>
