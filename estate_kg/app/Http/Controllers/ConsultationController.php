<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Consultation::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        return response()->json(['success' => true, 'message' => 'Consultation request submitted successfully.']);
    }
}
