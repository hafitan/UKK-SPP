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
            {{-- <button class="btn btn-success modalbutton" data-toggle="modal" data-target="#sppmodal">Tambah</button> --}}
            <a href="{{ route('pembayaran.create') }}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah</a>
        </div>
    </div>
    <div class="table">
        <table class="table table-hover" id="data">
            <thead>
                <tr>
                    <td>No</td>
                    <td>petugas</td>
                    <td>nisn</td>
                    <td>nama</td>
                    <td>tanggal</td>
                    <td>bulan dibayar</td>
                    <td>tahun dibayar</td>
                    <td>spp</td>
                    <td>jumlah bayar</td>
                    <td>Action</td>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $pembayaran->nama_petugas }}</td>
                        <td>{{ $pembayaran->nisn }}</td>
                        <td>{{ $pembayaran->nama }}</td>
                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                        <td>{{ $pembayaran->bulan_dibayar }}</td>
                        <td>{{ $pembayaran->tahun_dibayar }}</td>
                        <td>{{ substr($pembayaran->tahun,0,4) }} - {{ substr($pembayaran->tahun,-4,4) }}</td>
                        <td>Rp.{{ number_format($pembayaran->jumlah_bayar) }}</td>
                        <td><span style="display:none">dibuat pada : {{ $pembayaran->created_at }}</span>
                            <a href="{{ route('pembayaran.show', $pembayaran->nisn) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            {{-- <form onsubmit="return confirm('')" action="" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form> --}}
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
    <div id="sppmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Pembayaran</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection
