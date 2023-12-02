@extends('layouts.app')

@section('content')
    <style>
        .card-header {
            text-align: center;
        }

        .semester-button-blue {
            /* Ganti warna latar belakang sesuai keinginan */
            background-color: #3498db;
            /* Contoh warna: Biru */
            color: #fff;
            /* Warna teks */
            /* Gaya lainnya */
            /* padding: 10px; */
            /* border: none; */
            /* border-radius: 5px; */
        }

        .semester-button-red {
            /* Ganti warna latar belakang sesuai keinginan */
            background-color: rgb(219, 52, 52);
            /* Contoh warna: Biru */
            color: #fff;
            /* Warna teks */
            /* Gaya lainnya */
            /* padding: 10px; */
            /* border: none; */
            /* border-radius: 5px; */
        }

        .col.d-flex {
            display: flex;
            flex-wrap: wrap;
            /* Menyebabkan item akan melanjut ke baris baru jika tidak cukup ruang */
        }

        .input-group {
            flex: 0 0 11vh;
            /* 25% untuk 4 kolom per baris */
            /* Menyesuaikan jumlah kolom per baris berdasarkan kebutuhan */
        }

        .semester-button {
            width: 100%;
            /* Contoh lebar maksimum 100% */
        }
    </style>
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <div class="card">
                <div class="card-header">
                    <h1>Progress Perkembangan Studi Mahasiswa Informatika <br>
                        Fakultas Sains dan Matematika UNDIP Semarang</h1>
                </div>
                <div class="card-body">
                    <div class="pb-3">
                        <button class="btn btn-danger" onclick="goBack()">Back</button>
                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <div>
                        <div>
                            <label class="card-title">Nama : </label>
                            <label>{{ $data_mahasiswa['nama'] }}</label>
                        </div>
                        <div>
                            <label class="card-title">NIM : </label>
                            <label>{{ $data_mahasiswa['nim'] }}</label>
                        </div>
                        <div>
                            <label class="card-title">Angkatan : </label>
                            <label>{{ $data_mahasiswa['angkatan'] }}</label>
                        </div>
                        <div>
                            <label class="card-title">Dosen Wali : </label>
                            <label>{{ $data_mahasiswa['nama_dosenwali'] }}</label>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <div>
                            <h2 class="card-title">KHS Semester {{ $semester }} : </h2>
                        </div>
                        <div>
                            <label class="card-title">Jumlah SKS Semester : </label>
                            <label>{{ $khsDetail->jumlah_sks_semester }}</label>
                        </div>
                        <div>
                            <label class="card-title">Jumlah SKS Kumulatif : </label>
                            <label>{{ $khsDetail->jumlah_sks_kumulatif }}</label>
                        </div>
                        <div>
                            <label class="card-title">Nilai IP Semester : </label>
                            <label>{{ $khsDetail->ip_semester }}</label>
                        </div>
                        <div>
                            <label class="card-title">Nilai IP Kumulatif</label>
                            <label>{{ $khsDetail->ip_kumulatif }}</label>
                        </div>
                        <div>
                            <label class="card-title">Data Scan KHS : </label>
                            <label>{{ $khsDetail->scan_khs }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
