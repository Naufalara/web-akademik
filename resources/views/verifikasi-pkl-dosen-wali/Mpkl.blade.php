@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <form action="/dashboard/verifikasi_pkl/{{ $pkl->nim }}/update" method="POST">
                {{-- <form action="" method="POST"> --}}
                @csrf
                <div>
                    <label>NIM</label>
                    <input type="text" name="nim" id="nim" disabled value="{{ $pkl->nim }}">
                </div>
                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" disabled value="{{ $pkl->nama }}">

                </div>
                <div>
                    <label>Tahun</label>
                    <input type="text" name="tahun" id="tahun" value="{{ $pkl->tahun }}">
                    @error('tahun')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Nilai</label>
                    <input type="text" name="nilai" id="nilai" value="{{ $pkl->nilai }}">
                    @error('nilai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/dashboard/verifikasi_pkl">Back</a>
            </form>
        </div>
    </div>
@endsection
