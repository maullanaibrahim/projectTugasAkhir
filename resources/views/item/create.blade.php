@extends('layouts.secondary')

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-boxes me-2">+</i>{{ $title }}</h5>

                                <!-- Showing form input new item -->
                                <form class="row g-3 mb-3" action="/items" method="POST">
                                    @csrf
                                    <div class="col-md-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="item_code" id="kodeItem" value="A{{ $count }}" readonly>
                                            <label for="kodeItem">Kode</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('item_name') is-invalid @enderror" name="item_name" id="namaItem" placeholder="Nama Item" value="{{ old('item_name') }}" required>
                                            <label for="namaItem">Nama Item</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('item_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">IDR</span>
                                            <div class="form-floating">
                                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Harga Item" value="{{ old('price') }}" required>
                                                <label for="harga">Harga</label>
                                            
                                                <!-- Showing notification error for input validation -->
                                                @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" id="discount" step=".01" value="{{ old('discount') }}" required>
                                                <label for="discount">Diskon</label>
                                                
                                                <!-- Showing notification error for input validation -->
                                                @error('discount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('unit') is-invalid @enderror" name="unit" id="satuan" required>
                                                <option selected disabled>Pilih Satuan..</option>
                                                @for($i=0; $i < count($units); $i++){
                                                    @if(old('unit') == $units[$i])
                                                    <option selected value="{{ $units[$i] }}">{{ $units[$i] }}</option>
                                                    @else
                                                    <option value="{{ $units[$i] }}">{{ $units[$i] }}</option>
                                                    @endif
                                                }@endfor
                                            </select>
                                            <label for="satuan">Satuan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('unit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id" id="supplier" required>
                                                <option selected disabled>Pilih Supplier..</option>
                                                @foreach($suppliers as $supplier)
                                                    @if(old('supplier_id') == $supplier->id)
                                                    <option selected class="text-uppercase" value="{{ $supplier->id }}">{{ strtoupper($supplier->supplier_name) }}</option>
                                                    @else
                                                    <option class="text-uppercase" value="{{ $supplier->id }}">{{ strtoupper($supplier->supplier_name) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="supplier">Supplier</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('supplier_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('item_type') is-invalid @enderror" name="item_type" id="jenisItem" required>
                                                <option selected disabled>Pilih Jenis Item..</option>
                                                @for($i=0; $i < count($types); $i++){
                                                    @if(old('item_type') == $types[$i])
                                                    <option selected value="{{ $types[$i] }}">{{ strtoupper($types[$i]) }}</option>
                                                    @else
                                                    <option value="{{ $types[$i] }}">{{ strtoupper($types[$i]) }}</option>
                                                    @endif
                                                }@endfor
                                            </select>
                                            <label for="jenisItem">Jenis Item</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('item_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p style="font-size:12px;margin-bottom:2px;">Gambar Item</p>
                                        <div class="col-sm-12">
                                            <input class="form-control @error('item_preview') is-invalid @enderror" type="file" accept="image/png, image/gif, image/jpeg" name="item_preview" id="formFile" value="{{ old('item_preview') }}">

                                            <!-- Showing notification error for input validation -->
                                            @error('item_preview')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="border-bottom mt-2 mb-0"></p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                        <a href="/items"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    </div>
                                </form><!-- End Input Form -->
                            </div> <!-- End Card Body -->
                        </div> <!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection