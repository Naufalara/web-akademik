<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Khs;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\pkl;
use App\Models\skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit_profil()
    {
        $data = DB::table("users")
            ->join("mahasiswa", "users.id", "=", "mahasiswa.nim")
            ->select("users.*", "mahasiswa.*")
            ->where("users.id", "=", auth()->user()->id)
            ->first();
        return view('profil-detail.profil-mahasiswa');
    }

    public function inputfirst(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|max:255',
            'kota' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'jalur_masuk' => 'required',
            'no_handphone' => 'required|numeric|digits_between:10,13|unique:mahasiswa',
            'foto' => 'required|file|mimes:jpeg,png,jpg',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $foto = $request->file('foto');
        $nama_foto = time() . "_" . $foto->getClientOriginalName();
        $path = 'photo-user/' . $nama_foto;

        Storage::disk('public')->put($path, file_get_contents($foto));

        $id = auth()->user()->id;
        $nip = auth()->user()->nip;
        // dd($nip);
        $angkatan = date('Y');
        $status = 'aktif';

        $data = [
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'angkatan' => $angkatan,
            'jalur_masuk' => $request->jalur_masuk,
            'no_handphone' => $request->no_handphone,
            'foto' => $nama_foto,
            'status' => $status,
            'semester' => '1',
        ];

        Mahasiswa::where('nim', $id)->update($data);
        User::where('id', $id)->update([
            'role' => 'mahasiswa',
            'password' => bcrypt($request->password),
        ]);

        return redirect('/dashboard/mahasiswa');
    }
    public function show_IRS()
    {
        return view('IRS');
    }
    public function input_IRS(Request $request)
    {
        $request->validate([
            'scan_irs' => 'required|mimes:jpeg,png,jpg',
            'semester' => 'required',
            'nilai_ip' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $scan = $request->file('scan_irs');
        $scan_irs = date('Y-m-d') . $scan->getClientOriginalName();
        $path = 'photo-user/' . $scan_irs;

        Storage::disk('public')->put($path, file_get_contents($scan));

        $id = auth()->user()->id;

        $data = [
            'nim' => $id,
            'scan_irs' => $scan_irs,
            'semester' => $request->semester,
            'nilai_ip' => $request->nilai_ip,
            'status' => '0'
        ];

        Irs::create($data);
        return redirect('/dashboard/mahasiswa')->with('success', 'IRS submitted successfully!');
    }

    public function show_KHS()
    {
        return view('KHS');
    }

    public function input_KHS(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'jumlah_sks_semester' => 'required|numeric',
            'jumlah_sks_kumulatif' => 'required|numeric',
            'ip_semester' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'ip_kumulatif' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'scan_khs' => 'required|mimes:jpeg,png,jpg',
        ]);

        $scanKHS = $request->file('scan_khs');
        $scan_khs = date('Y-m-d') . $scanKHS->getClientOriginalName();
        $path = 'photo-user/' . $scan_khs;

        Storage::disk('public')->put($path, file_get_contents($scanKHS));

        $id = auth()->user()->id;

        $data = [
            'nim' => $id,
            'scan_khs' => $scan_khs,
            'semester' => $request->semester,
            'jumlah_sks_semester' => $request->jumlah_sks_semester,
            'jumlah_sks_kumulatif' => $request->jumlah_sks_kumulatif,
            'ip_semester' => $request->ip_semester,
            'ip_kumulatif' => $request->ip_kumulatif,
            'status' => '0'
        ];

        Khs::create($data);
        return redirect('/dashboard/mahasiswa')->with('success', 'KHS submitted successfully!');
    }
    public function show_PKL()
    {
        return view('PKL');
    }
    public function input_PKL(Request $request)
    {
        $request->validate([
            //'status_pkl' => 'required',
            'nilai' => 'required|numeric',
            'tahun' => 'required|numeric',
            'scan_berita' => 'required|mimes:jpeg,png,jpg',
        ]);

        $scanPKL = $request->file('scan_berita');
        $scan_berita = date('Y-m-d') . $scanPKL->getClientOriginalName();
        $path = 'photo-user/' . $scan_berita;

        Storage::disk('public')->put($path, file_get_contents($scanPKL));

        $id = auth()->user()->id;

        $data = [
            'nim' => $id,
            'status_pkl',
            'tahun' => $request->tahun,
            'scan_berita' => $scan_berita,
            'nilai' => $request->nilai,
            'status' => '0'
        ];

        pkl::create($data);
        return redirect('/dashboard/mahasiswa')->with('success', 'PKL submitted successfully!');
    }

    public function show_skripsi()
    {
        return view('skripsi');
    }
    public function input_skripsi(Request $request)
    {
        $request->validate([
            //'status_skripsi' => 'required',
            'nilai' => 'required|numeric',
            'tgl_sidang' => 'required',
            'scan_berita' => 'required|mimes:jpeg,png,jpg',
        ]);

        $scanSkripsi = $request->file('scan_berita');
        $scan_berita = date('Y-m-d') . $scanSkripsi->getClientOriginalName();
        $path = 'photo-user/' . $scan_berita;

        Storage::disk('public')->put($path, file_get_contents($scanSkripsi));

        $id = auth()->user()->id;

        $data = [
            'nim' => $id,
            'status_skripsi',
            'tgl_sidang' => $request->tgl_sidang,
            'scan_berita' => $scan_berita,
            'nilai' => $request->nilai,
            'status' => '0'
        ];

        skripsi::create($data);
        return redirect('/dashboard/mahasiswa')->with('success', 'PKL submitted successfully!');
    }

    public function view_profile()
    {
        $data = DB::table("users")
            ->join("mahasiswa", "users.id", "=", "mahasiswa.nim")
            ->select("users.*", "mahasiswa.*")
            ->where("users.id", "=", auth()->user()->id)
            ->first();
        dd($data);
        return view('Profil/Profil-Mahasiswa', compact('data'));
    }
}
