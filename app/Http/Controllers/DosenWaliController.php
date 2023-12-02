<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Khs;
use App\Models\Mahasiswa;
use App\Models\pkl;
use App\Models\skripsi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DosenWaliController extends Controller
{
    //IRS
    public function index(): View
    {
        $role = auth()->user()->role;
        $url = "/dashboard/{$role}";
        // dd($role);
        $nip = auth()->user()->id;

        if (auth()->user()->role == 'dosen_wali') {
            $irs = DB::table('irs')
                ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
                ->select('irs.*', 'mahasiswa.nama')
                ->where('mahasiswa.nip', '=', $nip)
                ->get();
        } else {
            $irs = DB::table('irs')
                ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
                ->select('irs.*', 'mahasiswa.nama')
                ->get();
        }
        return view('Verifikasi-irs-dosen-wali.Virs', compact('irs', 'role', 'url'));
    }
    public function verifikasi_warning($nim)
    {
        $irs = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->select('irs.*', 'mahasiswa.nama')
            ->where('irs.nim', $nim)
            ->get();
        return view('Verifikasi-irs-dosen-wali.Airs', compact('nim'));
    }
    public function verifikasi($nim)
    {

        Irs::where('nim', $nim)
            ->update([
                'status' => '1'
            ]);
        return redirect()->back();
    }
    public function reject($nim)
    {
        Irs::where('nim', $nim)
            ->update([
                'status' => '0'
            ]);
        return redirect()->back();
    }
    public function modify($nim)
    {
        $irs = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->select('irs.*', 'mahasiswa.nama')
            ->where('irs.nim', $nim)
            ->first(); // Use first() instead of get() to retrieve a single record
        // dd($irs);
        return view('Verifikasi-irs-dosen-wali.Mirs', compact('irs')); // Pass $irs to the view
    }
    public function update(Request $request, $nim)
    {
        $request->validate([
            'semester' => 'required',
            'nilai_ip' => 'required',

        ]);

        Irs::where('nim', $nim)->update([
            'semester' => $request->semester,
            'nilai_ip' => $request->nilai_ip,

            // 'status' => $request->status,
        ]);


        return redirect('/dashboard/verifikasi_irs');
    }
    //KHS
    public function index_khs(): View
    {
        $role = auth()->user()->role;
        $url = "/dashboard/{$role}";
        $nip = auth()->user()->id;

        if (auth()->user()->role == 'dosen_wali') {
            $khs = DB::table('khs')
                ->join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
                ->select('khs.*', 'mahasiswa.nama')
                ->where('mahasiswa.nip', '=', $nip)
                ->get();
        } else {
            $khs = DB::table('khs')
                ->join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
                ->select('khs.*', 'mahasiswa.nama')
                ->get();
        }

        return view('Verifikasi-khs-dosen-wali.Vkhs', compact('khs', 'role', 'url'));
    }
    public function verifikasi_khs($nim)
    {

        Khs::where('nim', $nim)
            ->update([
                'status' => '1'
            ]);

        return redirect()->back();
    }
    public function reject_khs($nim)
    {
        Khs::where('nim', $nim)
            ->update([
                'status' => '0'
            ]);
        return redirect()->back();
    }
    public function modify_khs($nim)
    {
        $khs = DB::table('khs')
            ->join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
            ->select('khs.*', 'mahasiswa.nama')
            ->where('khs.nim', $nim)
            ->first();
        return view('Verifikasi-khs-dosen-wali.Mkhs', compact(['khs']));
    }
    public function update_khs(Request $request, $nim)
    {
        $request->validate([
            'semester' => 'required',
            'jumlah_sks_semester' => 'required',
            'jumlah_sks_kumulatif' => 'required',
            'ip_semester' => 'required',
            'ip_kumulatif' => 'required',
        ]);

        Khs::where('nim', $nim)->update([
            'semester' => $request->semester,
            'jumlah_sks_semester' => $request->jumlah_sks_semester,
            'jumlah_sks_kumulatif' => $request->jumlah_sks_kumulatif,
            'ip_semester' => $request->ip_semester,
            'ip_kumulatif' => $request->ip_kumulatif,
        ]);

        return redirect('/dashboard/verifikasi_khs');
    }
    //PKL
    public function index_pkl(): View
    {
        $role = auth()->user()->role;
        $url = "/dashboard/{$role}";
        $nip = auth()->user()->id;

        if (auth()->user()->role == 'dosen_wali') {
            $pkl = DB::table('pkl')
                ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
                ->select('pkl.*', 'mahasiswa.nama')
                ->where('mahasiswa.nip', '=', $nip)
                ->get();
        } else {
            $pkl = DB::table('pkl')
                ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
                ->select('pkl.*', 'mahasiswa.nama')
                ->get();
        }

        return view('Verifikasi-pkl-dosen-wali.Vpkl', compact('pkl', 'role', 'url'));
    }
    public function verifikasi_pkl($nim)
    {

        pkl::where('nim', $nim)
            ->update([
                'status' => '1'
            ]);

        return redirect()->back();
    }
    public function reject_pkl($nim)
    {
        pkl::where('nim', $nim)
            ->update([
                'status' => '0'
            ]);
        return redirect()->back();
    }
    public function modify_pkl($nim)
    {
        $pkl = DB::table('pkl')
            ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
            ->select('pkl.*', 'mahasiswa.nama')
            ->where('pkl.nim', $nim)
            ->first();
        return view('Verifikasi-pkl-dosen-wali.Mpkl', compact(['pkl']));
    }
    public function update_pkl(Request $request, $nim)
    {
        $request->validate([
            'tahun' => 'required',
            'nilai' => 'required',
        ]);

        pkl::where('nim', $nim)->update([
            'nilai' => $request->nilai,
            'tahun' => $request->tahun,
        ]);
        return redirect('/dashboard/verifikasi_pkl');
    }
    //SKRIPSI
    public function index_skripsi(): View
    {
        $role = auth()->user()->role;
        $url = "/dashboard/{$role}";
        $nip = auth()->user()->id;

        if (auth()->user()->role == 'dosen_wali') {
            $skripsi = DB::table('skripsi')
                ->join('mahasiswa', 'skripsi.nim', '=', 'mahasiswa.nim')
                ->select('skripsi.*', 'mahasiswa.nama')
                ->where('mahasiswa.nip', '=', $nip)
                ->get();
        } else {
            $skripsi = DB::table('skripsi')
                ->join('mahasiswa', 'skripsi.nim', '=', 'mahasiswa.nim')
                ->select('skripsi.*', 'mahasiswa.nama')
                ->get();
        }

        return view('Verifikasi-skripsi-dosen-wali.Vskripsi', compact('skripsi', 'role', 'url'));
    }
    public function verifikasi_skripsi($nim)
    {

        skripsi::where('nim', $nim)
            ->update([
                'status' => '1'
            ]);

        return redirect()->back();
    }
    public function reject_skripsi($nim)
    {
        skripsi::where('nim', $nim)
            ->update([
                'status' => '0'
            ]);
        return redirect()->back();
    }
    public function modify_skripsi($nim)
    {
        $skripsi = DB::table('skripsi')
            ->join('mahasiswa', 'skripsi.nim', '=', 'mahasiswa.nim')
            ->select('skripsi.*', 'mahasiswa.*')
            ->where('skripsi.nim', $nim)
            ->first();
        return view('Verifikasi-skripsi-dosen-wali.Mskripsi', compact(['skripsi']));
    }
    public function update_skripsi(Request $request, $nim)
    {
        $request->validate([
            'tgl_sidang' => 'required',
            'nilai' => 'required',
        ]);

        skripsi::where('nim', $nim)->update([
            'tgl_sidang' => $request->tgl_sidang,
            'nilai' => $request->nilai,
        ]);
        return redirect('/dashboard/verifikasi_skripsi');
    }

    public function mahasiswa_perwalian_index(Request $request)
    {
        $role = auth()->user()->role;
        $url = "/dashboard/{$role}";
        $nip = auth()->user()->id;

        if ($role == 'dosen_wali') {
            if ($request->has('search')) {
                $mahasiswa = DB::table('mahasiswa')
                    ->select('mahasiswa.*')
                    ->where('mahasiswa.nip', '=', $nip)
                    ->where(function ($query) use ($request) {
                        $query->where('mahasiswa.nama', 'like', '%' . $request->search . '%')
                            ->orWhere('mahasiswa.nim', 'like', '%' . $request->search . '%');
                    })
                    ->get();
            } else {
                $mahasiswa = DB::table('mahasiswa')
                    ->select('mahasiswa.*')
                    ->where('mahasiswa.nip', '=', $nip)
                    ->get();
            }
        } else {
            if ($request->has('search')) {
                $mahasiswa = DB::table('mahasiswa')
                    ->select('mahasiswa.*')
                    ->where(function ($query) use ($request) {
                        $query->where('mahasiswa.nama', 'like', '%' . $request->search . '%')
                            ->orWhere('mahasiswa.nim', 'like', '%' . $request->search . '%');
                    })
                    ->get();
            } else {
                $mahasiswa = DB::table('mahasiswa')
                    ->select('mahasiswa.*')
                    ->get();
            }
        }

        return view('mahasiswa-perwalian.mahasiswa-perwalian', compact('mahasiswa', 'role', 'url'));
    }
    public function mahasiswa_perwalian_progres(Request $request, $nim)
    {
        $semester = $request->input('semester'); // Mendapatkan nilai semester yang dipilih dari 
        // dd($semester);

        // Query untuk mendapatkan IRS berdasarkan semester yang dipilih
        $data = DB::table('mahasiswa')->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('mahasiswa.nama', 'dosen_wali.nama as nama_dosenwali', 'mahasiswa.angkatan')
            ->where('mahasiswa.nim', '=', $nim)
            ->first();
        $irs = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->select('irs.*')
            ->where('mahasiswa.nim', '=', $nim)
            // ->where('irs.semester', '=', $semester)
            ->get();
        $khs = DB::table('khs')
            ->join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
            ->select('khs.*', 'mahasiswa.nama')
            ->where('mahasiswa.nim', '=', $nim)
            // ->where('khs.semester', '=', $semester)
            ->get();

        $skripsi = DB::table('skripsi')
            ->join('mahasiswa', 'skripsi.nim', '=', 'mahasiswa.nim')
            ->select('skripsi.*', 'mahasiswa.nama')
            ->where('mahasiswa.nim', '=', $nim)
            ->first();

        $pkl = DB::table('pkl')
            ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
            ->select('pkl.*', 'mahasiswa.nama')
            ->where('mahasiswa.nim', '=', $nim)
            ->first();

        $data_mahasiswa = [
            'nim' => $nim,
            'nama' => $data->nama,
            'nama_dosenwali' => $data->nama_dosenwali,
            'angkatan' => $data->angkatan,
        ];
        $data_irs = []; // Inisialisasi array

        foreach ($irs as $row) {
            $data_irs[$row->semester] = [
                'nim' => $row->nim,
                'nilai_ip' => $row->nilai_ip,
                'scan_irs' => $row->scan_irs,
            ];
        }

        $data_khs = []; // Inisialisasi array
        foreach ($khs as $row) {
            $data_khs[$row->semester] = [
                'jumlah_sks_semester' => $row->jumlah_sks_semester,
                'jumlah_sks_kumulatif' => $row->jumlah_sks_kumulatif,
                'ip_semester' => $row->ip_semester,
                'ip_kumulatif' => $row->ip_kumulatif,
            ];
        }
        // dd($data_mahasiswa);
        // dd($irs);

        return view('mahasiswa-perwalian.mahasiswa-perwalian-progres', compact('data_mahasiswa', 'semester', 'data_irs', 'data_khs', 'skripsi', 'pkl'));
    }
    public function mahasiswa_perwalian_progres_irs_detail($nim, $semester)
    {
        // Query untuk mendapatkan detail IRS sesuai dengan IRS yang dipilih
        $irsDetail = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->select('irs.*')
            ->where('mahasiswa.nim', '=', $nim)
            ->where('irs.semester', '=', $semester)
            ->first();

        $data = DB::table('mahasiswa')->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('mahasiswa.nama', 'dosen_wali.nama as nama_dosenwali', 'mahasiswa.angkatan')
            ->where('mahasiswa.nim', '=', $nim)
            ->first();

        $data_mahasiswa = [
            'nim' => $nim,
            'nama' => $data->nama,
            'nama_dosenwali' => $data->nama_dosenwali,
            'angkatan' => $data->angkatan,
        ];

        return view('mahasiswa-perwalian.mahasiswa-perwalian-progres-detail-irs', compact('irsDetail', 'data_mahasiswa', 'semester'));
    }
    public function mahasiswa_perwalian_progres_khs_detail($nim, $semester)
    {
        $khsDetail = DB::table('khs')
            ->join('mahasiswa', 'khs.nim', '=', 'mahasiswa.nim')
            ->select('khs.*', 'mahasiswa.nama')
            ->where('mahasiswa.nim', '=', $nim)
            ->where('khs.semester', '=', $semester)
            ->first();

        $data = DB::table('mahasiswa')->join('dosen_wali', 'mahasiswa.nip', '=', 'dosen_wali.nip')
            ->select('mahasiswa.nama', 'dosen_wali.nama as nama_dosenwali', 'mahasiswa.angkatan')
            ->where('mahasiswa.nim', '=', $nim)
            ->first();

        $data_mahasiswa = [
            'nim' => $nim,
            'nama' => $data->nama,
            'nama_dosenwali' => $data->nama_dosenwali,
            'angkatan' => $data->angkatan,
        ];

        return view('mahasiswa-perwalian.mahasiswa-perwalian-progres-detail-khs', compact('khsDetail', 'data_mahasiswa', 'semester'));
    }
}
