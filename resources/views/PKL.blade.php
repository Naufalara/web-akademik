<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Laravel') }} </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @auth
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        Web Sistem Informasi Akademik
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </nav>
            @endif
            <main class="py-4">
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
                            <div>
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Belum Ambil</option>
                                    <option value="2">Sedang Ambil</option>
                                    <option value="3">Lulus</option>
                                </select>
                            </div>
                            <div>
                                <label>Nilai</label>
                                <input type="text" class="form-control" value="">
                            </div>
                            <div>
                                <label>Scan berita acara seminar PKL</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bukti_irs" name="bukti_irs">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-danger" href="/dashboard/mahasiswa">
                                    <span>Back</span></a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script>
            $(document).ready(function() {
                var nilaiInput = $('#nilai');

                function updateNilaiInputStatus() {
                    var selectedStatus = $('#status').val();
                    if (selectedStatus === '1' || selectedStatus === '2') {
                        nilaiInput.val(''); // Set nilai ke kosong jika status belum ambil atau sedang ambil
                        nilaiInput.prop('disabled', true); // Nonaktifkan input nilai
                    } else if (selectedStatus === '3') {
                        nilaiInput.prop('disabled', false); // Aktifkan kembali input nilai jika status lulus
                    }
                }

                // Panggil fungsi saat halaman dimuat dan ketika status berubah
                updateNilaiInputStatus();
                $('#status').change(updateNilaiInputStatus);
            });
        </script>
    </body>

    </html>
