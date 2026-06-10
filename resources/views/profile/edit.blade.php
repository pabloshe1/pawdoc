<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.parchment-font{font-family:'Crimson Text',serif;}
.tech-font{font-family:'Chakra Petch',sans-serif;}
.bg-industrial{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
.si{background-color:#1a120b!important;border:2px solid rgba(184,134,11,0.3)!important;color:#e2d1b3!important;outline:none!important;width:100%;padding:12px 16px;font-size:.875rem;font-family:'Chakra Petch',sans-serif;}
.si:focus{border-color:#B8860B!important;}
.si::placeholder{color:rgba(226,209,179,0.3)!important;}
</style>
<div class="py-12 bg-industrial min-h-screen relative z-10 tech-font">
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
<div class="mb-10">
<h2 class="font-bold text-2xl text-[#B8860B] tracking-[0.3em] uppercase italic">Profil Pengguna</h2>
<p class="text-[#e2d1b3]/40 text-[9px] uppercase tracking-[0.5em] mt-1">Kelola informasi akun dan keamanan Anda</p>
</div>
@if(session('status')==='profile-updated')
<div class="mb-6 p-4 bg-[#5c4033]/20 border-l-4 border-[#B8860B] text-[#e2d1b3] font-bold italic">Data profil berhasil diperbarui.</div>
@endif
@if(session('status')==='password-updated')
<div class="mb-6 p-4 bg-[#5c4033]/20 border-l-4 border-[#B8860B] text-[#e2d1b3] font-bold italic">Kata sandi berhasil diperbarui.</div>
@endif
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-8 mb-6">
<h3 class="text-[#B8860B] text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Perbarui Data Diri</h3>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
@csrf
@method('patch')
<div class="flex items-start gap-6 pb-6 border-b border-[#B8860B]/20">
<div class="shrink-0 text-center">
<div class="w-28 h-28 border-4 border-[#B8860B]/40 overflow-hidden bg-[#1a120b] flex items-center justify-center">
@if(Auth::user()->photo)
<img id="photo-preview" src="{{ asset('storage/'.Auth::user()->photo) }}" class="w-full h-full object-cover" style="filter:sepia(0.3) contrast(1.1);">
@else
<img id="photo-preview" src="" class="w-full h-full object-cover hidden">
<span id="photo-placeholder" style="font-size:3rem;opacity:0.2;color:#B8860B;">?</span>
@endif
</div>
<p class="text-[#e2d1b3]/30 text-[8px] uppercase tracking-widest mt-2">Foto</p>
</div>
<div class="flex-1">
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Unggah Foto Profil</label>
<input type="file" name="photo" accept="image/*" onchange="previewPhoto(this)" class="w-full text-[10px] text-[#e2d1b3] file:bg-[#5c4033] file:border file:border-[#B8860B]/30 file:text-[#e2d1b3] file:px-4 file:py-2 file:text-[9px] file:font-black file:uppercase file:tracking-widest file:cursor-pointer cursor-pointer">
<p class="text-[#e2d1b3]/30 text-[8px] mt-1">Maks 2MB — JPG, PNG, WEBP</p>
@error('photo')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Nama Lengkap</label>
<input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="si" required>
@error('name')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Alamat Email</label>
<input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="si" required>
@error('email')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Kota Domisili</label>
<input type="text" name="city" value="{{ old('city', Auth::user()->city) }}" placeholder="contoh: Bandung, Jakarta..." class="si">
@error('city')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Tentang Saya (Bio)</label>
<textarea name="bio" rows="4" placeholder="Ceritakan sedikit tentang diri Anda..." class="si parchment-font italic resize-none" style="height:auto">{{ old('bio', Auth::user()->bio) }}</textarea>
<p class="text-[#e2d1b3]/30 text-[8px] mt-1 text-right">Maks 500 karakter</p>
@error('bio')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<button type="submit" class="bg-[#B8860B] text-black px-8 py-3 font-black text-[10px] tracking-widest uppercase hover:bg-[#e2d1b3] transition shadow-[4px_4px_0px_#5c4033] active:translate-y-1 active:shadow-none">Simpan Perubahan</button>
</form>
</div>
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-8 mb-6">
<h3 class="text-[#B8860B] text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Ubah Kata Sandi</h3>
<form method="POST" action="{{ route('password.update') }}" class="space-y-5">
@csrf
@method('put')
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Kata Sandi Saat Ini</label>
<input type="password" name="current_password" autocomplete="current-password" class="si">
@error('current_password','updatePassword')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Kata Sandi Baru</label>
<input type="password" name="password" autocomplete="new-password" class="si">
@error('password','updatePassword')<p class="text-red-400 text-[9px] mt-1">{{ $message }}</p>@enderror
</div>
<div>
<label class="text-[#B8860B] text-[9px] font-black uppercase tracking-widest block mb-2">Konfirmasi Kata Sandi Baru</label>
<input type="password" name="password_confirmation" autocomplete="new-password" class="si">
</div>
<button type="submit" class="bg-[#3d2b1f] text-[#e2d1b3] px-8 py-3 font-black text-[10px] tracking-widest uppercase hover:bg-[#5c4033] transition shadow-[4px_4px_0px_rgba(0,0,0,0.5)]">Simpan Kata Sandi</button>
</form>
</div>
<div class="bg-[#2a1d15] border-2 border-red-900/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-8">
<h3 class="text-red-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2 italic">Hapus Akun</h3>
<p class="text-[#e2d1b3]/40 text-[9px] parchment-font italic mb-6">Setelah dihapus, semua data Anda akan hilang secara permanen dan tidak bisa dipulihkan.</p>
<button onclick="document.getElementById('dm').style.display='flex'" class="bg-red-900 text-red-200 px-8 py-3 font-black text-[10px] tracking-widest uppercase hover:bg-red-700 transition shadow-[4px_4px_0px_rgba(0,0,0,0.5)]">Hapus Akun Saya</button>
</div>
</div>
</div>
<div id="dm" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);z-index:50;align-items:center;justify-content:center;">
<div class="bg-[#2a1d15] border-2 border-red-900/60 shadow-[8px_8px_0px_rgba(0,0,0,0.8)] p-8 max-w-md w-full mx-4 tech-font">
<h3 class="text-red-400 text-[10px] font-black uppercase tracking-widest mb-4">Konfirmasi Penghapusan Akun</h3>
<p class="text-[#e2d1b3]/60 text-sm parchment-font italic mb-6">Masukkan kata sandi untuk konfirmasi penghapusan akun.</p>
<form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
@csrf
@method('delete')
<input type="password" name="password" placeholder="Masukkan kata sandi Anda..." class="si">
@error('password','userDeletion')<p class="text-red-400 text-[9px]">{{ $message }}</p>@enderror
<div class="flex gap-4 mt-4">
<button type="submit" class="bg-red-900 text-red-200 px-6 py-2 font-black text-[9px] tracking-widest uppercase hover:bg-red-700 transition">Ya, Hapus Akun</button>
<button type="button" onclick="document.getElementById('dm').style.display='none'" class="bg-[#3d2b1f] text-[#e2d1b3] px-6 py-2 font-black text-[9px] tracking-widest uppercase hover:bg-[#5c4033] transition">Batal</button>
</div>
</form>
</div>
</div>
<script>
function previewPhoto(input){
const p=document.getElementById('photo-preview');
const ph=document.getElementById('photo-placeholder');
if(input.files&&input.files[0]){
const r=new FileReader();
r.onload=e=>{p.src=e.target.result;p.style.display='block';p.classList.remove('hidden');if(ph)ph.style.display='none';};
r.readAsDataURL(input.files[0]);
}}
</script>
</x-app-layout>
