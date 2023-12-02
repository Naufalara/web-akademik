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
                            <th>Status PKL</th>
                            <th>Tahun</th>
                            <th>Nilai PKL</th>
                            <th>Scan Berita PKL</th>
                            <th>Status Verifikasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($pkl as $p)
                            <tr>
                                <td>{{ $p->nim }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->status_pkl }}</td>
                                <td>{{ $p->tahun }}</td>
                                <td>{{ $p->nilai }}</td>
                                <td>{{ $p->scan_berita }}</td>
                                <td>{{ $p->status }}</td>
                                <td>
                                    <form action="{{ route('verifikasi_pkl', ['nim' => $p->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Aprove</button>
                                    </form>
                                    <form action="{{ route('reject_pkl', ['nim' => $p->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    <a href="{{ route('modify_pkl', ['nim' => $p->nim]) }}"
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
