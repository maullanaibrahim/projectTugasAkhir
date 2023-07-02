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

   <script src="dist/js/config.js"></script>
   <script src="dist/js/jquery-3.6.3.min.js"></script>

   <script src="dist/js/dashboards-analytics.js"></script>

   <script type="text/javascript">
      function zoom() {
         document.body.style.zoom = "90%" 
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

   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
         <a href="/" class="logo2 d-flex align-items-center">
            <img src="dist/img/logo/logo2.png" alt="">
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->
      @include('partials.header')
   </header><!-- End Header -->

   @include('partials.sidebar')


   <!-- ======= Main Content ======= -->
   <main id="main" class="main">
      @yield('content')
   </main><!-- End Main Content -->


   <!-- ======= Footer ======= -->
   <footer id="footer" class="footer">
      <div class="copyright">
         &copy; Copyright <strong><span><a href="#">Maulana Ibrahim</a></span></strong>. All Rights Reserved
      </div>
   </footer><!-- End Footer -->

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