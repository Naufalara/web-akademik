<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImoprt;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends Controller
{
    public function menu()
    {
        $User = User::all();
        return view("operator.data-mahasiswa", compact('User'));
    }
    public function import(Request $request)
    {
        $data = $request->file('file');
        $nama_file = $data->getClientOriginalName();
        $data->move('data_mahasiswa', $nama_file);
        // Excel::import(new MahasiswaImport, \public_path('/data_mahasiswa/' . $nama_file));
        Excel::import(new MahasiswaImoprt, \public_path('/data_mahasiswa/' . $nama_file));
        return redirect()->back();
    }
    public function reset($id)
    {
        $data = User::where('id', $id)->first();
        if ($data) {
            $data->password = bcrypt(12345678);
            $data->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
