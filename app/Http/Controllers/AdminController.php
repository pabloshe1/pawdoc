<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $allUsers = User::where('role', 'user')->get();
        $totalUser = User::where('role', 'user')->count();

        $pendingReports = \App\Models\Report::with(['user', 'pet'])
                            ->where('status', 'PENDING')
                            ->latest()
                            ->get();

        $pendingCount = $pendingReports->count();

        // Tambahkan laporan aktif (sudah direspons admin)
        $activeReports = \App\Models\Report::where('status', 'REVIEWED')->count();

        return view('admin.dashboard', compact('allUsers', 'totalUser', 'pendingReports', 'pendingCount', 'activeReports'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted');
    }

    public function showUserPets($id)
    {
        $user = User::findOrFail($id);
        $pets = \App\Models\Pet::where('user_id', $id)->get();
        return view('admin.user_pets', compact('user', 'pets'));
    }

    public function updateReport(Request $request, $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->update([
            'diagnosis' => $request->diagnosis,
            'medicine' => $request->medicine,
            'status' => 'REVIEWED'
        ]);
        return redirect()->back()->with('success', 'Report updated');
    }
}
