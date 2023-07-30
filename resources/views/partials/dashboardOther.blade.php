                    <!-- PPBJe Dibuat -->
                    <div class="col-xxl-3 col-md-3">
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
                                <h5 class="card-title">Total <span>| Tahun Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $total_ppbjes }}</h6>
                                        <span class="text-primary small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Masuk -->

                    <!-- PPBJe Berlangsung -->
                    <div class="col-xxl-3 col-md-3">
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
                                <h5 class="card-title">Berlangsung <span>| Tahun Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $ppbje_processes }}</h6>
                                        <span class="text-warning small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Berlangsung -->

                    <!-- Showing: PPBJe Selesai -->
                    <div class="col-xxl-3 col-xl-3">
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
                                <h5 class="card-title">Selesai <span>| Tahun Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $ppbje_finishes }}</h6>
                                        <span class="text-success small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Selesai -->
                    
                    <!-- Showing: PPBJe Batal -->
                    <div class="col-xxl-3 col-xl-3">
                        <div class="card info-card danger-card">
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
                                <h5 class="card-title">Batal <span>| Tahun Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-x"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $ppbje_cancels }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Batal -->

                    <!-- Showing: Grafik PPBJe -->
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
                                <h5 class="card-title">Grafik PPBJe <span>| 2023</span></h5>
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
                                            data: [{{$jan}}, {{$feb}}, {{$mar}}, {{$apr}}, {{$may}}, {{$jun}}, {{$jul}}, {{$aug}}, {{$sep}}, {{$oct}}, {{$nov}}, {{$dec}}],
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
                            </div> <!-- End card-body -->
                        </div> <!-- End card -->
                    </div> <!-- End col-lg-12 -->
                    <!-- End Grafik PPBJe -->