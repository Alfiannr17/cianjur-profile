<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan ke Database
        Complaint::create($request->all());

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Pesan atau pengaduan Anda telah kami terima.');
    }
}