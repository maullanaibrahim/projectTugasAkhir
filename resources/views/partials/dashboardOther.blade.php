                    <!-- PPBJe Dibuat -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card primary-card">
                            <div class="card-body">
                                <h5 class="card-title">Total <span>| {{ $thisYear }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $ppbje_totals }}</h6>
                                        <span class="text-primary small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Masuk -->

                    <!-- Showing: PPBJe Belum Disetujui -->
                    <div class="col-xxl-3 col-xl-3">
                        <div class="card info-card secondary-card">
                            <div class="card-body">
                                <h5 class="card-title">Belum Disetujui <span>| {{ $thisYear }}</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-lock2"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $approving }}</h6>
                                        <span class="text-secondary small pt-1 fw-bold">PPBJe</span>
                                    </div>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End success-card -->
                    </div> <!-- End col-xxl-3 col-xl-3 -->
                    <!-- End PPBJe Belum Disetujui -->

                    <!-- PPBJe Berlangsung -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card warning-card">
                            <div class="card-body">
                                <h5 class="card-title">Berlangsung <span>| {{ $thisYear }}</span></h5>
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
                            <div class="card-body">
                                <h5 class="card-title">Selesai <span>| {{ $thisYear }}</span></h5>
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

                    <!-- Showing: Grafik PPBJe -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik PPBJe <span>| {{ $thisYear }}</span></h5>
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