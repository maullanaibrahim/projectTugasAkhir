@extends('layouts.main')

@section('content')

   <div class="pagetitle">
      <h1>{{ $path }}</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door"></i> {{ $path }}</li>
         </ol>
      </nav>
   </div><!-- End Page Title -->

   <section class="section dashboard">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-xxl-4 col-md-4">
                  <div class="card info-card primary-card">

                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                           <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                           <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                     </div> <!-- End Filter Class -->

                     <div class="card-body">
                        <h5 class="card-title">PPBJe Masuk <span>| Tahun Ini</span></h5>

                        <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-file-text"></i>
                           </div>
                           <div class="ps-3">
                              <h6>0</h6>
                              <span class="text-primary small pt-1 fw-bold">PPBJe</span>
                           </div>
                        </div>
                     </div> 
                  </div>
               </div><!-- End PPBJe Card -->

               <!-- PPBJe Berlangsung Card -->
               <div class="col-xxl-4 col-md-4">
                  <div class="card info-card warning-card">

                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                           <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                           <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                     </div> <!-- End Filter Class -->

                     <div class="card-body">
                        <h5 class="card-title">PPBJe Berlangsung <span>| Tahun Ini</span></h5>

                        <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-arrow-clockwise"></i>
                           </div>
                           <div class="ps-3">
                              <h6>0</h6>
                              <span class="text-warning small pt-1 fw-bold">PPBJe</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div><!-- End PPBJe Berlangsung Card -->

               <!-- PPBJe Selesai Card -->
               <div class="col-xxl-4 col-xl-4">

                  <div class="card info-card success-card">

                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                           <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                           <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                     </div> <!-- End Filter Class -->

                     <div class="card-body">
                        <h5 class="card-title">PPBJe Selesai <span>| Tahun Ini</span></h5>

                        <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-file-earmark-check"></i>
                           </div>
                           <div class="ps-3">
                              <h6>0</h6>
                              <span class="text-success small pt-1 fw-bold">PPBJe</span>
                           </div>
                        </div>

                     </div>
                  </div>
               </div> <!-- End PPBJe Selesai Card -->

               <div class="col-lg-12">
                  <div class="card">
                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">2023</a></li>
                           <li><a class="dropdown-item" href="#">2022</a></li>
                           <li><a class="dropdown-item" href="#">2021</a></li>
                        </ul>
                     </div> <!-- End Filter Class -->

                     <div class="card-body">
                     <h5 class="card-title">Grafik PPBJe Masuk <span>| 2023</span></h5>

                     <!-- Line Chart -->
                     <canvas id="lineChart" style="max-height: 400px;"></canvas>
                     <script>
                        document.addEventListener("DOMContentLoaded", () => {
                           new Chart(document.querySelector('#lineChart'), {
                           type: 'line',
                           data: {
                              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                              datasets: [{
                                 label: 'Line Chart',
                                 data: [65, 59, 80, 81, 56, 55, 40, 70, 44, 67, 52, 19],
                                 fill: false,
                                 borderColor: 'rgb(75, 192, 192)',
                                 tension: 0.1
                              }]
                           },
                           options: {
                              scales: {
                                 y: {
                                 beginAtZero: true
                                 }
                              }
                           }
                           });
                        });
                     </script>
                     <!-- End Line CHart -->

                     </div>
                  </div>
               </div>

            </div>
         </div><!-- End Left side columns -->
      </div>
   </section>
   
@endsection