@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">
            <div class="col-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">

                            <li class="profil-show" style="">
                                <img src="/dummy-profil.png" style="height: 200px">
                            </li>
                            <li class="profil-show">
                                <label for="nip">NIP : </label>
                                <span>{{ auth()->user()->id }}</span>


                            </li>
                            <li class="profil-show">
                                <label for="nama">Nama : </label>
                                <span>{{ auth()->user()->name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="{{ route }}">View Profile </a>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="button-nav" id="button3">
                    <div id="circle"></div>
                    <a href="#">Mahasiswa Perwalian</a>
                </div>
                <div class="button-nav" id="button3">
                    <div id="circle"></div>
                    <a href="#">IRS</a>
                </div>
                <div class="button-nav" id="button3">
                    <div id="circle"></div>
                    <a href="#">KHS</a>
                </div>
                <div class="button-nav" id="button3">
                    <div id="circle"></div>
                    <a href="#">PKL</a>
                </div>
                <div class="button-nav" id="button3">
                    <div id="circle"></div>
                    <a href="#">Skripsi</a>
                </div>

            </div>
        </div>
    </div>
@endsection
