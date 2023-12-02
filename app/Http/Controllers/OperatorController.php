<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImoprt;
use App\Imports\MahasiswaImport;
use App\Models\Irs;
use App\Models\Khs;
use App\Models\pkl;
use App\Models\skripsi;
use App\Models\User;
use App\Models\Mahasiswa; // Add this line to import the Mahasiswa model
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    public function menu()
    {

        $User = User::paginate(10);
        return view("operator.data-mahasiswa", [
            'User' => DB::table('users')->paginate(15)
        ]);
    }
    public function import(Request $request)
    {
        $data = $request->file('file');
        $nama_file = $data->getClientOriginalName();
        $data->move('data_mahasiswa', $nama_file);
        // Excel::import(new MahasiswaImport, \public_path('/data_mahasiswa/' . $nama_file));
        Excel::import(new MahasiswaImoprt, \public_path('/data_mahasiswa/' . $nama_file));
        Excel::import(new MahasiswaImport, \public_path('/data_mahasiswa/' . $nama_file));
        return redirect()->back();
    }
    public function reset($id)
    {
        $user = User::where('id', $id)->first();
        User::where('id', $user)->update([
            'password' => bcrypt('12345678'),
        ]);
        return redirect()->back();
    }
    public function addaccount(Request $request)
    {
        $request->validate([
            'id' => 'numeric|required',
            'nip' => 'numeric|required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'angkatan' => 'required|numeric',
        ]);

        $password = bcrypt('12345678'); // Enkripsi password dari input form
        $status = 'Aktif';
        $role = 'guest';

        $user = [
            'id' => $request->id,
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => $role,
        ];

        $mahasiswa = [
            'nim' => $request->id,
            'nip' => $request->nip,
            'nama' => $request->name,
            'angkatan' => $request->angkatan,
            'status' => $status,
        ];

        Session::flash('success', 'Data berhasil ditambahkan');

        User::create($user);
        Mahasiswa::create($mahasiswa);
        return redirect()->back();
    }
    public function mahasiswa_perwalian_input_irs($nim)
    {
        $irs = DB::table('irs')->where('irs.nim', '=', $nim)->get();

        $data = DB::table('mahasiswa')
            ->join('irs', 'mahasiswa.nim', '=', 'irs.nim')
            ->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('irs.*', 'mahasiswa.*', 'dosen_wali.nama as nama_dosenwali')
            ->where('irs.nim', '=', $nim)
            ->first();
        // dd($data);
        return view('operator.irs', compact(['irs'], 'data'));
    }
    public function mahasiswa_perwalian_input_irs_update(Request $request, $nim)
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

        $data = [
            'nim' => $nim,
            'scan_irs' => $scan_irs,
            'semester' => $request->semester,
            'nilai_ip' => $request->nilai_ip,
            'status' => '0'
        ];

        $existingIrs = Irs::where('nim', $nim)->where('semester', $request->semester)->first();

        if ($existingIrs) {
            // Jika data sudah ada, lakukan update
            $existingIrs->update($data);
            Session::flash('success', 'Data berhasil diperbarui');
        } else {
            // Jika data belum ada, buat data baru
            Irs::create($data);
            Session::flash('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('mahasiswa_perwalian_index'));
    }
    public function mahasiswa_perwalian_input_khs($nim)
    {
        $khs = DB::table('khs')->where('khs.nim', '=', $nim)->get();

        $data = DB::table('mahasiswa')
            ->join('khs', 'mahasiswa.nim', '=', 'khs.nim')
            ->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('khs.*', 'mahasiswa.*', 'dosen_wali.nama as nama_dosenwali')
            ->where('khs.nim', '=', $nim)
            ->first();
        // dd($data);
        return view('operator.khs', compact(['khs'], 'data'));
    }
    public function mahasiswa_perwalian_input_khs_update(Request $request, $nim)
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

        $data = [
            'nim' => $nim,
            'scan_khs' => $scan_khs,
            'semester' => $request->semester,
            'jumlah_sks_semester' => $request->jumlah_sks_semester,
            'jumlah_sks_kumulatif' => $request->jumlah_sks_kumulatif,
            'ip_semester' => $request->ip_semester,
            'ip_kumulatif' => $request->ip_kumulatif,
            'status' => '0'
        ];

        $existingKhs = Khs::where('nim', $nim)->where('semester', $request->semester)->first();

        if ($existingKhs) {
            // Jika data sudah ada, lakukan update
            $existingKhs->update($data);
            Session::flash('success', 'Data berhasil diperbarui');
        } else {
            // Jika data belum ada, buat data baru
            Khs::create($data);
            Session::flash('success', 'Data berhasil ditambahkan');
        }
        return redirect(route('mahasiswa_perwalian_index'));
    }
    public function mahasiswa_perwalian_input_pkl($nim)
    {
        $pkl = DB::table('pkl')->where('pkl.nim', '=', $nim)->get();

        $data = DB::table('mahasiswa')
            ->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
            ->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('pkl.*', 'mahasiswa.*', 'dosen_wali.nama as nama_dosenwali')
            ->where('pkl.nim', '=', $nim)
            ->first();
        // dd($data);
        return view('operator.pkl', compact(['pkl'], 'data'));
    }
    public function mahasiswa_perwalian_input_pkl_update(Request $request, $nim)
    {
        $request->validate([
            'nilai' => 'required|numeric',
            'tahun' => 'required|numeric',
            'scan_berita' => 'required|mimes:jpeg,png,jpg',
        ]);

        $scan = $request->file('scan_berita');
        $scan_pkl = date('Y-m-d') . $scan->getClientOriginalName();
        $path = 'photo-user/' . $scan_pkl;

        Storage::disk('public')->put($path, file_get_contents($scan));

        $data = [
            'nim' => $nim,
            'status_pkl',
            'tahun' => $request->tahun,
            'scan_berita' => $scan_pkl,
            'nilai' => $request->nilai,
            'status' => '0'
        ];

        $existingPkl = Pkl::where('nim', $nim)->first();

        if ($existingPkl) {
            // Jika data sudah ada, lakukan update
            $existingPkl->update($data);
            Session::flash('success', 'Data berhasil diperbarui');
        } else {
            // Jika data belum ada, buat data baru
            Pkl::create($data);
            Session::flash('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('mahasiswa_perwalian_index'));
    }
    public function mahasiswa_perwalian_input_skripsi($nim)
    {
        $skripsi = DB::table('skripsi')->where('skripsi.nim', '=', $nim)->get();

        $data = DB::table('mahasiswa')
            ->join('skripsi', 'mahasiswa.nim', '=', 'skripsi.nim')
            ->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('skripsi.*', 'mahasiswa.*', 'dosen_wali.nama as nama_dosenwali')
            ->where('skripsi.nim', '=', $nim)
            ->first();
        // dd($data);
        return view('operator.skripsi', compact(['skripsi'], 'data'));
    }
    public function mahasiswa_perwalian_input_skripsi_update(Request $request, $nim)
    {
        $request->validate([
            'nilai' => 'required|numeric',
            'tgl_sidang' => 'required',
            'scan_berita' => 'required|mimes:jpeg,png,jpg',
        ]);

        $scan = $request->file('scan_berita');
        $scan_skripsi = date('Y-m-d') . $scan->getClientOriginalName();
        $path = 'photo-user/' . $scan_skripsi;

        Storage::disk('public')->put($path, file_get_contents($scan));

        $data = [
            'nim' => $nim,
            'status_skripsi' => 'Lulus',
            'tgl_sidang' => $request->tgl_sidang,
            'scan_berita' => $scan_skripsi,
            'nilai' => $request->nilai,
            'status' => '0'
        ];

        $existingSkripsi = Skripsi::where('nim', $nim)->first();

        if ($existingSkripsi) {
            // Jika data sudah ada, lakukan update
            $existingSkripsi->update($data);
            Session::flash('success', 'Data berhasil diperbarui');
        } else {
            // Jika data belum ada, buat data baru
            Skripsi::create($data);
            Session::flash('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('mahasiswa_perwalian_index'));
    }
}
