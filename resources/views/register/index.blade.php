<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">

   <title>{{ $title }} - eProcurement</title>
   <meta content="" name="description">
   <meta content="" name="keywords">

   <!-- Favicons -->
   <link href="dist/img/favicon.ico" rel="icon">
   <link href="dist/img/favicon.ico" rel="apple-touch-icon">

   <!-- Google Fonts -->
   <link href="dist/css/google-fonts.css" rel="stylesheet">

   <!-- Vendor CSS Files -->
   <link href="dist/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="dist/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="dist/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="dist/vendor/quill/quill.snow.css" rel="stylesheet">
   <link href="dist/vendor/quill/quill.bubble.css" rel="stylesheet">
   <link href="dist/vendor/remixicon/remixicon.css" rel="stylesheet">
   <link href="dist/vendor/simple-datatables/style.css" rel="stylesheet">

   <!-- Template Main CSS File -->
   <link href="dist/css/style.css" rel="stylesheet">
   
   <script type="text/javascript">
        function zoom() {
            document.body.style.zoom = "90%" 
        }

        $(document).ready(function(){
            $("#btnRegister").click(function(){
                $("#alert1").fadeIn();
                $("#alert2").fadeIn("slow");
                $("#alert3").fadeIn(3000);
                $("#alert3").fadeIn(6000);
                $("#alert3").fadeIn(9000);
            });
        });
   </script>

   <!-- =======================================================
   * Template Name: NiceAdmin - v2.4.1
   * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
   * Author: BootstrapMade.com
   * License: https://bootstrapmade.com/license/
   ======================================================== -->
</head>
<body onload="zoom()">

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                @if(session()->has('success'))
                <div class="alert alert-light alert-dismissible fade show w-auto position-fixed end-0 text-success" style="margin-right:30px;" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="col-lg-3 position-absolute d-block end-0 me-3">

                    <div class="@error('first_name') is-invalid @enderror"></div>
                    @error('first_name')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert1" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    
                    <div class="@error('last_name') is-invalid @enderror"></div>
                    @error('last_name')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <div class="@error('email') is-invalid @enderror"></div>
                    @error('email')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <div class="@error('password') is-invalid @enderror"></div>
                    @error('password')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <div class="@error('position') is-invalid @enderror"></div>
                    @error('position')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert5" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                    <div class="@error('division') is-invalid @enderror"></div>
                    @error('division')
                    <div class="alert alert-light alert-dismissible fade show w-auto invalid-feedback text-danger end-0" id="alert6" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="justify-content-center pb-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="dist/img/logo/logo2.png" alt="">
                            </a>
                        </div><!-- End Logo -->
                        
                        <div class="card mb-3 py-1 px-4">
                            <div class="card-body">
                            <div class="pb-2">
                                <h5 class="card-title text-primary text-center pb-1 fs-4 fw-bold">Register Account</h5>
                                <p class="text-center small px-2">Silakan lengkapi data dengan benar dan sesuai.</p>
                            </div>

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
                                    <input type="text" name="last_name" class="form-control text-capitalize d-inline rounded-0" id="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                                </div> <!-- End Input Last Name -->

                                <!-- Input Email -->
                                <div class="col-12">
                                    <div class="border border-3 border-primary d-inline py-2"></div>
                                    <input type="email" name="email" class="form-control d-inline rounded-0" id="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                                </div> <!-- End Input Email -->

                                <!-- Input Password -->
                                <div class="col-12">
                                    <span class="border border-3 border-primary d-inline py-2"></span>
                                    <input type="password" name="password" class="form-control d-inline rounded-0" id="password" placeholder="Password" required>
                                </div> <!-- End Input Password -->

                                <!-- Input Jabatan -->
                                <div class="col-12">
                                    <div class="border border-3 border-primary d-inline py-2"></div>
                                    <select class="form-select d-inline rounded-0" name="position_id" id="position_id" required>
                                        <option selected disabled>Jabatan</option>
                                        @foreach($positions as $p)
                                        <option value="{{ $p->id }}">{{ ucwords($p->nama_jabatan) }}</option>
                                        @endforeach
                                    </select>
                                </div> <!-- End Input Jabatan -->

                                <!-- Input Divisi -->
                                <div class="col-12 pb-2">
                                    <div class="border border-3 border-primary d-inline py-2"></div>
                                    <select class="form-select d-inline rounded-0" name="division_id" id="division_id" required>
                                        <option selected disabled>Divisi</option>
                                        @foreach($divisions as $d)
                                        <option value="{{ $d->id }}">{{ ucwords($d->nama_divisi) }}</option>
                                        @endforeach
                                    </select>
                                </div> <!-- End Input Divisi -->

                                <!-- Register Button -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 rounded-5" id="btnRegister" type="submit">REGISTER</button>
                                </div> <!-- End Register Button -->

                                <!-- Lupa Password -->
                                <div class="col-12">
                                    <p class="small mb-0 text-center">Sudah punya akun? Silakan <a href="/">Masuk</a></p>
                                </div> <!-- End Lupa Password -->
                                
                            </form>

                            </div>
                        </div>

                        <div class="credits mt-3">
                            Copyright &copy; 2023 <a href="#">Maulana Ibrahim</a>
                        </div>
                        
                    </div>
                </div>
                </div>
            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="dist/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="dist/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/vendor/chart.js/chart.min.js"></script>
    <script src="dist/vendor/echarts/echarts.min.js"></script>
    <script src="dist/vendor/quill/quill.min.js"></script>
    <script src="dist/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="dist/vendor/tinymce/tinymce.min.js"></script>
    <script src="dist/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="dist/js/main.js"></script>

</body>
</html>