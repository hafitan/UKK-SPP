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
            <button class="btn btn-success modalbutton" data-toggle="modal" data-target="#kelasmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</button>
        </div>
    </div>
    <div class="table">
        <table class="table table-hover" id="data">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama kelas</td>
                    <td>Kompetensi keahlian</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @forelse ($kelases as $kelas)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>{{ $kelas->kompetensi_keahlian }}</td>
                        <td>
                            <form onsubmit="return confirm('yakin hapus {{ $kelas->nama_kelas }}')" action="{{ route('kelas.destroy', $kelas->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="colo:white" class="bg-danger text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="kelasmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
                        <form action="{{ route('kelas.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kelas">nama kelas</label>
                                <input type="text"  name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') invalid @enderror">
                                @error('nama_kelas')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kompetensi_keahlian">kompetensi keahlian</label>
                                <input type="text"  name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') invalid @enderror">
                                @error('kompetensi_keahlian')
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
