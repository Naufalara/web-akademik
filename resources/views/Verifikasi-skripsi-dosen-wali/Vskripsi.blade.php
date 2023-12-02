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
                            <th>Status skripsi</th>
                            <th>Tanggal Sidang</th>
                            <th>Nilai Skripsi</th>
                            <th>Scan Berita Skripsi</th>
                            <th>Status Verifikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($skripsi as $s)
                            <tr>
                                <td>{{ $s->nim }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->status_skripsi }}</td>
                                <td>{{ $s->tgl_sidang }}</td>
                                <td>{{ $s->nilai }}</td>
                                <td>{{ $s->scan_berita }}</td>
                                <td>{{ $s->status }}</td>
                                <td>
                                    <form action="{{ route('verifikasi_skripsi', ['nim' => $s->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Aprove</button>
                                    </form>
                                    <form action="{{ route('reject_skripsi', ['nim' => $s->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    <a href="{{ route('modify_skripsi', ['nim' => $s->nim]) }}"
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
