<!-- ======= Header ======= -->
    <nav class="header-nav ms-auto">
        <ul class="align-items-center">
            <!-- Welcome message -->
            <li class="nav-item dropdown pe-3">
                <p class="d-inline">Halo, </p>
                <a class="nav-link nav-profile d-inline" href="#" data-bs-toggle="dropdown">
                    <span class="d-inline text-capitalize dropdown-toggle pe-3">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                </a><!-- End Welcome message -->

                <!-- Profile Dropdown Items -->
                <ul class="dropdown-menu dropdown-menu-arrow profile me-5 w-100">
                    <li class="dropdown-header">
                        <h6 class="text-primary text-capitalize fw-bold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                        <span class="text-capitalize">{{ auth()->user()->position->position_name }} {{ auth()->user()->division->division_name }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="/register">
                            <button class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-person-plus"></i>
                                <span>Registrasi Akun</span>
                            </button>
                        </a>
                    </li>
                    <li>
                        <!-- Form Logout -->
                        <form class="row g-3" action="/logout" method="post">
                            @csrf
                            <a><button class="dropdown-item d-flex align-items-center" type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </button></a>
                        </form><!-- Form Logout -->
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
<!-- ======= End Header ======= -->