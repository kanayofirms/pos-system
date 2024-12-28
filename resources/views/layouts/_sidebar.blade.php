<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">Pembo POS</span> <!--end::Brand Text--> </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                @if (Auth::user()->is_role == 1)
                    {{-- Admin menu --}}
                    <li class="nav-item"> <a href="{{ url('admin/dashboard') }}" class="nav-link active"> <i
                                class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a> </li>

                    <li class="nav-header">MASTER</li>
                    <li class="nav-item"> <a href="{{ url('admin/category') }}" class="nav-link"> <i
                                class="nav-icon fa fa-cube"></i>
                            <p>Category</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-cubes"></i>
                            <p>Product</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-id-card"></i>
                            <p>Members</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-truck"></i>
                            <p>Suppliers</p>
                        </a> </li>

                    <li class="nav-header">TRANSACTION</li>
                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-adjust"></i>
                            <p>Expenses</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-download"></i>
                            <p>Purchase</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-dollar"></i>
                            <p>Sales List</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-cart-plus"></i>
                            <p>New Transaction</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-bullhorn"></i>
                            <p>Active Transaction</p>
                        </a> </li>

                    <li class="nav-header">REPORT</li>
                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-asterisk"></i>
                            <p>Income</p>
                        </a> </li>

                    <li class="nav-header">SYSTEM</li>
                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-users"></i>
                            <p>User</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-cogs"></i>
                            <p>Settings</p>
                        </a> </li>
                    {{-- User menu --}}
                @elseif (Auth::user()->is_role == 2)
                    <li class="nav-item"> <a href="{{ url('user/dashboard') }}" class="nav-link active"> <i
                                class="nav-icon fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a> </li>

                    <li class="nav-header">TRANSACTION</li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-cart-plus"></i>
                            <p>New Transaction</p>
                        </a> </li>

                    <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon fa fa-bullhorn"></i>
                            <p>Active Transaction</p>
                        </a></li>
                @endif




            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->
