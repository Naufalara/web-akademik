@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label class="card-title">Nama : </label>
                        <label>{{ $data->nama }}</label>
                    </div>
                    <div>
                        <label class="card-title">NIM : </label>
                        <label>{{ $data->nim }}</label>
                    </div>
                    <div>
                        <label class="card-title">Angkatan : </label>
                        <label>{{ $data->angkatan }}</label>
                    </div>
                    <div>
                        <label class="card-title">Dosen Wali : </label>
                        <label>{{ $data->nama_dosenwali }}</label>
                    </div>
                    <form action="{{ route('mahasiswa_perwalian_input_irs_update', ['nim' => $data->nim]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Semester</label>
                            <select name="semester" class="form-control">
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                                <option value="9">Semester 9</option>
                                <option value="10">Semester 10</option>
                                <option value="11">Semester 11</option>
                                <option value="12">Semester 12</option>
                                <option value="13">Semester 13</option>
                                <option value="14">Semester 14</option>
                            </select>
                            @error('semester')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Nilai IP</label>
                            <input type="text" class="form-control" name="nilai_ip" value="">
                            @error('nilai_ip')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Scan IRS</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="scan_irs" name="scan_irs"
                                        onchange="previewImage()">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" href="/dashboard/mahasiswa_perwalian">
                                <span>Back</span></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
