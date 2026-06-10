<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
    return redirect()->route('pets.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/admin/user/{id}/pets', [AdminController::class, 'showUserPets'])->name('admin.user.pets');
    Route::patch('/admin/reports/{id}', [AdminController::class, 'updateReport'])->name('admin.reports.update');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/my-menagerie', [PetController::class, 'index'])->name('pets.index');
    Route::post('/my-menagerie', [PetController::class, 'store'])->name('pets.store');
    Route::post('/report-sickness', [PetController::class, 'reportSickness'])->name('pets.report');
    Route::get('/clinics/{city?}', [PetController::class, 'findClinics'])->name('clinics.search');
    Route::get('/report/download/{id}', [PetController::class, 'downloadReport'])->name('pets.report.download');
});

require __DIR__.'/auth.php';

Route::get('/statistics', [App\Http\Controllers\StatisticsController::class, 'index'])->middleware('auth')->name('statistics.index');

Route::post('/aria/chat', function (\Illuminate\Http\Request $request) {
    $messages = $request->input('messages', []);
    $system = "Kamu adalah ARIA asisten virtual PawDoc. Gunakan bahasa Indonesia santai. Jawaban ringkas 3-4 kalimat. Bantu soal gejala hewan, vaksinasi, perawatan. Kondisi serius sarankan ke dokter hewan.";
    $groqMessages = array_merge([['role' => 'system', 'content' => $system]], $messages);
    $response = \Illuminate\Support\Facades\Http::withHeaders(['Authorization' => 'Bearer ' . env('GROQ_API_KEY'), 'Content-Type' => 'application/json'])->post('https://api.groq.com/openai/v1/chat/completions', ['model' => 'llama-3.3-70b-versatile', 'messages' => $groqMessages, 'max_tokens' => 500]);
    $data = $response->json();
    $text = $data['choices'][0]['message']['content'] ?? 'Maaf, tidak bisa menjawab sekarang.';
    return response()->json(['content' => [['text' => $text]]]);
})->middleware('web')->name('aria.chat');
