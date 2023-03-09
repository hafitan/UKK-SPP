@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="form">
            <form action="{{ route('spp.update', $spp->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="tahun">tahun</label>
                    <input type="number" maxlength="11" name="tahun" id="tahun" value="{{ old('tahun', substr($spp->tahun, 0 ,4)) }}" class="form-control @error('tahun') invalid @enderror">
                    @error('tahun')
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
                    <label for="nominal">Nominal</label>
                    <input type="number" maxlength="11" name="nominal" id="nominal" value="{{ old('nominal', $spp->nominal) }}" class="form-control @error('nominal') invalid @enderror">
                    @error('nominal')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                    @enderror

                    @if (Session::get('nominale'))
                    <div class="error p-2" style="color: red">
                        {{Session::get('nominale')}}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
