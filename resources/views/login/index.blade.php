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

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
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

                @if(session()->has('loginError'))
                <div class="alert alert-light alert-dismissible fade show w-auto position-fixed end-0 text-danger" style="margin-right:30px;" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="dist/img/logo/logo2.png" alt="">
                            </a>
                        </div><!-- End Logo -->
                        
                        <div class="card mb-3 p-4">
                            <div class="card-body">
                            <div class="pb-4">
                                <h5 class="card-title text-primary text-center pb-1 fs-4 fw-bold">Login Account</h5>
                                <p class="text-center small px-4">Masukkan Alamat Email dan Password akun anda untuk dapat mulai bekerja.</p>
                            </div>

                            <form class="row g-3" action="/login" method="post">
                                @csrf
                                <!-- Input Username -->
                                <div class="col-12">
                                    <div class="border border-3 border-primary d-inline py-2"></div>
                                    <input type="email" name="email" class="form-control d-inline rounded-0" id="email" placeholder="Email ID" required />
                                </div> <!-- End Input Username -->

                                <!-- Input Password -->
                                <div class="col-12 pb-4">
                                    <span class="border border-3 border-primary d-inline py-2"></span>
                                    <input type="password" name="password" class="form-control d-inline rounded-0 mb-2" id="password" placeholder="Password" required />
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" onclick="myFunction()">
                                        <label class="form-check-label" for="inlineCheckbox1">Show Password</label>
                                    </div>
                                </div> <!-- End Input Password -->

                                <!-- Login Button -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 rounded-5" type="submit">LOGIN</button>
                                </div> <!-- End Login Button -->
                                
                                <!-- Lupa Password -->
                                <div class="col-12">
                                    <p class="small mb-0 text-center">Belum punya akun? Silakan <a href="/register">Daftar Akun</a></p>
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