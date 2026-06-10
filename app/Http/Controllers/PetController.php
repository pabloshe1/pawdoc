<?php
namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::where('user_id', auth()->id())->latest()->get();
        $medicalMessages = Report::with('pet')
                            ->where('user_id', auth()->id())
                            ->where('status', 'REVIEWED')
                            ->latest()->get();
        return view('pets.index', compact('pets', 'medicalMessages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'photo' => 'nullable|image|max:2048'
        ]);
        $path = $request->file('photo') ? $request->file('photo')->store('pet_photos', 'public') : null;
        Pet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'photo' => $path,
        ]);
        return redirect()->back()->with('success', 'Hewan berhasil didaftarkan!');
    }

    public function findClinics(Request $request)
    {
        $province = $request->input('province');
        $city = $request->input('city');
        $query = "petshop klinik hewan " . ($city ?? $province ?? 'terdekat');
        $mapQuery = urlencode("petshop klinik hewan " . ($city ? "$city, $province" : $province));
        return view('pets.clinics', compact('query', 'mapQuery', 'province', 'city'));
    }

    public function reportSickness(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'symptoms' => 'required|string|min:5',
        ]);
        Report::create([
            'user_id' => auth()->id(),
            'pet_id' => $request->pet_id,
            'symptoms' => $request->symptoms,
            'status' => 'PENDING'
        ]);
        return redirect()->back()->with('success', 'Laporan keluhan berhasil dikirim ke dokter!');
    }

    public function downloadReport($id)
    {
        $report = \App\Models\Report::with(['pet', 'user'])->findOrFail($id);
        $data = [
            'title' => 'Surat Keterangan Medis - PawDoc',
            'date' => date('d/m/Y'),
            'report' => $report
        ];
        $pdf = Pdf::loadView('reports.medical-scroll', $data);
        return $pdf->stream('Laporan-Medis-'.$report->pet->name.'.pdf');
    }
}
