@extends('layouts.app')
@section('content')
    @if(auth()->user()->level == 'siswa')
        <h3>Halaman History Siswa</h3>
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
            <div class="table mt-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">Bulan dibayar</th>
                            <th scope="col">Tahun dibayar</th>
                            <th scope="col">Spp</th>
                            <th scope="col">Jumlah Bayar</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    <tbody>
                        @forelse ($pembayarans as $pembayaran)
                        {{-- @dd($pembayaran) --}}
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $pembayaran->nama_petugas }}</td>
                                <td>{{ $pembayaran->bulan_dibayar }}</td>
                                <td>{{ $pembayaran->tahun_dibayar }}</td>
                                <td>{{ substr($pembayaran->tahun,0,4) }} - {{ substr($pembayaran->tahun,-4,4) }}</td>
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
        </div>
    @endif
    @if (auth()->user()->level !== 'siswa')
        <h3>halaman history</h3>
        <div class="table">
            <table class="table table-hover">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Petugas</th>
                    <th scope="col">Nisn</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Bulan dibayar</th>
                    <th scope="col">Tahun dibayar</th>
                    <th scope="col">Spp</th>
                    <th scope="col">Jumlah Bayar</th>
                    <th scope="col">Action</th>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($pembayarans as $history)
                        <tr>
                            <td scope="col">{{++$i}}</td>
                            <td>{{ $history->nama_petugas }}</td>
                            <td>{{ $history->nisn }}</td>
                            <td>{{ $history->nama }}</td>
                            <td>{{ $history->tanggal_bayar }}</td>
                            <td>{{ $history->bulan_dibayar }}</td>
                            <td>{{ $history->tahun_dibayar }}</td>
                            <td>{{ substr($history->tahun,0,4) }} - {{ substr($history->tahun,-4,4) }}</td>
                            <td>{{ number_format($history->jumlah_bayar) }}</td>
                            <td scope="col">
                                    <a href="{{route('pembayaran.show',$history->nisn)}}" class="btn btn-primary">
                                        {{-- Lihat <i class="fa fa-street-view" aria-hidden="true"></i> --}}
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="color: whitesmoke" class="bg-danger text-bold text-center">Belum terdapat data apapaun <i class="fas fa-sad-cry"></i></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
@endsection
