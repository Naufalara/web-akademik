@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">

            <div class="table">
                <a href="{{ $url }}" class="btn btn-danger">Back</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NIM</th>
                            <th>Nama</th>
                            <th>Semester</th>
                            <th>Jumlah SKS Semester</th>
                            <th>Jumlah SKS Kumulatif</th>
                            <th>IP Semester</th>
                            <th>IP Kumulatif</th>
                            <th>Scan KHS</th>
                            <th>Status Verifikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($khs as $k)
                            <tr>
                                <td>{{ $k->nim }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->semester }}</td>
                                <td>{{ $k->jumlah_sks_semester }}</td>
                                <td>{{ $k->jumlah_sks_kumulatif }}</td>
                                <td>{{ $k->ip_semester }}</td>
                                <td>{{ $k->ip_kumulatif }}</td>
                                <td>{{ $k->scan_khs }}</td>
                                <td>{{ $k->status }}</td>
                                <td>
                                    <form action="{{ route('verifikasi_khs', ['nim' => $k->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Aprove</button>
                                    </form>
                                    <form action="{{ route('reject_khs', ['nim' => $k->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    <a href="{{ route('modify_khs', ['nim' => $k->nim]) }}"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
