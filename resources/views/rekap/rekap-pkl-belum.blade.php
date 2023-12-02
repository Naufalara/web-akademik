@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">

            <div class="table">
                <a href="/dashboard/dosen_wali" class="btn btn-danger">Back</a>

                <div class="col d-flex">
                    <div class="input-group me-3">
                        <a href="{{ route('rekappkl') }}" class="btn btn-primary" name="status">Lulus</a>
                        <a href="{{ route('rekappkl_belum') }}" class="btn btn-primary" name="status">Belum Lulus</a>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NIM</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($pkl as $p)
                            <tr>
                                <td>{{ $p->nim }}</td>
                                <td>{{ $p->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
