<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }} - eProcurement</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('dist/img/favicon.ico') }}" rel="icon">
    <link href="{{ asset('dist/img/favicon.ico') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('dist/css/google-fonts.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('dist/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('dist/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('dist/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('dist/DataTables/DataTables-1.13.6/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/DataTables/DataTables-1.13.6/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Javascript -->
    <script src="{{ asset('dist/js/config.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('dist/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('dist/js/accounting.js') }}"></script>

    <script type="text/javascript">
            var myVar;

            function myFunction() {
                myVar = setTimeout(showPage, 300);
            }

            function showPage() {
                document.getElementById("content").style.display = "block";
                document.getElementById("preloader").style.display = "none";
                document.getElementById("loader").style.display = "none";
                document.getElementById("status").style.display = "none";
            }

            $('#example').DataTable();

            $(document).ready(function(){
                $('#approvalNote').keyup(function(){
                    var note = $(this).val();
                    $('#agreeNote').val(note);
                    $('#disagreeNote').val(note);
                });
            });

            $(document).ready(function(){
                var harga = document.getElementById("price");
                harga.addEventListener("keyup", function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    harga.value = formatRupiah(this.value);
                });

                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^.\d]/g, "").toString(),
                    split = number_string.split("."),
                    sisa = split[0].length % 3,
                    harga = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                    separator = sisa ? "," : "";
                    harga += separator + ribuan.join(",");
                    }

                    harga = split[1] != undefined ? harga + "." + split[1] : harga;
                    return prefix == undefined ? harga : harga ? harga : "";
                }
            });
    </script>

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.4.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body onload="myFunction()">
    <div class="container-fluid">
        <div id="preloader">
            <div class="position-absolute top-50 start-50 translate-middle">
                <div id="loader"></div>
                <div><strong id="status" role="status" class="text-primary">Memuat Halaman...</strong></div>
            </div>
        </div>

        <div style="display:none;" id="content" class="animate-bottom">
            <header id="header" class="header fixed-top d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="/" class="logo2 d-flex align-items-center">
                        <img src="{{ asset('dist/img/logo/logo2.png') }}" alt="">
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div><!-- End Logo -->
                @include('partials.header')
            </header><!-- End Header -->

            @include('partials.sidebar')


            <!-- ======= Main Content ======= -->
            <main id="main" class="main">
                <!-- Showing notification succeded for input new branch -->
                @if(session()->has('success'))
                    <script>
                        swal("Berhasil!", "{{ session('success') }}", "success", {
                            timer: 1500
                        });
                    </script>
                @endif

                <!-- Title Bar -->
                <div class="pagetitle">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}"><i class="bi bi-house-door"></i></a></li>
                            <li class="breadcrumb-item active">{{ $path }}</li>
                        </ol>
                    </nav>
                </div><!-- End Title Bar -->
                @yield('content')
            </main><!-- End Main Content -->


            <!-- ======= Footer ======= -->
            <footer id="footer" class="footer">
                <div class="copyright">
                    &copy; Copyright <strong><span><a href="#">Maulana Ibrahim</a></span></strong>. All Rights Reserved
                </div>
            </footer><!-- End Footer -->

            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('dist/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('dist/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dist/js/main.js') }}"></script>
</body>
</html>
