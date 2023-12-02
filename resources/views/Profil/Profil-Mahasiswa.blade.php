@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row dashboard">
            <div class="col-3 d-flex">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">

                            <li class="profil-show" style="">
                                <img src="/dummy-profil.png" style="height: 200px">
                            </li>
                            <li class="profil-show">
                                <label for="nip">NIM : </label>
                                <span>{{ auth()->user()->id }}</span>


                            </li>
                            <li class="profil-show">
                                <label for="nama">Nama : </label>
                                <span>{{ auth()->user()->name }}</span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="col-9">
                @csrf
                <div>
                    <label>NIM</label>
                    <span class="form-control">{{ auth()->user()->id }}</span>
                </div>
                <div>
                    <label>Nama</label>
                    <span class="form-control">{{ auth()->user()->name }}</span>
                </div>
                <div>
                    <label>Alamat</label>
                    <span class="form-control">{{ $data->alamat }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
