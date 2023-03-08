@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="form">
            <h3>Edit kelas</h3>
            <a href="{{ route('kelas.index') }}" class="btn btn-primary">Back</a>
            @if (Session::get('error'))
                <div class="alert alert-danger mt-2 mb-2" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('kelas.update', $kelas->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nama_kelas">nama kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" class="form-control @error('nama_kelas') invalid @enderror">
                    @error('nama_kelas')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror

                    @if (Session::get('error'))
                    <div class="error p-2" style="color: red">
                        {{Session::get('error')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="kompetensi_keahlian">kompetensi_keahlian</label>
                    <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" value="{{ old('kompetensi_keahlian', $kelas->kompetensi_keahlian) }}" class="form-control @error('kompetensi_keahlian') invalid @enderror">
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
@endsection
