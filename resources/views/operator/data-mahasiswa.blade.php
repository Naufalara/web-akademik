@extends('layouts.app')

@section('content')
    <div class="container py-1">
        <div class="row d-flex dashboard">

            <div class="">
                <div class="card overflow-hidden">
                    <div class="card-body">

                        <a href="/dashboard/operator" class="btn btn-danger">Back</a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Upload Excel
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addaccount">Input data Mahasiswa</button>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th>Dosen Wali</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th>Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($User as $User)
                                    <tr>
                                        <th>{{ $User->id }}</th>
                                        <th>{{ $User->nip }}</th>
                                        <td>{{ $User->name }}</td>
                                        <td>{{ $User->email }}</td>
                                        <td>{{ $User->password }}</td>
                                        <td>{{ $User->role }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#ResetPassword"> Reset
                                                Password</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="uploadForm" action="{{ route('import-data-mahasiswa') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ResetPassword" tabindex="-1" aria-labelledby="ResetPassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ResetPassword">Reset Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/data-mahasiswa/reset/{id}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Are you sure want to reset password?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addaccount" tabindex="-1" aria-labelledby="addaccount" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addaccount">Add Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAccountForm" action="{{ route('addaccount-data-mahasiswa') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label>NIM</label>
                        <input type="text" class="form-control" value="{{ old('id') }}" id="id"
                            name="id">
                        @error('id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label>NIP Dosen Wali</label>
                        <input type="text" class="form-control" value="{{ old('nip') }}" id="nip"
                            name="nip">
                        @error('nip')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name"
                            name="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label>email</label>
                        <input type="text" class="form-control" value="{{ old('email') }}" id="email"
                            name="email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label>Angkatan</label>
                        <input type="text" class="form-control" value="{{ old('angkatan') }}" id="angkatan"
                            name="angkatan">
                        @error('angkatan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label>Status</label>
                        <input type="text" class="form-control" value="Aktif" disabled id="status"
                            name="status">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitForm">Add Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script to handle form submission using AJAX -->
    <script>
        // Prevent the default form submission behavior
        $("#addAccountForm").submit(function(e) {
            e.preventDefault();

            // Perform an Ajax request to submit the form data
            $.ajax({
                url: "{{ route('addaccount-data-mahasiswa') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    // Handle the response from the server
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the Ajax request
                }
            });
        });
    </script>
@endsection
