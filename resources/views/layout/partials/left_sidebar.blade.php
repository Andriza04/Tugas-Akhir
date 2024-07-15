<style>
    .brand-link {
        display: flex;
        align-items: center;
    }
    .brand-image-custom {
        opacity: .8;
        margin-top: 0;
    }
    .sidebar, .brand-text, .nav-link, .dropdown-item-title {
        font-family: 'NamaFont', sans-serif; /* Gantilah 'NamaFont' dengan nama font yang Anda gunakan */
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #9274ff;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('user/images/message.png') }}" class="brand-image ml-4 mr-3 brand-image-custom">
        <span class="brand-text font-weight-bold text-dark">Ayo diskusi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">

            <div class="info nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link media pl-1">
                        <div>
                            <img src="{{ Auth::user()->profile->getAvatar() }}"
                                class="img-size-50 mr-1 img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="media-body pl-1">
                            <h3 class="dropdown-item-title font-weight-bold text-dark">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-sm font-weight-bold text-dark">{{ Auth::user()->profile->nama_lengkap }} </p>
                        </div>
                        <span class="ml-2 font-weight-bold text-dark"><i class="fas fa-angle-down"></i></span>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link font-weight-bold text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                Your profile
                            </a>
                        </li> --}}
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a href="/profile" class="nav-link font-weight-bold text-dark" onclick="">
                                    <i class="far fa-circle nav-icon"></i>
                                    Admin
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="/logout" class="nav-link font-weight-bold text-dark" onclick="">
                                <i class="far fa-circle nav-icon"></i>
                                Log out
                            </a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


                <a href="/forum/create" type="submit" class="btn btn-light btn-block btn-lg text-dark mt-4"
                    style="border-radius:50px">Tanya</a>


    </div>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
