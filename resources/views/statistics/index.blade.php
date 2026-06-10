<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap');
.parchment-font{font-family:'Crimson Text',serif;}
.tech-font{font-family:'Chakra Petch',sans-serif;}
.bg-industrial{background-color:#1a120b;background-image:url("https://www.transparenttextures.com/patterns/dark-leather.png");}
</style>
<div class="py-10 bg-industrial min-h-screen relative z-10 tech-font">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="mb-10 flex items-center justify-between">
<div>
<h2 class="font-bold text-2xl text-[#B8860B] tracking-[0.3em] uppercase italic">Dasbor Analitik Klinik</h2>
<p style="color:rgba(226,209,179,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.5em;margin-top:4px;">Pantauan Data Klinik Hewan Real-time</p>
</div>
<span style="font-size:10px;font-family:monospace;color:#B8860B;letter-spacing:0.1em;" class="animate-pulse">STEAM PRESSURE: OPTIMAL</span>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6 relative overflow-hidden">
<div style="color:#B8860B;text-transform:uppercase;font-size:10px;font-weight:900;letter-spacing:0.1em;">Total Hewan</div>
<div style="font-size:2.5rem;font-weight:700;color:#e2d1b3;margin-top:8px;font-style:italic;">{{ $summary['total_pets'] }}</div>
</div>
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6">
<div style="color:#B8860B;text-transform:uppercase;font-size:10px;font-weight:900;letter-spacing:0.1em;">Daftar Bulan Ini</div>
<div style="font-size:2.5rem;font-weight:700;color:#e2d1b3;margin-top:8px;font-style:italic;">{{ $summary['this_month'] }}</div>
</div>
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6">
<div style="color:#B8860B;text-transform:uppercase;font-size:10px;font-weight:900;letter-spacing:0.1em;">Total Laporan</div>
<div style="font-size:2.5rem;font-weight:700;color:#e2d1b3;margin-top:8px;font-style:italic;">{{ $summary['total_reports'] }}</div>
</div>
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6">
<div style="color:#B8860B;text-transform:uppercase;font-size:10px;font-weight:900;letter-spacing:0.1em;">Laporan Selesai</div>
<div style="font-size:2.5rem;font-weight:700;color:#e2d1b3;margin-top:8px;font-style:italic;">{{ $summary['done_reports'] }}</div>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6">
<h3 style="color:#B8860B;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;margin-bottom:16px;font-style:italic;">Pendaftaran Hewan per Bulan</h3>
<canvas id="chartMonthly" height="200"></canvas>
</div>
<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6">
<h3 style="color:#B8860B;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;margin-bottom:16px;font-style:italic;">Jenis Hewan Terbanyak</h3>
<canvas id="chartAnimals" height="200"></canvas>
</div>
</div>

<div class="bg-[#2a1d15] border-2 border-[#B8860B]/40 shadow-[8px_8px_0px_rgba(0,0,0,0.5)] p-6 mb-6">
<h3 style="color:#B8860B;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;margin-bottom:16px;font-style:italic;">5 Diagnosa Terbanyak</h3>
@if($topDiagnoses->isEmpty())
<p class="parchment-font italic text-sm text-center py-8" style="color:rgba(226,209,179,0.4);">Belum ada data diagnosis tersedia.</p>
@else
<canvas id="chartDiagnoses" height="120"></canvas>
@endif
</div>

<div class="text-center">
<p style="color:rgba(184,134,11,0.3);font-size:8px;font-family:monospace;letter-spacing:0.8em;text-transform:uppercase;">PawDoc Analytics v3.4.1</p>
</div>

</div>
</div>

<script>
const monthLabels  = @json($monthLabels);
const monthData    = @json($monthData);
const animalLabels = @json($animalTypes->pluck('type'));
const animalData   = @json($animalTypes->pluck('total'));
const diagLabels   = @json($topDiagnoses->pluck('diagnosis'));
const diagData     = @json($topDiagnoses->pluck('total'));
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/statistics.js') }}"></script>
</x-app-layout>
