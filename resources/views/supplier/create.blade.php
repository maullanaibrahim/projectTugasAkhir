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

                                <!-- Showing form input new supplier -->
                                <form class="row g-3 mb-3" action="/suppliers" method="POST">
                                    @csrf
                                    <div class="col-md-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light" name="supplier_code" id="kodeSupplier" value="S{{ $count }}" readonly>
                                            <label for="namaSupplier">Kode</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('supplier_name') is-invalid @enderror" name="supplier_name" id="namaSupplier" placeholder="Nama Supplier" value="{{ old('supplier_name') }}" required>
                                            <label for="namaSupplier">Nama Supplier</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('supplier_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('supplier_pic') is-invalid @enderror" name="supplier_pic" id="picSupplier" placeholder="PIC" value="{{ old('supplier_pic') }}" required>
                                            <label for="picSupplier">PIC</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('supplier_pic')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('supplier_contact') is-invalid @enderror" name="supplier_contact" id="kontak" placeholder="Kontak" value="{{ old('supplier_contact') }}" required>
                                            <label for="kontak">Kontak</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('supplier_contact')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select" name="term" id="top">
                                                <option selected disabled>Pilih Termin..</option>
                                                <option value="TUNAI">TUNAI</option>
                                                <option value="14 HARI">14 HARI</option>
                                                <option value="21 HARI">21 HARI</option>
                                                <option value="30 HARI">30 HARI</option>
                                            </select>
                                            <label for="top">TOP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select" name="tax" id="pkp">
                                                <option selected disabled>Pilih PPN..</option>
                                                <option value="PPN">PPN</option>
                                                <option value="NON PPN">NON PPN</option>
                                            </select>
                                            <label for="pkp">PPN</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('supplier_address') is-invalid @enderror" placeholder="Alamat Supplier" name="supplier_address" id="alamatSupplier" style="height: 100px;" required>{{ old('supplier_address') }}</textarea>
                                            <label for="alamatSupplier">Alamat Supplier</label>
                                            
                                            <!-- Showing notification error for input validation -->
                                            @error('supplier_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                        <a href="/suppliers"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    </div>
                                </form><!-- End floating Labels Form -->
                            </div> <!-- End Card Body -->
                        </div><!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection