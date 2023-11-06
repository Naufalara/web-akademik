<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    function login()
    {
        if (Auth::User()->role == 'operator') {
            return redirect('/dashboard/operator');
        } elseif (Auth::User()->role == 'dosen_wali') {
            return redirect('/dashboard/dosen_wali');
        } elseif (Auth::User()->role == 'mahasiswa') {
            return redirect('/dashboard/mahasiswa');
        } elseif (Auth::User()->role == 'departemen') {
            return redirect('/dashboard/departemen');
        } elseif (Auth::User()->role == 'guest') {
            return redirect('/dashboard/guest');
        }
    }
    public function operator()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user's data
            $user = Auth::user();

            // Access user data, e.g., NIP and name
            $nip = $user->nip;
            $name = $user->name;

            // Return a view with user data
            return view('operator', compact('nip', 'name'));
        } else {
            // Handle the case where the user is not authenticated
            return redirect('/login');
        }
    }
    public function mahasiswa()
    {
        return view('mahasiswa');
    }
    public function dosen_wali()
    {
        return view('dosen_wali');
    }
    public function departemen()
    {
        return view('departemen');
    }
    public function guest()
    {
        $data = DB::table("users")
            ->join("mahasiswa", "users.id", "=", "mahasiswa.nim")
            ->select("users.*", "mahasiswa.*")
            ->where("users.id", "=", auth()->user()->id)
            ->first();
        $id = auth()->user()->id;
        return view('guest', compact('data', 'id'));
    }
    public function page_error()
    {
        return view('page_access_error');
    }
}
