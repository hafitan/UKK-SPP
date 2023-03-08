@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="form">
            <h3>Edit siswa</h3>
            <a href="{{ route('siswa.index') }}" class="btn btn-primary">Back</a>
            @if (Session::get('error'))
                <div class="alert alert-danger mt-2 mb-2" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('siswa.update', $siswa->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nisn">nisn</label>
                    <input type="number" maxlength="11" value="{{ old('nisn', $siswa->nisn) }}"  name="nisn" id="nisn" class="form-control @error('nisn') invalid @enderror">
                    @error('nisn')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nis">nis</label>
                    <input type="number" maxlength="11" value="{{ old('nis', $siswa->nis) }}" name="nis" id="nis" class="form-control @error('nis') invalid @enderror">
                    @error('nis')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">nama</label>
                    <input type="text"  name="nama" id="nama" value="{{ old('nama', $siswa->nama) }}" class="form-control @error('nama') invalid @enderror">
                    @error('nama')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_kelas">kelas</label>
                    <select class="form-control" name="id_kelas" id="id_kelas">
                        <option value="">--pilih--</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}" @if($siswa->kelas->id == $kelas->id)selected @endif>{{ $kelas->nama_kelas }}</option>
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
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="masukkan alamat">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="no_telp">no hp</label>
                    <input type="number" maxlength="11" value="{{ old('no_telp', $siswa->no_telp) }}"  name="no_telp" id="no_telp" class="form-control @error('no_telp') invalid @enderror">
                    @error('no_telp')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_spp">spp</label>
                    <select class="form-control" name="id_spp" id="id_spp">
                        <option value="">--pilih--</option>
                        @foreach ($spps as $spp)
                            <option value="{{ $spp->id }}" @if($siswa->spp->tahun == $spp->tahun)selected @endif>{{ substr($spp->tahun,0,4) }} - {{ substr($spp->tahun,-4,4) }}</option>
                        @endforeach
                    </select>
                    @error('id_spp')
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
@endsection
