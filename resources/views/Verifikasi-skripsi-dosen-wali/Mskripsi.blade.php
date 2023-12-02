@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <form action="/dashboard/verifikasi_skripsi/{{ $skripsi->nim }}/update" method="POST">
                {{-- <form action="" method="POST"> --}}
                @csrf
                <div>
                    <label>NIM</label>
                    <input type="text" name="nim" id="nim" disabled value="{{ $skripsi->nim }}">

                </div>
                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" disabled value="{{ $skripsi->nama }}">

                </div>
                <div>
                    <label>Status Skripsi</label>
                    <input type="text" name="status_skripsi" id="status_skripsi" disabled
                        value="{{ $skripsi->status_skripsi }}">
                </div>
                <div>
                    <label>Tanggal Sidang</label>
                    <input type="date" name="tgl_sidang" id="tgl_sidang" value="{{ $skripsi->tgl_sidang }}">
                    @error('tgl_sidang')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label>Nilai</label>
                    <input type="text" name="nilai" id="nilai" value="{{ $skripsi->nilai }}">
                    @error('nilai')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/dashboard/verifikasi_skripsi">Back</a>
            </form>
        </div>
    </div>
@endsection
