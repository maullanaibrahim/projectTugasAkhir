@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                            <h5 class="card-title border-bottom mb-3"><i class="bi bi-diagram-3 me-2">+</i>{{ $title }}</h5>

                                <form class="row g-3 mb-3" action="/divisions" method="POST">
                                    @csrf
                                    <!-- Input Kode Divisi -->
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('division_code') is-invalid @enderror" name="division_code" id="division_code" placeholder="Nama Divisi" value="{{ old('division_code') }}" required>
                                            <label for="kodeDivisi">Kode Divisi</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('division_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Input Nama Divisi -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('division_name') is-invalid @enderror" name="division_name" id="namaDivisi" placeholder="Nama Divisi" value="{{ old('division_name') }}" required>
                                            <label for="namaDivisi">Nama Divisi</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('division_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pilih Lokasi Divisi -->
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('location') is-invalid @enderror" name="location" id="lokasi" aria-label="Lokasi">
                                                <option selected disabled>Pilih Lokasi..</option>
                                                @for($i=0; $i < count($locations); $i++){
                                                    @if(old('location') == $locations[$i])
                                                    <option selected value="{{ $locations[$i] }}">{{ strtoupper($locations[$i]) }}</option>
                                                    @else
                                                    <option value="{{ $locations[$i] }}">{{ strtoupper($locations[$i]) }}</option>
                                                    @endif
                                                }@endfor
                                            </select>
                                            <label for="lokasi">Lokasi</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('location')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Input Alamat Divisi -->
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('address') is-invalid @enderror" name="address" id="alamat" placeholder="Alamat" style="height: 100px;">{{ old('address') }} </textarea>
                                            <label for="alamat">Alamat</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('address')
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
                                        <a href="/divisions"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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
