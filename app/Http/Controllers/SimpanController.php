<?php

namespace App\Http\Controllers;
use App\Models\Tampilan;

use Illuminate\Http\Request;

class SimpanController extends Controller
{
   // Controller
    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'nama'     => 'required',
            'umur'     => 'required',
            'hobi'     => 'required',
            'gender'   => 'required',
            'lagu1'    => 'required',
            'lagu2'    => 'required',
            'lagu3'    => 'required',
            'lagu4'    => 'required',
            'lagu5'    => 'required'
        ]);


        Tampilan::create([
            'nama'     => $request->nama,
            'umur'     => $request->umur,
            'hobi'     => $request->hobi,
            'gender'   => $request->gender,
            'lagu_1'   => $request->lagu1,
            'lagu_2'   => $request->lagu2,
            'lagu_3'   => $request->lagu3,
            'lagu_4'   => $request->lagu4,
            'lagu_5'   => $request->lagu5
        ]);



        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

}
