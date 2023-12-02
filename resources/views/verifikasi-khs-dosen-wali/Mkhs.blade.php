@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <form action="/dashboard/verifikasi_khs/{{ $khs->nim }}/update" method="POST">
                {{-- <form action="" method="POST"> --}}
                @csrf
                <div>
                    <label>NIM</label>
                    <input type="text" name="nim" id="nim" disabled value="{{ $khs->nim }}">
                </div>
                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" disabled value="{{ $khs->nama }}">
                </div>
                <div>
                    <label>Semester</label>
                    <input type="text" name="semester" id="semester" value="{{ $khs->semester }}">
                </div>
                <div>
                    <label>Jumlah sks semester</label>
                    <input type="text" name="jumlah_sks_semester" id="jumlah_sks_semester"
                        value="{{ $khs->jumlah_sks_semester }}">
                    @error('jumlah_sks_semester')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Jumlah sks kumulatif</label>
                    <input type="text" name="jumlah_sks_kumulatif" id="jumlah_sks_kumulatif"
                        value="{{ $khs->jumlah_sks_kumulatif }}">
                    @error('jumlah_sks_kumulatif')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>IP semester</label>
                    <input type="text" name="ip_semester" id="ip_semester" value="{{ $khs->ip_semester }}">
                    @error('ip_semester')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>IP kumulatif</label>
                    <input type="text" name="ip_kumulatif" id="ip_kumulatif" value="{{ $khs->ip_kumulatif }}">
                    @error('ip_kumulatif')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/dashboard/verifikasi_khs">Back</a>
            </form>
        </div>
    </div>
@endsection
