@extends('layouts.app')
@section('content')
    <div class="card p-4">
        <div class="card-body">
            @if (Session::get('tjumlah_bayar'))
                <div class="alert alert-danger mt-2 mb-2" role="alert">
                    {{Session::get('tjumlah_bayar')}}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger mt-2 mb-2" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif

            <h3>Pembayaran SPP</h3>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-primary mt-2">Back</a>
            <div class="form p-2">
                <form action="{{ route('pembayaran.store') }}" method="post" class="mt-3">
                    @csrf
                    @if ($siswas->count() == 0)
                        <div class="form-group">
                            <input type="text" class="form-control bg-danger text-white" value="Tidak ada siswa yang terdaftar">
                        </div>
                    @else
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <select name="nisn" class="form-control" id="nisn" style="width: 100%">
                                <option disabled selected>-- Pilih Siswa --</option>
                                @foreach ($siswas as $siswa)
                                <option value="{{$siswa->nisn}}">{{ $siswa->nisn }} - {{$siswa->nama}}</option>
                                @endforeach
                            </select>
                            @error('nisn')
                            <div class="error p-2" style="color: red">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="berapa">Bayar Berapa Bulan</label>
                        <select name="bayar_berapa" id="berapa" class="form-control">
                            <option value="1">1 Bulan</option>
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="4">4 Bulan</option>
                            <option value="5">5 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="7">7 Bulan</option>
                            <option value="8">8 Bulan</option>
                            <option value="9">9 Bulan</option>
                            <option value="10">10 Bulan</option>
                            <option value="11">11 Bulan</option>
                            <option value="12">12 Bulan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="spp">spp</label>
                        <input type="text" id="spp" class="form-control" readonly placeholder="nominal spp">
                    </div>
                    <div class="form-group">
                        <label for="nominal">nominal bayar</label>
                        <input type="text" id="nominal" class="form-control" readonly placeholder="nominal rupiah">
                    </div>
                    <div class="form-group d-none" id="akhir">
                        <label for="waktuTerakhir">waktu terakhir bayar</label>
                        <input type="text" id="waktuTerakhir" class="form-control" readonly placeholder="waktu terakhir bayar">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar">jumlah bayar</label>
                        <input type="number" min="20000" maxlength="11" class="form-control @error('jumlah_bayar') invalid @enderror" name="jumlah_bayar" id="jumlah_bayar" placeholder="Masukan jumlah_bayar spp" required>
                        @error('jumlah_bayar')
                        <div class="error p-2" style="color: red">
                            {{$message}}
                        </div>
                        @enderror
                        @if (Session::get('tjumlah_bayar'))
                            <div class="error p-2" style="color: red">
                                {{Session::get('tnominal')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group d-none" id="kem">
                        <label for="kemabalian">kembalian</label>
                        <input type="text" id="kembalian" class="form-control" readonly name="kembalian">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" id="buttonSubmit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#nisn').select2();
        });
    </script>

    <script>
        $('#nisn').on('change', function(){
            var nisn = $('#nisn').val();
            var berapa = $('#berapa').val();
            $('#akhir').removeClass('d-none');
            $('#kem').removeClass('d-none');
            $.ajax({
                url: "{{url('pembayaran/getData/')}}" + "/" + nisn + "/" + berapa,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#spp').val(data['nominal']);
                    $('#waktuTerakhir').val(data['bulan']);
                    // if(data['bulan'] == "sudah lunas"){
                    //     var waktu = data['bulan'] + " " + data["tahun"];
                    //     $('#spp').val(data['nominal']);
                    //     $('#waktuTerakhir').val(waktu);

                    //     $('#jumlah_bayar').prop('readonly','true');
                    //     $('#buttonSubmit').prop('disabled','true');
                    // }else{
                    //     var waktu = data['bulan'] + " " + data["tahun"];
                    //     $('#spp').val(data['nominal']);
                    //     $('#waktuTerakhir').val(waktu);

                    //     $('#jumlah_bayar').prop('min',data['nominal']);

                    //     $('#jumlah_bayar').removeAttr('readonly','true');
                    //     $('#buttonSubmit').removeAttr('disabled', 'true');
                    // }
                }
            });

            $('#berapa').on('change', function () {
                var spp = $('#spp').val();
                var bayar = $(this).val();
                var total = spp * bayar;
                $('#nominal').val(total);

            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#nominal, #jumlah_bayar").keyup(function () {
                var nominal = $('#nominal').val();
                var jumlah_bayar = $('#jumlah_bayar').val();
                var total = parseInt(jumlah_bayar) - parseInt(nominal);
                $('#kembalian').val(total);
            });
        })
    </script>

    <script>
        $('#jumlah_bayar').keyup(function(){
            var sanitized = $(this).val().replace(/[^0-9]/g, '');

            $(this).val(sanitized);
        });
    </script>
@endsection
