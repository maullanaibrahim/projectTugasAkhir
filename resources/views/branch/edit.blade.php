@extends('layouts.third')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">{{ $title }}</h5>

                                <!-- Showing form input new branch -->
                                <form class="row g-3 mb-3" action="/branches/{{ $branch->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('branch_code') is-invalid @enderror" name="branch_code" id="kodeCabang" placeholder="Kode Cabang" value="{{ old('branch_code', $branch->branch_code) }}" required>
                                            <label for="kodeCabang">Kode Cabang</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('branch_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('branch_name') is-invalid @enderror" name="branch_name" id="namaCabang" placeholder="Nama Cabang" value="{{ old('branch_name', $branch->branch_name) }}" required>
                                            <label for="namaCabang">Nama Cabang</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('branch_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('regional') is-invalid @enderror" name="regional" id="regional" placeholder="Regional" value="{{ old('regional', $branch->regional) }}" required>
                                            <label for="regional">Regional</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('regional')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('area') is-invalid @enderror" name="area" id="area" value="{{ old('area') }}" aria-label="State">
                                                <option selected disabled>Pilih Area..</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <label for="area">Area</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('area')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('branch_address') is-invalid @enderror" name="branch_address" id="alamatCabang" placeholder="Alamat Cabang" style="height: 100px;">{{ old('branch_address') }} </textarea>
                                            <label for="alamatCabang">Alamat Cabang</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('branch_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                        <a href="/branches"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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