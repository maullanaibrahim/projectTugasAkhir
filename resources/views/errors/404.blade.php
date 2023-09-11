<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Page Not Found - eProcurement</title>
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

    <!-- Javascript -->
    <script src="dist/js/sweetalert.min.js"></script>
    
    <script type="text/javascript">
            var myVar;

            function myFunction() {
                document.body.style.zoom = "90%";
                myVar = setTimeout(showPage, 1500);
            }

            function showPage() {
                document.getElementById("preloader").style.display = "none";
                document.getElementById("loader").style.display = "none";
                document.getElementById("status").style.display = "none";
                document.getElementById("content").style.display = "block";
            }
    </script>

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.4.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body onload="myFunction()">
    <div id="preloader" class="d-flex align-items-center">
        <div id="loader"></div>
        <strong id="status" role="status" class="position-absolute text-primary" style="top: 60%; left: 44%;">Memuat Halaman...</strong>
    </div>
    <div style="display:none;" id="content" class="animate-bottom">
        <main>
        <div class="container">
            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>Halaman yang anda maksud belum tersedia.</h2>
            <a class="btn" href="/dashboard{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}">Kembali ke Dashboard</a>
            <img src="dist/img/not-found.png" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">
                &copy; Copyright <strong><span><a href="#">Maulana Ibrahim</a></span></strong>. All Rights Reserved
            </div>
            </section>

        </div>
        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>