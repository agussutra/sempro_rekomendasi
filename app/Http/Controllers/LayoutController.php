<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        return View('layout.main');
    }

    public function dashboard()
    {
        return View('layout.dashboard');
    }

    public function dataproduksi()
    {
        return View('layout.dataproduksi');
    }

    public function monitor()
    {
        return View('layout.monitor');
    }

    public function setup()
    {
        return View('layout.setup');
    }

    public function baru()
    {
        return View('layout.baru');
    }
}
