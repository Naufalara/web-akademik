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
                    <label>Semester</label>
                    <select name="semester" class="form-control">
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                        <option value="9">Semester 9</option>
                        <option value="10">Semester 10</option>
                        <option value="11">Semester 11</option>
                        <option value="12">Semester 12</option>
                        <option value="13">Semester 13</option>
                        <option value="14">Semester 14</option>
                    </select>
                </div>
                <div>
                    <label>Jumlah SKS Semester</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div>
                    <label>Jumlah SKS Kumulatif</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div>
                    <label>IP Semester</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div>
                    <label>IP Kumulatif</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div>
                    <label>Scan KHS</label>
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
@endsection
