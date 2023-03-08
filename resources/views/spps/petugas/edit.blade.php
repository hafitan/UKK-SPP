@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="form">
            <h3>Edit petugas</h3>
            <a href="{{ route('petugas.index') }}" class="btn btn-primary">Back</a>
            @if (Session::get('error'))
                <div class="alert alert-danger mt-2 mb-2" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('petugas.update', $petugas->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text"  name="username" id="username" value="{{ old('username', $petugas->username) }}" class="form-control @error('username') invalid @enderror">
                    @error('username')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email"  name="email" id="email" value="{{ old('email', $petugas->email) }}" class="form-control @error('email') invalid @enderror">
                    @error('email')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password"  name="password" id="password" value="{{ old('password', $petugas->password) }}" class="form-control @error('password') invalid @enderror">
                    @error('password')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_petugas">nama petugas</label>
                    <input type="text"  name="nama_petugas" id="nama_petugas" value="{{ old('nama_petugas', $petugas->nama_petugas) }}" class="form-control @error('nama_petugas') invalid @enderror">
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
@endsection
