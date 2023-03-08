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
        @if (Session::get('nominale'))
            <div class="alert alert-danger mt-2 mb-2" role="alert">
                {{ Session::get('nominale') }}
            </div>
        @endif

        <div class="button-tambah mt-3 mb-3 ml-3">
            <button class="btn btn-success modalbutton" data-toggle="modal" data-target="#sppmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</button>
        </div>
    </div>
    <div class="table">
        <table class="table table-hover" id="data">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nominal</td>
                    <td>Tahun</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @forelse ($spps as $spp)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $spp->nominal }}</td>
                        <td>{{ substr($spp->tahun, 0, 4) }} - {{ substr($spp->tahun, -4, 4) }}</td>
                        <td>
                            <form onsubmit="return confirm('yakin hapus {{ substr($spp->tahun,0,4) }}')" action="{{ route('spp.destroy', $spp->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('spp.edit', $spp->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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
    <div id="sppmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Tambah Data spp</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <form action="{{ route('spp.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tahun">tahun</label>
                                <input type="number" maxlength="11" name="tahun" id="tahun" class="form-control @error('tahun') invalid @enderror">
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
                                <input type="number" maxlength="11" name="nominal" id="nominal" class="form-control @error('nominal') invalid @enderror">
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
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#data').DataTable();
        });
    </script>
@endsection
