<style>
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.tech-font{font-family:'Chakra Petch',sans-serif;}
</style>
<nav x-data="{ open: false }" class="tech-font" style="background-color:#1a120b;border-bottom:2px solid rgba(184,134,11,0.3);box-shadow:0 4px 20px rgba(0,0,0,0.8);">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between h-16">
<div class="flex items-center">
<div class="shrink-0 flex items-center me-8">
<a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('pets.index') }}" style="color:#B8860B;font-weight:900;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.3em;font-style:italic;">
PAWDOC
</a>
</div>
<div class="hidden sm:flex sm:items-center sm:gap-1">
@if(Auth::user()->role === 'admin')
<a href="{{ route('admin.dashboard') }}" style="padding:8px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;border-bottom:2px solid {{ request()->routeIs('admin.dashboard') ? '#B8860B' : 'transparent' }};color:{{ request()->routeIs('admin.dashboard') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">
Terminal Admin
</a>
<a href="{{ route('statistics.index') }}" style="padding:8px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;border-bottom:2px solid {{ request()->routeIs('statistics.index') ? '#B8860B' : 'transparent' }};color:{{ request()->routeIs('statistics.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">
Statistik
</a>
@else
<a href="{{ route('pets.index') }}" style="padding:8px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;border-bottom:2px solid {{ request()->routeIs('pets.index') ? '#B8860B' : 'transparent' }};color:{{ request()->routeIs('pets.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">
Hewan Saya
</a>
<a href="{{ route('statistics.index') }}" style="padding:8px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;border-bottom:2px solid {{ request()->routeIs('statistics.index') ? '#B8860B' : 'transparent' }};color:{{ request()->routeIs('statistics.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">
Statistik
</a>
@endif
</div>
</div>
<div class="hidden sm:flex sm:items-center sm:ms-6">
<x-dropdown align="right" width="48">
<x-slot name="trigger">
<button style="display:inline-flex;align-items:center;gap:12px;padding:8px 12px;border:2px solid rgba(184,134,11,0.3);font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:#e2d1b3;background-color:#2a1d15;">
<div style="width:28px;height:28px;border:2px solid rgba(184,134,11,0.5);overflow:hidden;display:flex;align-items:center;justify-content:center;background-color:#1a120b;flex-shrink:0;">
@if(Auth::user()->photo)
<img src="{{ asset('storage/'.Auth::user()->photo) }}" style="width:100%;height:100%;object-fit:cover;filter:sepia(0.5) contrast(1.2);">
@else
<span style="font-size:12px;opacity:0.4;">?</span>
@endif
</div>
<span>{{ Auth::user()->name }}</span>
<svg style="fill:currentColor;height:12px;width:12px;color:#B8860B;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg>
</button>
</x-slot>
<x-slot name="content">
<div style="background-color:#1a120b;border:2px solid rgba(184,134,11,0.4);box-shadow:8px 8px 0px rgba(0,0,0,0.8);">
<div style="padding:12px 16px;border-bottom:1px solid rgba(184,134,11,0.2);">
<div style="display:flex;align-items:center;gap:12px;">
<div style="width:40px;height:40px;border:2px solid rgba(184,134,11,0.5);overflow:hidden;display:flex;align-items:center;justify-content:center;background-color:#1a120b;flex-shrink:0;">
@if(Auth::user()->photo)
<img src="{{ asset('storage/'.Auth::user()->photo) }}" style="width:100%;height:100%;object-fit:cover;filter:sepia(0.5) contrast(1.2);">
@else
<span style="opacity:0.3;font-size:18px;">?</span>
@endif
</div>
<div>
<div style="font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:#B8860B;">{{ Auth::user()->name }}</div>
<div style="font-size:8px;font-family:monospace;color:rgba(226,209,179,0.4);">{{ Auth::user()->email }}</div>
<div style="font-size:8px;text-transform:uppercase;letter-spacing:0.1em;margin-top:2px;color:rgba(184,134,11,0.5);">
{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}
</div>
</div>
</div>
</div>
<a href="{{ route('profile.edit') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:rgba(226,209,179,0.7);" onmouseover="this.style.backgroundColor='#2a1d15';this.style.color='#B8860B';" onmouseout="this.style.backgroundColor='';this.style.color='rgba(226,209,179,0.7)';">
Profil Saya
</a>
<div style="border-top:1px solid rgba(184,134,11,0.2);"></div>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" style="width:100%;text-align:left;display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:rgba(239,68,68,0.7);background:none;border:none;cursor:pointer;" onmouseover="this.style.backgroundColor='#2a1d15';this.style.color='rgb(239,68,68)';" onmouseout="this.style.backgroundColor='';this.style.color='rgba(239,68,68,0.7)';">
Keluar
</button>
</form>
</div>
</x-slot>
</x-dropdown>
</div>
<div class="-me-2 flex items-center sm:hidden">
<button @click="open = ! open" style="display:inline-flex;align-items:center;justify-content:center;padding:8px;color:#B8860B;background:none;border:none;cursor:pointer;">
<svg style="height:24px;width:24px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>
</button>
</div>
</div>
</div>
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color:#1a120b;border-top:1px solid rgba(184,134,11,0.2);">
<div style="padding:8px 0;">
@if(Auth::user()->role === 'admin')
<a href="{{ route('admin.dashboard') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:{{ request()->routeIs('admin.dashboard') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">Terminal Admin</a>
<a href="{{ route('statistics.index') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:{{ request()->routeIs('statistics.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">Statistik</a>
@else
<a href="{{ route('pets.index') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:{{ request()->routeIs('pets.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">Hewan Saya</a>
<a href="{{ route('statistics.index') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:{{ request()->routeIs('statistics.index') ? '#B8860B' : 'rgba(226,209,179,0.6)' }};">Statistik</a>
@endif
</div>
<div style="padding:16px 0 4px;border-top:1px solid rgba(184,134,11,0.2);">
<div style="padding:0 16px 12px;display:flex;align-items:center;gap:12px;">
<div style="width:40px;height:40px;border:2px solid rgba(184,134,11,0.5);overflow:hidden;flex-shrink:0;background-color:#1a120b;display:flex;align-items:center;justify-content:center;">
@if(Auth::user()->photo)
<img src="{{ asset('storage/'.Auth::user()->photo) }}" style="width:100%;height:100%;object-fit:cover;">
@else
<span style="opacity:0.3;">?</span>
@endif
</div>
<div>
<div style="font-size:10px;font-weight:900;text-transform:uppercase;color:#B8860B;">{{ Auth::user()->name }}</div>
<div style="font-size:9px;font-family:monospace;color:rgba(226,209,179,0.4);">{{ Auth::user()->email }}</div>
</div>
</div>
<a href="{{ route('profile.edit') }}" style="display:block;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;color:rgba(226,209,179,0.6);">Profil Saya</a>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" style="width:100%;text-align:left;padding:12px 16px;font-size:10px;font-weight:900;text-transform:uppercase;color:rgba(239,68,68,0.6);background:none;border:none;cursor:pointer;">Keluar</button>
</form>
</div>
</div>
</nav>
