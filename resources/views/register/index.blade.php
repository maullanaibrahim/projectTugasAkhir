@extends('layouts.default')
@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="container">
                <!-- Showing Notification Register Succeded -->
                @if(session()->has('success'))
                <div class="alert alert-light alert-dismissible fade show w-auto position-fixed end-0 text-success" style="margin-right:30px;" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="col-lg-3 position-absolute d-block end-0 me-3">
                    <!-- Showing Error Input firstname -->
                    <div class="@error('first_name') is-invalid @enderror"></div>
                    @error('first_name')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert1" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <!-- Showing Error Input lastname -->
                    <div class="@error('last_name') is-invalid @enderror"></div>
                    @error('last_name')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    
                    <!-- Showing Error Input email -->
                    <div class="@error('nik') is-invalid @enderror"></div>
                    @error('nik')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <!-- Showing Error Input password -->
                    <div class="@error('password') is-invalid @enderror"></div>
                    @error('password')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <!-- Showing Error Input position -->
                    <div class="@error('position') is-invalid @enderror"></div>
                    @error('position')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert5" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <!-- Showing Error Input division -->
                    <div class="@error('division') is-invalid @enderror"></div>
                    @error('division')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert6" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
                <!-- Content -->
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="justify-content-center pb-2">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="dist/img/logo/logo2.png" alt="">
                            </a>
                        </div><!-- End Logo -->
                        
                        <div class="card mb-3 py-1 px-4">
                            <div class="card-body">
                                <!-- Register Title -->
                                <div class="pb-3">
                                    <h5 class="card-title text-primary text-center pb-0 fs-4 fw-bold">Form Registrasi</h5>
                                    <p class="text-center small px-2">Silakan lengkapi data dengan benar dan sesuai.</p>
                                </div> <!-- End Register Title -->

                                <form class="row g-3" action="/register" method="post">
                                    @csrf
                                    <!-- Input First Name -->
                                    <div class="col-6">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <input type="text" name="first_name" class="form-control text-capitalize d-inline rounded-0" id="first_name" placeholder="Nama Depan" value="{{ old('first_name') }}" required>
                                    </div> <!-- End Input First Name -->

                                    <!-- Input Last Name -->
                                    <div class="col-6">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <input type="text" name="last_name" class="form-control text-capitalize d-inline rounded-0" id="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}">
                                    </div> <!-- End Input Last Name -->

                                    <!-- Input Email -->
                                    <div class="col-12">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <input type="number" name="nik" class="form-control d-inline rounded-0" id="nik" placeholder="No. Induk Karyawan" value="{{ old('nik') }}" required>
                                    </div> <!-- End Input Email -->

                                    <!-- Input Password -->
                                    <div class="col-12">
                                        <span class="border border-3 border-primary d-inline py-2"></span>
                                        <input type="password" name="password" class="form-control d-inline rounded-0 mb-2" id="password" placeholder="Kata Sandi" required>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" onclick="myFunction()">
                                            <label class="form-check-label" for="inlineCheckbox1">Tampilkan Kata Sandi</label>
                                        </div>
                                    </div> <!-- End Input Password -->

                                    <!-- Input Jabatan -->
                                    <div class="col-12">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <select class="form-select d-inline rounded-0" name="position_id" id="position_id" required>
                                            <option selected disabled>Jabatan</option>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ ucwords($position->position_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- End Input Jabatan -->

                                    <!-- Input Jabatan Hidden -->
                                    <div class="col-12" hidden>
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <select class="form-select d-inline rounded-0" name="position_name" id="position_name" required>
                                            <option selected disabled>Jabatan</option>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->position_name }}">{{ ucwords($position->position_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- End Input Jabatan -->

                                    <!-- Input Divisi -->
                                    <div class="col-12 pb-2">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <select class="form-select d-inline rounded-0" name="division_id" id="division_id" required>
                                            <option selected disabled>Divisi</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{ ucwords($division->division_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- End Input Divisi -->

                                    <!-- Register Button -->
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 rounded-5" id="btnRegister" type="submit"><i class="bi bi-save2 me-2"></i>Simpan</button>
                                    </div> <!-- End Register Button -->

                                    <div class="col-12">
                                        <p class="small mb-0 text-center"><a href="/users"><i class="bi bi-box-arrow-in-left me-2"></i>Kembali </a></p>
                                    </div>
                                </form><!-- End Register Form -->
                            </div> <!-- End card-body -->
                        </div> <!-- End card mb-3 p-4 -->

                        <!-- Copyright Footer -->
                        <div class="credits mt-2">
                            Copyright &copy; 2023 <a href="#">Maulana Ibrahim</a>
                        </div>
                    </div>
                </div> <!-- End Content -->
            </div> <!-- End Container -->
        </section>
    </div> <!-- End Container -->
@endsection