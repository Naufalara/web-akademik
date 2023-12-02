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

        .semester-button-yellow {
            /* Ganti warna latar belakang sesuai keinginan */
            background-color: rgb(208, 219, 52);
            /* Contoh warna: Biru */
            color: #fff;
            /* Warna teks */
            /* Gaya lainnya */
            /* padding: 10px; */
            /* border: none; */
            /* border-radius: 5px; */
        }

        .semester-button-green {
            /* Ganti warna latar belakang sesuai keinginan */
            background-color: rgb(52, 219, 74);
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
                        <a href="{{ route('mahasiswa_perwalian_index') }}" class="btn btn-danger">Back</a>
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

                    <div>
                        <form action="{{ route('mahasiswa_perwalian_progres', ['nim' => $data_mahasiswa['nim']]) }}"
                            method="GET">
                            <div class="col d-flex">
                                @for ($i = 1; $i <= 14; $i++)
                                    @php
                                        $irsFilled = isset($data_irs[$i]);
                                        $khsFilled = isset($data_khs[$i]);
                                        $skripsiDone = isset($skripsi) && $i >= 8; // Anggap skripsi selesai di semester 8 atau setelahnya
                                        $pklDone = isset($pkl) && $i >= 6; // Anggap PKL selesai di semester 6 atau setelahnya

                                        $buttonColor = '';

                                        if ($irsFilled && $khsFilled) {
                                            $buttonColor = 'semester-button-blue';
                                        } elseif ($i == 6 && $pklDone) {
                                            $buttonColor = 'semester-button-yellow';
                                        } elseif ($i == 8 && $skripsiDone) {
                                            $buttonColor = 'semester-button-green';
                                        } else {
                                            $buttonColor = 'semester-button-red';
                                        }
                                    @endphp
                                    <div class="input-group me-3">
                                        <button type="button" class="form-control {{ $buttonColor }}" name="semester"
                                            value="{{ $i }}" data-bs-toggle="modal"
                                            data-bs-target="#progresstudi{{ $i }}">
                                            Semester {{ $i }}
                                        </button>
                                    </div>
                                @endfor
                            </div>

                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    @for ($i = 1; $i <= 14; $i++)
        <div class="modal fade" id="progresstudi{{ $i }}" tabindex="-1"
            aria-labelledby="progresstudi{{ $i }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="progresstudi{{ $i }}">Semester
                            {{ $i }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="fs-5">IRS</h2>
                        <p>Nilai IP :
                            {{ isset($data_irs[$i]) ? $data_irs[$i]['nilai_ip'] : 'Data not available' }}</p> <br>
                        @php
                            $irsAvailable = isset($data_irs[$i]);
                            $khsAvailable = isset($data_khs[$i]);
                        @endphp
                        @if ($irsAvailable)
                            <a href="{{ route('mahasiswa_perwalian_progres_irs_detail', ['nim' => $data_mahasiswa['nim'], 'semester' => $i]) }}"
                                class="btn btn-success">Detail</a>
                        @else
                            <button class="btn btn-success" disabled>Detail</button>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-target="#progresstudi2{{ $i }}"
                            data-bs-toggle="modal">KHS</button>
                    </div>
                </div>
            </div>
        </div>
    @endfor
    @for ($i = 1; $i <= 14; $i++)
        <div class="modal fade" id="progresstudi2{{ $i }}" tabindex="-1"
            aria-labelledby="progresstudi2{{ $i }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="progresstudi2{{ $i }}">Semester
                            {{ $i }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h2 class="fs-5">KHS</h2>
                        Jumlah SKS Semester :
                        {{ isset($data_khs[$i]) ? $data_khs[$i]['jumlah_sks_semester'] : 'Data not available' }} <br>
                        Jumlah SKS Kumulatif :
                        {{ isset($data_khs[$i]) ? $data_khs[$i]['jumlah_sks_kumulatif'] : 'Data not available' }} <br>
                        Nilai IP Semester :
                        {{ isset($data_khs[$i]) ? $data_khs[$i]['ip_semester'] : 'Data not available' }} <br>
                        Nilai IP Kumulatif :
                        {{ isset($data_khs[$i]) ? $data_khs[$i]['ip_kumulatif'] : 'Data not available' }} <br>
                        @php
                            $irsAvailable = isset($data_irs[$i]);
                            $khsAvailable = isset($data_khs[$i]);
                        @endphp
                        @if ($khsAvailable)
                            <a href="{{ route('mahasiswa_perwalian_progres_khs_detail', ['nim' => $data_mahasiswa['nim'], 'semester' => $i]) }}"
                                class="btn btn-success">Detail</a>
                        @else
                            <button class="btn btn-success" disabled>Detail</button>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-target="#progresstudi{{ $i }}"
                            data-bs-toggle="modal">IRS</button>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endsection
