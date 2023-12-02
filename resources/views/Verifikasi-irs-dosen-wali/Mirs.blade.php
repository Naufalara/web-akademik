@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <form action="/dashboard/verifikasi_irs/{{ $irs->nim }}/update" method="POST">
                {{-- <form action="#" method="POST"> --}}
                @csrf
                <div>
                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control fw-bold" name="nim" id="nim" disabled
                        value="{{ $irs->nim }}">
                    @error('nim')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control fw-bold" name="nama" id="nama" disabled
                        value="{{ $irs->nama }}">
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="form-label">Semester</label>
                    <input type="text" class="form-control" name="semester" id="semester" value="{{ $irs->semester }}">
                    @error('semester')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="form-label">Nilai IP</label>
                    <input type="text" class="form-control" name="nilai_ip" id="nilai_ip" value="{{ $irs->nilai_ip }}">
                    @error('nilai_ip')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div>
                    <label class="form-label">Status</label>
                    <select class="form-control mb-3" name="status" id="status">
                        <option value="">Pilih Status</option>
                        <option value="1" @if (old('status') == '1') selected @endif>Verifikasi</option>
                        <option value="0" @if (old('status') == '0') selected @endif>Reject</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/dashboard/verifikasi_irs" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
@endsection
