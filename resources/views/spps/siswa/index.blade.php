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
            <button class="btn btn-success modalbutton" data-toggle="modal" data-target="#siswamodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</button>
        </div>
    </div>
    <div class="table">
        <table class="table table-hover" id="data">
            <thead>
                <tr>
                    <td>No</td>
                    <td>nisn</td>
                    <td>nis</td>
                    <td>nama</td>
                    <td>email</td>
                    <td>kelas</td>
                    <td>alamat</td>
                    <td>no hp</td>
                    <td>spp</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @forelse ($siswas as $siswa)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->email }}</td>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                        <td>{{ $siswa->alamat }}</td>
                        <td>{{ $siswa->no_telp }}</td>
                        <td>{{ substr($siswa->spp->tahun,0,4) }} - {{ substr($siswa->spp->tahun,-4,4) }}</td>
                        <td>
                            <form onsubmit="return confirm('yakin hapus {{ $siswa->nama }}')" action="{{ route('siswa.destroy',$siswa->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('siswa.edit',$siswa->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="colo:white" class="bg-danger text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="siswamodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
                        <form action="{{ route('siswa.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="number" name="nisn" maxlength="10" oninput="javascript: if(this.value.length > this.maxlength) this.value = this.valeu.slice(0, this.maxlength);" value="{{old('nisn')}}" id="nisn" class="form-control @error('nisn') invalid @enderror" placeholder="Masukan NISN" required >
                                @error('nisn')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" name="nis" maxlength="10" oninput="javascript: if(this.value.length > this.maxlength) this.value = this.valeu.slice(0, this.maxlength);" value="{{old('nis')}}" id="nis" class="form-control @error('nis') invalid @enderror" placeholder="Masukan NIS" required >
                                @error('nis')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" @error('nama') invalid @enderror" placeholder="Masukan nama" required >
                                @error('nama')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <select name="id_kelas" class="form-control" id="id_kelas">
                                <option value="">--pilih--</option>
                                    @foreach ($kelases as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No HP</label>
                                <input type="number" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" class="form-control" @error('no_telp') invalid @enderror" placeholder="Masukan no telpon" required>
                                @error('no_telp')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_spp">spp</label>
                                <select name="id_spp" class="form-control" id="id_spp">
                                    <option value="">--pilih--</option>
                                    @foreach ($spps as $spp)
                                    <option value="{{$spp->id}}">Spp tahun : {{substr($spp->tahun,0,4)}} - {{substr($spp->tahun,-4,4)}}</option>
                                    @endforeach
                                </select>

                                @error('id_spp')
                                    <div class="error p-2" style="color: red">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
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
