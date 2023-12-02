@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <form action="/dashboard/guest/{{ $id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>NIM</label>
                    <input type="text" class="form-control" disabled value="{{ $id }}">
                </div>
                <div>
                    <label>NIP</label>
                    <input type="text" class="form-control" disabled value="{{ $data->nip }}">
                </div>
                <div>
                    <label>Angkatan</label>
                    <input type="text" class="form-control" disabled value="{{ date('Y') }}">
                </div>

                <div>
                    <label>Nama</label>
                    <input type="text" class="form-control" disabled value="{{ $data->nama }}" id="nama"
                        name="nama">
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" class="form-control" disabled value="{{ $data->email }}" id="email"
                        name="email">
                </div>
                <div>
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="{{ old('alamat') }}" id="alamat" name="alamat">
                    @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Kab/kota</label>
                    <input type="text" class="form-control" value="{{ old('kota') }}" id="kota" name="kota">
                    @error('kota')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Provinsi</label>
                    <input type="text" class="form-control" value="{{ old('provinsi') }}" id="provinsi"
                        name="provinsi">
                    @error('provinsi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Jalur Masuk</label>
                    <select class="form-select" id="jalur_masuk" name="jalur_masuk">
                        <option value="">Pilih Jalur Masuk</option>
                        <option value="SNMPTN" {{ old('jalur_masuk') == 'SNMPTN' ? 'selected' : '' }}>SNMPTN</option>
                        <option value="SBMPTN" {{ old('jalur_masuk') == 'SBMPTN' ? 'selected' : '' }}>SBMPTN</option>
                        <option value="Mandiri" {{ old('jalur_masuk') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                        <option value="Lainnya" {{ old('jalur_masuk') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

                    </select>
                    @error('jalur_masuk')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Nomor Handphone</label>
                    <input type="text" class="form-control" value="{{ old('no_handphone') }}" id="no_handphone"
                        name="no_handphone">
                    @error('no_handphone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Foto</label>
                    <input type="file" class="form-control" value="{{ old('foto') }}" id="foto" name="foto"
                        onchange="previewImage()">
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" class="form-control" value="{{ old('password') }}" id="password"
                        name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" value="{{ old('password_confirmation') }}"
                        id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="" style="padding-top: 10px">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

        </div>
    </div>
@endsection
