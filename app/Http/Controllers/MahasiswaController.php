<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\pkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table("users")
            ->join("mahasiswa", "users.id", "=", "mahasiswa.nim")
            ->select("users.*", "mahasiswa.*")
            ->where("users.id", "=", auth()->user()->id)
            ->first();
        $id = auth()->user()->id;
        return view("profil-detail.profil-mahasiswa", compact("data", "id"));
    }

    public function inputfirst(Request $request, $id)
    {
        $validatedata = $request->validate([
            'nim' => 'numeric',
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'kota' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'jalur_masuk' => 'required',
            'no_handphone' => 'required|numeric|digits_between:10,13',
            'foto' => 'file|mimes:jpeg,png,jpg,gif',
            'status' => 'required',
        ]);
        $id = auth()->user()->id;
        $validatedata['status'] = 'Aktif';
        $validatedata['nim'] = $id;
        // $validatedata['status'] = 'Aktif';

        if ($request->file('foto')) {
            $validatedata['foto'] = $request->file('foto')->store('images');
        }

        Mahasiswa::create($validatedata);
        User::where('id', $id)->update(['role' => 'mahasiswa']);
        return redirect('/dashboard/mahasiswa');
    }
    public function update()
    {
    }
    public function show_IRS()
    {
        return view('IRS');
    }
    public function show_KHS()
    {
        return view('KHS');
    }
    public function show_PKL()
    {
        // $pkl = PKL::where('nim', auth()->id())->first(); // Gantilah 'user_id' dengan nama kolom yang sesuai dengan hubungan antara User dan PKL

        // if (!$pkl) {
        //     //return redirect()->route('page_access_error')->with('error', 'Data PKL tidak ditemukan.');
        // }

        // $status = $pkl->status;

        // if ($status === 'Belum Ambil' || $status === 'Sedang Ambil') {
        //     $nilai = null;
        // } elseif ($status === 'Lulus') {
        //     $nilai = $pkl->nilai;
        // } else {
        //     //return redirect()->route('page_access_error')->with('error', 'Status tidak valid.');
        // }

        return view('PKL');
    }
    public function show_skripsi()
    {
        return view('skripsi');
    }
}
