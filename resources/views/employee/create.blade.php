@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-people me-2">+</i>{{ $title }}</h5>

                                <!-- Showing form input new employee -->
                                <form class="row g-3 mb-3" action="/employees" method="POST">
                                    @csrf
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="NIK" value="{{ old('nik') }}" required>
                                            <label for="nik">NIK</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase @error('employee_name') is-invalid @enderror" name="employee_name" id="employee_name" placeholder="Nama Karyawan" value="{{ old('employee_name') }}" required>
                                            <label for="employee_name">Nama Karyawan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('employee_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('position_id') is-invalid @enderror" name="position_id" id="employee_position" value="{{ old('position_id') }}">
                                                <option selected disabled>Pilih Jabatan..</option>
                                                @foreach($positions as $position)
                                                    @if(old('position_id') == $position->id)
                                                    <option selected value="{{ $position->id }}">{{ strtoupper($position->position_name) }}</option>
                                                    @else
                                                    <option value="{{ $position->id }}">{{ strtoupper($position->position_name) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="jabatan">Jabatan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('position_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('cost_id') is-invalid @enderror" name="cost_id" id="employee_location" value="{{ old('cost_id') }}">
                                                <option selected disabled>Pilih Cabang / Divisi..</option>
                                                @foreach($costs as $cost)
                                                    @if(old('cost_id') == $cost->id)
                                                    <option selected value="{{ $cost->id }}">{{ strtoupper($cost->cost_name) }}</option>
                                                    @else
                                                    <option value="{{ $cost->id }}">{{ strtoupper($cost->cost_name) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="cost">Cabang / Divisi</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('cost_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase" name="company" id="company" value="pt. konohagakure" required>
                                            <label for="perusahaan">Perusahaan</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="border-bottom mt-2 mb-0"></p>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                        <a href="/employees"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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
