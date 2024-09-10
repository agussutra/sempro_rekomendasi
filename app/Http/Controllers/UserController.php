<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inputer;
use App\Models\Hobi;
use App\Models\DetailHobi;
use App\Models\Track;
class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'umur' => 'required',
            'gender' => 'required|in:laki-laki,perempuan',
            'hobi' => 'required|array',
            'dataSong' => 'required|array',
        ]);

        // Simpan inputan single
        // table inputer
        $datainputer = Inputer::create([
            'umur' => $validatedData['umur'],
            'gender' => $validatedData['gender'],
        ]);

        // Simpan inputan hobby multiple (lebih dari 1)
        // buatkan table dengan field ['id_hobby', 'id_inputer', 'nama_hobby']
        // table hobby
        foreach ($validatedData['hobi'] as $item) {
            DetailHobi::create([
                'id_hobi' => $item['hobi'],
                'id_inputer' => $datainputer->id
            ]);
        }

        // Simpan inputan song multiple (lebih dari 1)
        // setting user sesuai yang login, untuk saat ini masih hardcode dan hapus field id_track di db
        // table track
        foreach ($validatedData['dataSong'] as $item) {
           Track::create([
               'artist' => $item['artist'],
            //    'id_user' => 1,
               'judul' => $item['song'],
               'id_inputer'=>$datainputer->id,
               'valence' => $item['valence'],
               'energy' => $item['energy'],
           ]);
        }


        return response()->json(['message' => 'Data validated successfully', 'data' => $validatedData]);
    }

    public function index()
    {
        // $users = User::all();
        // return view('users.index', compact('users'));
    }
}
