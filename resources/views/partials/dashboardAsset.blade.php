                    <!-- PPBJe Masuk -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card primary-card">
                            <div class="card-body">
                                <h5 class="card-title">PPBJe Masuk <span>| {{ $thisYear }}</span></h5>
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
                    </div> <!-- End col-xxl-4 col-xl-4 -->
                    <!-- End PPBJe Masuk -->

                    <!-- PPBJe Berlangsung -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card warning-card">
                            <div class="card-body">
                                <h5 class="card-title">PPBJe Berlangsung <span>| {{ $thisYear }}</span></h5>
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
                    </div> <!-- End col-xxl-4 col-xl-4 -->
                    <!-- End PPBJe Berlangsung -->

                    <!-- Showing: PPBJe Selesai -->
                    <div class="col-xxl-4 col-xl-4">
                        <div class="card info-card success-card">
                            <div class="card-body">
                                <h5 class="card-title">PPBJe Selesai <span>| {{ $thisYear }}</span></h5>
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
                    </div> <!-- End col-xxl-4 col-xl-4 -->
                    <!-- End PPBJe Selesai -->

                    <!-- Showing: Grafik PPBJe -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik PPBJe Masuk <span>| {{ $thisYear }}</span></h5>
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