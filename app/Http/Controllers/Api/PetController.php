<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        // Narik data hewan sesuai user_id yang login via token
        $pets = Pet::where('user_id', auth()->id())->latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $pets
        ]);
    }
}