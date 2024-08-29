<?php

namespace App\Http\Controllers;
use App\Models\Tampilan;
use Illuminate\View\View;

use Illuminate\Http\Request;

class TampilanController extends Controller
{
    public function index()
    {
        // Mengambil data dari model Tampilan
        $tampilan = Tampilan::all();

        // Melewatkan data ke tampilan Blade
        return view('/tampilandata', compact('tampilan'));
    }
}
