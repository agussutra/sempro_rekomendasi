<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    public function submit(Request $request)
    {
        // Validasi form
        $request->validate([
            'nama' => 'required',
            'umur' => 'required|integer',
            'hobi' => 'required',
            'gender' => 'required',
            'lagu' => 'required|array|min:1|max:5',
            'lagu.*' => 'string'
        ]);
        // Proses penyimpanan data lainnya
        // ...

        return redirect('/form')->with('success', 'Data berhasil disimpan!');
    }
}
