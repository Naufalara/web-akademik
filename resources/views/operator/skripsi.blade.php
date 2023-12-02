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
                    <form action="{{ route('mahasiswa_perwalian_input_skripsi_update', ['nim' => $data->nim]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Belum Ambil</option>
                                <option value="2">Sedang Ambil</option>
                                <option value="3">Lulus</option>
                            </select>
                        </div>
                        <div>
                            <label>Nilai</label>
                            <input type="text" id="nilai" name="nilai" class="form-control" value=""
                                disabled>
                            @error('nilai')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Tanggal Sidang</label>
                            <input type="date" id="tgl_sidang" name="tgl_sidang" class="form-control" value=""
                                disabled>
                            @error('tgl_sidang')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Scan Sidang Skripsi</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="scan_berita" name="scan_berita"
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the elements
            var statusDropdown = document.querySelector('select[name="status"]');
            var nilaiInput = document.getElementById('nilai');
            var tgl_sidangInput = document.getElementById('tgl_sidang');

            // Add an event listener to the status dropdown
            statusDropdown.addEventListener('change', function() {
                // Check the selected value
                if (statusDropdown.value === '3') {
                    // If value is 3 (Lulus), enable the nilai input
                    nilaiInput.disabled = false;
                    tgl_sidangInput.disabled = false;

                } else {
                    // For other values, disable the nilai input
                    nilaiInput.disabled = true;
                    nilaiInput.value = '';
                    tgl_sidangInput.disabled = true;
                    tgl_sidangInput.value = '';

                }
            });

            if (statusDropdown.value !== '3') {
                nilaiInput.disabled = true;
                nilaiInput.value = '';
                tgl_sidangInput.disabled = true;
                tgl_sidangInput.value = '';

            }
        });
    </script>
@endsection
