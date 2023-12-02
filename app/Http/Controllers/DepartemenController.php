<?php

namespace App\Http\Controllers;

use App\Exports\ExportRekapPKL; // Import the ExportRekapPKL class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DepartemenController extends Controller
{
    public function rekappkl(Request $request)
    {
        $pkl = DB::table('pkl')
            ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
            ->select('pkl.*', 'mahasiswa.*')
            ->where('status_pkl', '=', 'Lulus')
            ->get();
        return view('rekap.rekap-pkl', compact('pkl'));
    }

    public function rekappkl_belum(Request $request)
    {
        $pkl = DB::table('mahasiswa')
            ->leftJoin('pkl', function ($join) {
                $join->on('mahasiswa.nim', '=', 'pkl.nim');
            })
            ->select('mahasiswa.*')
            ->whereNull('pkl.nim')
            ->get();
        return view('rekap.rekap-pkl-belum', compact('pkl'));
    }

    public function exportexcel_pkl()
    {
        return Excel::download(new ExportRekapPKL, 'Rekap PKL.xlsx');
    }
}
