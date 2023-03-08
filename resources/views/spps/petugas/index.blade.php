@extends('layouts.app')
@section('content')
    <div class="card-body">
        @if (Session::get('success'))
            <div class="alert alert-success mt-2 mb-2" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger mt-2 mb-2" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="button-tambah mt-3 mb-3 ml-3">
            <button class="btn btn-success modalbutton" data-toggle="modal" data-target="#petugasmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</button>
        </div>
    </div>
    <div class="table">
        <table class="table table-hover" id="data">
            <thead>
                <tr>
                    <td>No</td>
                    <td>username</td>
                    <td>email</td>
                    <td>nama petugas</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @forelse ($petugases as $petugas)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $petugas->username }}</td>
                        <td>{{ $petugas->email }}</td>
                        <td>{{ $petugas->nama_petugas }}</td>
                        <td>
                            <form onsubmit="return confirm('yakin hapus {{ $petugas->username }}')" action="{{ route('petugas.destroy',$petugas->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('petugas.edit',$petugas->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="colo:white" class="bg-danger text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="petugasmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah data kelas</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <form action="{{ route('petugas.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text"  name="username" id="username" class="form-control @error('username') invalid @enderror">
                                @error('username')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email"  name="email" id="email" class="form-control @error('email') invalid @enderror">
                                @error('email')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password"  name="password" id="password" class="form-control @error('password') invalid @enderror">
                                @error('password')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_petugas">nama petugas</label>
                                <input type="text"  name="nama_petugas" id="nama_petugas" class="form-control @error('nama_petugas') invalid @enderror">
                                @error('nama_petugas')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });
    </script>
@endsection
