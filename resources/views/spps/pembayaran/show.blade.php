@extends('layouts.app')
@section('content')

    <div class="card-header text-center">
        <i>SPP SMK 1 BOGOR</i>
    </div>
    <div class="card-body">
        <div class="div float-right">
            {{-- @dd($info) --}}
            {{ $data->created_at->format('Y M d') }}
        </div>
        <div class="div">
            NISN : {{ $siswa->nisn }}
        </div>
        <div class="div">
            NIS : {{ $siswa->nis }}
        </div>
        <div class="div">
            Nama : {{ $siswa->nama }}
        </div>
        <div class="div">
            Kelas : {{ $kelas->nama_kelas }}
        </div>
        <div class="div">
            Petugas : {{ $data->petugas->nama_petugas }}
        </div>
        <div class="table mt-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Bulan dibayar</th>
                        <th scope="col">Tahun dibayar</th>
                        <th scope="col">Nominal</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($info as $pembayaran)
                    {{-- @dd($pembayaran) --}}
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $pembayaran->bulan_dibayar }}</td>
                            <td>{{ $pembayaran->tahun_dibayar }}</td>
                            <td>{{ $pembayaran->jumlah_bayar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="color:white" class="bg-danger text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="ml-15">
                total : {{ $total }}
        </div>
        {{-- <div class="div mt-2">
            <a href="{{ route('pembayaran.index') }}" class="btn btn-primary">Back</a>
        </div> --}}
        <div class="card-footer text-center">
            <i>SPP SMK 1 BOGOR</i>
        </div>
    </div>
    <script>
        window.print()
    </script>
@endsection
