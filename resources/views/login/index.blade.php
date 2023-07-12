@extends('layouts.default')
@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-2">
            <div class="container">
                <!-- Showing Notification Login Error -->
                @if(session()->has('loginError'))
                <div class="alert alert-light alert-dismissible fade show w-auto position-fixed end-0 text-danger" style="margin-right:30px;" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Content -->
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="dist/img/logo/logo2.png" alt="">
                            </a>
                        </div><!-- End Logo -->
                            
                        <div class="card mb-3 px-4 py-2">
                            <div class="card-body">
                                <!-- Login Title -->
                                <div class="pb-4">
                                    <h5 class="card-title text-primary text-center pb-0 fs-4 fw-bold">Form Login</h5>
                                    <p class="text-center small px-2">Masukkan Nomor Induk dan Kata Sandi akun anda untuk dapat masuk & mulai bekerja.</p>
                                </div>

                                <!-- Login Form -->
                                <form class="row g-3" action="/login" method="post">
                                    @csrf
                                    <!-- Input Email ID -->
                                    <div class="col-12">
                                        <div class="border border-3 border-primary d-inline py-2"></div>
                                        <input type="text" name="nik" class="form-control d-inline rounded-0" id="nik" placeholder="No. Induk Karyawan" required />
                                    </div> <!-- End Input Email ID -->

                                    <!-- Input Password -->
                                    <div class="col-12 pb-4">
                                        <span class="border border-3 border-primary d-inline py-2"></span>
                                        <input type="password" name="password" class="form-control d-inline rounded-0 mb-2" id="password" placeholder="Kata Sandi" required />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" onclick="myFunction()">
                                            <label class="form-check-label" for="inlineCheckbox1">Tampilkan Kata Sandi</label>
                                        </div>
                                    </div> <!-- End Input Password -->

                                    <!-- Login Button -->
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 rounded-5" type="submit">MASUK</button>
                                    </div> <!-- End Login Button -->
                                        
                                    <!-- Lupa Password -->
                                    <div class="col-12">
                                        <p class="small mb-0 text-center">Belum punya akun? Silakan <a href="#" onclick="return confirm('Silakan hubungi Administrator IT untuk Daftar Akun!')">Daftar</a></p>
                                    </div> <!-- End Lupa Password -->
                                </form> <!-- End Login Form -->
                            </div> <!-- End card-body -->
                        </div> <!-- End card mb-3 p-4 -->

                        <!-- Copyright Footer -->
                        <div class="credits mt-3">
                            Copyright &copy; 2023 <a href="#">Maulana Ibrahim</a>
                        </div>
                    </div>
                </div> <!-- End Content -->
            </div> <!-- End Container -->
        </section>
    </div> <!-- End Container -->
@endsection