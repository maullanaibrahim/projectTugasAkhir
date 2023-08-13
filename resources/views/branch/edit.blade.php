@extends('layouts.third')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-pencil-square me-2"></i>{{ $title }}</h5>

                                <!-- Showing form input new branch -->
                                <form class="row g-3 mb-3" action="/branches/{{ $branch->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="text" class="form-control text-uppercase" name="cost_id" id="cost_id" value="{{ $cost->id }}" required hidden>

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

                                    <!-- Pilih Regional -->
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('regional') is-invalid @enderror" name="regional" id="regional">
                                                <option selected disabled>Pilih Regional..</option>
                                                @for($i=0; $i < count($regionals); $i++){
                                                    @if(old('regional', $branch->regional) == $regionals[$i])
                                                    <option selected value="{{ $regionals[$i] }}">{{ $regionals[$i] }}</option>
                                                    @else
                                                    <option value="{{ $regionals[$i] }}">{{ $regionals[$i] }}</option>
                                                    @endif
                                                }@endfor
                                            </select>
                                            <label for="regional">Regional</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('regional')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pilih Area -->
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('area') is-invalid @enderror" name="area" id="area">
                                                <option selected disabled>Pilih Area..</option>
                                                @for($i=0; $i < count($areas); $i++){
                                                    @if(old('area', $branch->area) == $areas[$i])
                                                    <option selected value="{{ $areas[$i] }}">{{ $areas[$i] }}</option>
                                                    @else
                                                    <option value="{{ $areas[$i] }}">{{ $areas[$i] }}</option>
                                                    @endif
                                                }@endfor
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

                                    <!-- Pilih Status -->
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                                <option selected disabled>Pilih Status..</option>
                                                @for($i=0; $i < count($statuses); $i++){
                                                    @if(old('status', $branch->status) == $statuses[$i])
                                                    <option selected value="{{ $statuses[$i] }}">{{ strtoupper($statuses[$i]) }}</option>
                                                    @else
                                                    <option value="{{ $statuses[$i] }}">{{ strtoupper($statuses[$i]) }}</option>
                                                    @endif
                                                }@endfor
                                            </select>
                                            <label for="status">Status</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('branch_address') is-invalid @enderror" name="branch_address" id="alamatCabang" placeholder="Alamat Cabang" style="height: 100px;">{{ old('branch_address', $branch->branch_address) }} </textarea>
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
                                        <p class="border-bottom mt-2 mb-0"></p>
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