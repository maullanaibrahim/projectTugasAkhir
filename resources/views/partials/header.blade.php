<!-- ======= Header ======= -->
   <nav class="header-nav ms-auto">
      
      <ul class="d-flex align-items-center">
         <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
            </a>
         </li><!-- End Search Icon-->

         <li class="nav-item dropdown pe-3">
            <p class="d-inline">Hello, </p>
            <a class="nav-link nav-profile d-inline align-items-center" href="#" data-bs-toggle="dropdown">
               <span class="d-inline text-capitalize dropdown-toggle pe-3">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile ms-5 w-100">
               <li class="dropdown-header">
                  <h6 class="text-primary text-capitalize fw-bold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                  <span class="text-capitalize">{{ auth()->user()->position->nama_jabatan }} {{ auth()->user()->division->nama_divisi }}</span>
               </li>
               <li>
                  <hr class="dropdown-divider">
               </li>

               <li>
                  <form class="row g-3" action="/logout" method="post">
                     @csrf
                     <a><button class="dropdown-item d-flex align-items-center" type="submit">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Keluar</span>
                     </button></a>
                  </form>
               </li>
            </ul><!-- End Profile Dropdown Items -->
         </li><!-- End Profile Nav -->
      </ul>
   </nav><!-- End Icons Navigation -->
