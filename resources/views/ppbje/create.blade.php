@extends('layouts.secondary')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">{{ $title }}</h5>

                                <form class="row g-3 mb-3" action="/ppbje-store" method="POST">
                                    @csrf
                                    <!-- Form PPBJe -->
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $sendurl }}">
                                            <label for="sendUrl">Send URL</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="maker" id="maker" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}">
                                            <label for="pembuat">Pembuat PPBJe</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="maker_division" id="maker_division" value="{{ auth()->user()->division->division_name }}">
                                            <label for="divisi_pembuat">Divisi Pembuat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('ppbje_number') is-invalid @enderror" name="ppbje_number" id="noPpbje" placeholder="Nomor PPBJe" value="{{ old('ppbje_number') }}">
                                            <label for="noPpbje">Nomor PPBJe</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('ppbje_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="ppbje_type" id="jenisPpbje" value="{{ $ppbje_type }}">
                                            <label for="jenisPpbje">Jenis PPBJe</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('cost_id') is-invalid @enderror" name="cost_id" id="bebanBiaya">
                                                <option selected disabled>Pilih Beban Biaya..</option>
                                                @foreach($costs as $cost)
                                                <option value="{{ $cost->id }}">{{ strtoupper($cost->cost_name) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="bebanBiaya">Beban Biaya</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('cost_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="region" id="region" value="">
                                            <label for="regional">Regional</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('date_of_need') is-invalid @enderror" name="date_of_need" id="tglKebutuhan" value="">
                                            <label for="tglKebutuhan">Tgl Kebutuhan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('date_of_need')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('employee_id') is-invalid @enderror" name="employee_id" id="pemohonfake">
                                                <option selected disabled>Pilih Pemohon..</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ strtoupper($employee->employee_name) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="pemohon">Pemohon</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('employee_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="employee_position" id="jabatanPemohon" readonly>
                                            <label for="jabatanPemohon">Jabatan Pemohon</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light" name="employee_division" id="divisiPemohon" readonly>
                                            <label for="divisiPemohon">Divisi Pemohon</label>
                                        </div>
                                    </div>

                                    <!-- Form Detail PPBJe -->
                                    <div class="col-md-12">
                                        <table class="table table-bordered w-auto">
                                            <thead>
                                                <tr class="text-center">
                                                <th class="col-md-4">NAMA BARANG</th>
                                                <th class="col-md-1">QTY</th>
                                                <th class="col-md-1">SATUAN</th>
                                                <th class="col-md-2">HARGA</th>
                                                <th class="col-md-2" hidden>HARGA</th>
                                                <th class="col-md-2">DISKON</th>
                                                <th class="col-md-2">JUMLAH</th>
                                                <th class="col-md-2" hidden>JUMLAH</th>
                                                <th class="col-md-2">AKSI</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tBody">
                                                <tr>
                                                    <td>
                                                        <select class="form-select border-0 @error('item_id') is-invalid @enderror" name="item_id[]" id="item_id" required>
                                                            <option selected disabled>Pilih Nama Item..</option>
                                                            @foreach($items as $item)
                                                            <option value="{{ $item->id }}">{{ strtoupper($item->item_name) }}</option>
                                                            @endforeach
                                                        </select>

                                                        <!-- Showing notification error for input validation -->
                                                        @error('item_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity[]" id="qty" class="form-control border-0 text-center @error('quantity') is-invalid @enderror">

                                                        <!-- Showing notification error for input validation -->
                                                        @error('quantity')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <td><input type="text" name="unit[]" id="satuan" class="form-control border-0 text-center bg-light" readonly></td>
                                                    <td><input type="text" name="harga[]" id="price" class="form-control border-0 text-center bg-light" readonly></td>
                                                    <td hidden><input type="text" name="price[]" id="harga" class="form-control border-0 text-center bg-light"></td>
                                                    <td><input type="text" name="discount[]" id="diskon" class="form-control border-0 text-center bg-light" readonly></td>
                                                    <td><input type="text" name="jumlah[]" id="price_total" class="form-control border-0 text-center bg-light" readonly></td>
                                                    <td hidden><input type="text" name="price_total[]" id="jumlah" class="form-control border-0 text-center bg-light"></td>
                                                    <td><button type="button" name="add" id="add" class="btn btn-sm btn-success float-end">+</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('reason') is-invalid @enderror" placeholder="Alasan Permintaan" name="reason" id="alasan" style="height: 100px;">{{ old('reason') }}</textarea>
                                            <label for="alasan">Alasan Permintaan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('reason')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</button>
                                        <a href="{{ Request::is('ppbje-asset/create') ? '/ppbje-asset' : '/ppbje-nonAsset' }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    </div>
                                </form><!-- End floating Labels Form -->
                            </div> <!-- End Card Body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            // Beban Biaya Autocomplete
            $('#bebanBiaya').change(function(){
                var cost = $(this).val();
                var url = '{{ route("getCost", ":id") }}';
                url = url.replace(':id', cost);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            $('#region').val(response.region);
                        }
                    }
                });
            });
            
            // Pemohon Autocomplete
            $('#pemohonfake').change(function(){
                var employee = $(this).val();
                var url = '{{ route("getApplicant", ":id") }}';
                url = url.replace(':id', employee);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            $('#jabatanPemohon').val(response.employee_position);
                            $('#divisiPemohon').val(response.employee_location);
                        }
                    }
                });
            });

            // Barang Autocomplete
            $('#item_id').change(function(){
                var item = $(this).val();
                var url = '{{ route("getItem", ":id") }}';
                url = url.replace(':id', item);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            $('#harga').val(response.price);
                            $('#satuan').val(response.unit);
                            var harga0 = parseInt(response.price);
                            var reverse = harga0.toString().split('').reverse().join(''),
                                ribuan 	= reverse.match(/\d{1,3}/g);
                                harga1	= ribuan.join('.').split('').reverse().join('');
                            $('#price').val(harga1);
                            $('#harga').val(harga0);
                            $('#qty').change(function(){
                                var qty = $(this).val();
                                var harga = parseInt(response.price);
                                var jumlah0 = qty*harga;
                                var	reverse = jumlah0.toString().split('').reverse().join(''),
                                ribuan 	= reverse.match(/\d{1,3}/g);
                                jumlah1	= ribuan.join('.').split('').reverse().join('');
                                $('#total_price').val(jumlah1);
                                $('#jumlah').val(jumlah0);
                            });
                        }
                    }
                });
            });

            // Menambahkan Baris Input Baru
            var i = 0;
            $('#add').click(function(){
                ++i;
                $('#tBody').append(
                '<tr>'+
                    '<td>'+
                        '<select class="form-select border-0" name="item_id[]" id="item_id'+i+'">'+
                            '<option selected disabled>Pilih Nama Item..<\/option>'+
                            '@foreach($items as $item)'+
                            '<option value="{{ $item->id }}">{{ $item->item_name }}<\/option>'+
                            '@endforeach'+
                        '<\/select>'+
                    '<\/td>'+
                    '<td><input type="number" name="quantity[]" id="qty'+i+'" class="form-control border-0 text-center"></td>'+
                    '<td><input type="text" name="unit[]" id="satuan'+i+'" class="form-control border-0 text-center bg-light" readonly></td>'+
                    '<td><input type="text" name="harga[]" id="price'+i+'" class="form-control border-0 text-center bg-light" disabled></td>'+
                    '<td hidden><input type="text" name="price[]" id="harga'+i+'" class="form-control border-0 text-center bg-light"></td>'+
                    '<td><input type="text" name="discount[]" id="diskon'+i+'" class="form-control border-0 text-center bg-light" readonly></td>'+
                    '<td><input type="text" name="jumlah[]" id="total_price'+i+'" class="form-control border-0 text-center bg-light" disabled></td>'+
                    '<td hidden><input type="text" name="total_price[]" id="jumlah'+i+'" class="form-control border-0 text-center bg-light"></td>'+
                    '<td><button type="button" name="remove" id="remove" class="btn btn-sm btn-warning float-end remove-table-row">-</button></td>'+
                '</tr>'+
                // Barang Autocomplete untuk Baris Input Baru
                '<script>'+
                    '$("#item_id'+i+'").change(function(){'+
                        'var item = $(this).val();'+
                        'var url = "{{ route('getItem', ':id') }}";'+
                        'url = url.replace(":id", item);'+
                        '$.ajax({'+
                            'url: url,'+
                            'type: "get",'+
                            'dataType: "json",'+
                            'success: function(response){'+
                                'if(response != null){'+
                                    '$("#harga'+i+'").val(response.price);'+
                                    '$("#satuan'+i+'").val(response.unit);'+
                                    'var harga0 = parseInt(response.price);'+
                                    'var reverse = harga0.toString().split("").reverse().join(""),'+
                                    'ribuan 	= reverse.match('+/\d{1,3}/g+');'+
                                    'harga1	= ribuan.join(".").split("").reverse().join("");'+
                                    '$("#price'+i+'").val(harga1);'+
                                    '$("#harga'+i+'").val(harga0);'+
                                    '$("#qty'+i+'").change(function(){'+
                                        'var qty = $(this).val();'+
                                        'var harga = parseInt(response.price);'+
                                        'var jumlah0 = qty*harga;'+
                                        'var reverse = jumlah0.toString().split("").reverse().join(""),'+
                                        'ribuan 	= reverse.match('+/\d{1,3}/g+');'+
                                        'jumlah1	= ribuan.join(".").split("").reverse().join("");'+
                                        '$("#amount'+i+'").val(jumlah1);'+
                                        '$("#jumlah'+i+'").val(jumlah0);'+
                                    '});'+   
                                '}'+
                            '}'+
                        '});'+
                    '});'+
                '<\/script>'
                );
            });

            // Menambahkan Tombol Hapus Baris Input Baru
            $(document).on('click', '.remove-table-row', function(){
                $(this).parents('tr').remove();
            });
        });
    </script>
@endsection