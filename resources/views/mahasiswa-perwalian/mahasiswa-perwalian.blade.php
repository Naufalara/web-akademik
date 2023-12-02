@extends('layouts.app')

@section('content')
    <style>
        table th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <div class="container py-1">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ $url }}" class="btn btn-danger">Back</a>
                </div>
                <div class="row mb-3 align-items-center">

                    <form action="/dashboard/mahasiswa_perwalian" method="GET">
                        <div class="col d-flex">
                            <div class="input-group me-3">
                                <span class="input-group-text"><i class="bi bi-search"></i>Search</span>
                                <input type="search" class="form-control" placeholder="Search" name="search"
                                    id="search">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Semester</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($mahasiswa as $i)
                                <tr>
                                    <td>{{ $i->nim }}</td>
                                    <td>{{ $i->nama }}</td>
                                    <td>{{ $i->semester }}</td>
                                    <td>
                                        @php
                                            $account = auth()->user()->role;
                                        @endphp
                                        <a href="{{ route('mahasiswa_perwalian_progres', ['nim' => $i->nim]) }}"
                                            class="btn btn-primary">Lihat Progress</a>
                                        @if ($account == 'operator')
                                            <a href="{{ route('mahasiswa_perwalian_input_irs', ['nim' => $i->nim]) }}"
                                                class="btn btn-warning">Input IRS</a>
                                            <a href="{{ route('mahasiswa_perwalian_input_khs', ['nim' => $i->nim]) }}"
                                                class="btn btn-danger">Input KHS</a>
                                            <a href="{{ route('mahasiswa_perwalian_input_pkl', ['nim' => $i->nim]) }}"
                                                class="btn btn-warning">Input PKL</a>
                                            <a href="{{ route('mahasiswa_perwalian_input_skripsi', ['nim' => $i->nim]) }}"
                                                class="btn btn-danger">Input Skripsi</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
