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
                            <th>Nilai IP</th>
                            <th>Status Verifikasi</th>
                            <th>Scan IRS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($irs as $i)
                            <tr>
                                <td>{{ $i->nim }}</td>
                                <td>{{ $i->nama }}</td>
                                <td>{{ $i->semester }}</td>
                                <td>{{ $i->nilai_ip }}</td>
                                <td>{{ $i->status }}</td>
                                <td>{{ $i->scan_irs }}</td>
                                <td>
                                    <form action="{{ route('verifikasi', ['nim' => $i->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Aprove</button>
                                    </form>
                                    <form action="{{ route('reject', ['nim' => $i->nim]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    <a href="{{ route('modify', ['nim' => $i->nim]) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
