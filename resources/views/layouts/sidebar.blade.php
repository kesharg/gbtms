{{-- Main Sidebar Container --}}
<aside class="main-sidebar sidebar-light-primary elevation-4 control-sidebar-push " style="background-color: #3c8dbc;">
    {{-- Brand Logo --}}
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{url('./img/logo.png')}}" alt="NTA Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-dark">NTA</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar nav-collapse-hide-child sidebar-light-primary">
        {{-- Sidebar user panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('./img/user.png')}}" class="img-circle elevation-5" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-child-indent  nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="true">
                {{-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library --}}
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        {{-- Main Dash Board --}}
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('SuperAdmin|admin|Admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        {{-- Settings --}}
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav  nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of Settings->Manage Users --}}
                                <p>
                                    Manage Users
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of Settings->Manage Roles --}}
                                <p>
                                    Manage Roles
                                </p>
                            </a>
                        </li>
{{--
                        <li class="nav-item">
                            <a href="{{ route('band.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Band
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('infrastructurecode.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Infrastructure Code
                                </p>
                            </a>
                        </li>
--}}
                        <li class="nav-item">
                            <a href="{{ route('operator.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Operator
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endrole
                <li class="nav-item has-treeview">
                    <a href="{{ route('system.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-broadcast-tower"></i>
                        {{-- Base Tower System --}}
                        <p>
                            System(BTS)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav  nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('system.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of BTS->Create new --}}
                                <p>
                                    System
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('systemsite.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of BTS->Create new --}}
                                <p>
                                    System-Site
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('microwavenode.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-signal"></i>
                        {{-- Microwave --}}
                        <p>
                            Microwave
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('microwavenode.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of Microwave-->Create New --}}
                                <p>
                                    Microwave Station
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('microwavestationlink.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of Microwave-->View Pending --}}
                                <p>
                                    Microwave Link
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('vsat.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-satellite-dish"></i>
                        {{-- VSAT --}}
                        <p>
                            VSAT
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('vsat.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of VSAT-->Create New --}}
                                <p>
                                    VSAT Station
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('opticalfiber.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-network-wired"></i>
                        {{-- Optical Fiber --}}
                        <p>
                            Optical Fiber
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('opticalfiber.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of OF-->Create New --}}
                                <p>
                                    Optical Fiber Node
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('opticalfiberlink.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of OF-->View Pending --}}
                                <p>
                                    Optical Fiber Link
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--
                <li class="nav-item has-treeview">
                    <a href="{{ route('pstn.index') }}" class="nav-link">
                        <i class="fas fa-blender-phone"></i>
                        <!--  PSTN  -->
                        <p>
                            PSTN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pstn.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <!--  Sub of PSTN-->Create New  -->
                                <p>
                                    PSTN Node
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('wireless.index') }}" class="nav-link">
                        <i class="fas fa-wifi"></i>
                        <!--  Wireless  -->
                        <p>
                            Wireless Site
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('wireless.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <!--  Sub of Wireless-->Create New  -->
                                <p>
                                    Wireless Site Node
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
--}}

                <li class="nav-item has-treeview">
                    <a href="{{ route('opticalfiber.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-network-wired"></i>
                        {{-- Highway Optical Fiber --}}
                        <p>
                            Highway Optical Fiber
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('opticalfiberplanned.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of OF-->View Pending --}}
                                <p>
                                    Optical Fiber Node
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('opticalfiberlinkplanned.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                {{-- Sub of OF-->View Pending --}}
                                <p>
                                    Optical Fiber Link
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('export-data')
                <li class="nav-item">
                    <a href="{{url('coveragedata')}}" class="nav-link">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        {{-- Coverage Data --}}
                        <p>
                            Coverage Data
                        </p>
                    </a>
                </li>
                @endcan

                @can('map-view')
                <li class="nav-item">
                    <a href="{{ url('map') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        {{-- MapView --}}
                        <p>
                            Map View
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
