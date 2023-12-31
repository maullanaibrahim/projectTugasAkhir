<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="/dashboard{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard -->

            <li class="nav-item">
                <a class="nav-link {{ Request::is('ppbje*') ? '' : 'collapsed' }}" data-bs-target="#ppbje" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-text"></i><span>PPBJe</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ppbje" class="nav-content collapse {{ Request::is('ppbje*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/ppbje-asset{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}" class="{{ Request::is('ppbje-asset*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Asset</span>
                        </a>
                    </li>
                    <li>
                        <a href="/ppbje-nonAsset{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}" class="{{ Request::is('ppbje-nonAsset*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Non Asset</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End PPBJe -->

            
            @if(auth()->user()->division_id == '12') <!-- Jika posisi sebagai Senior Manager dan Direktur -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('purchases*') ? '' : 'collapsed' }}" href="/purchases{{ encrypt(auth()->user()->position->position_name) }}">
                    <i class="bi bi-cart"></i>
                    <span>Purchase Order</span>
                </a>
            </li><!-- End Purchase Order -->
            @endif
            @can('procurement')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('purchases*') ? '' : 'collapsed' }}" href="/purchases{{ encrypt(auth()->user()->position->position_name) }}">
                    <i class="bi bi-cart"></i>
                    <span>Purchase Order</span>
                </a>
            </li><!-- End Purchase Order -->
            @endcan

            @if(auth()->user()->division_id == '12') <!-- Jika posisi sebagai Senior Manager dan Direktur -->
            @else
            <li class="nav-item">
                <a class="nav-link {{ Request::is('receivings*') ? '' : 'collapsed' }}" href="/receivings">
                    <i class="bi bi-cart-check"></i>
                    <span>Receiving</span>
                </a>
            </li><!-- End Receiving -->
            @endif
            
            @if(auth()->user()->division_id == '12') <!-- Jika posisi sebagai Senior Manager dan Direktur -->
            @else
            <li class="nav-heading">MASTER DATA</li>
            
            @can('procurement')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('users*') ? '' : 'collapsed' }}" href="/users">
                    <i class="bi bi-person-circle"></i>
                    <span>Data Akun</span>
                </a>
            </li><!-- End Data Karyawan -->
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('employees*') ? '' : 'collapsed' }}" href="/employees">
                    <i class="bi bi-people"></i>
                    <span>Data Karyawan</span>
                </a>
            </li><!-- End Data Karyawan -->
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ Request::is('branches*') ? '' : 'collapsed' }}" href="/branches">
                    <i class="bi bi-shop-window"></i>
                    <span>Data Cabang</span>
                </a>
            </li><!-- End Data Cabang -->
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('divisions*') ? '' : 'collapsed' }}" href="/divisions">
                    <i class="bi bi-diagram-3"></i>
                    <span>Data Divisi</span>
                </a>
            </li><!-- End Data Divisi -->

            <li class="nav-item">
                <a class="nav-link {{ Request::is('items*') ? '' : 'collapsed' }}" href="/items">
                    <i class="bi bi-boxes"></i>
                    <span>Data Item</span>
                </a>
            </li><!-- End Data Item -->

            @can('procurement')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('suppliers*') ? '' : 'collapsed' }}" href="/suppliers">
                    <i class="bi bi-truck"></i>
                    <span>Data Supplier</span>
                </a>
            </li><!-- End Data Supplier -->
            @endcan
            @endif
        </ul>
    </aside><!-- End Sidebar-->
<!-- ======= End Sidebar ======= -->