<div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="{!!url('/admin/index')!!}" class="logo">
                        <span>
                            HPBOOK ADMIN
                        </span>
                        <i>
                            <img src="hpbook/images/39c70677-cb25-4c54-9951-25862ec1756a.png" alt="" height="28">
                        </i>
                    </a>
                </div>
                <nav class="navbar-custom">
                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="admin_public/images/users/avatar-1.jpg" alt="user" class="rounded-circle"> <span class="ml-1">{{ Auth::user()->name }}<i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Xin Chào !</h6>
                                </div>
                                <!-- item-->
                                <a href="{!!url('/admin/settings')!!}" class="dropdown-item notify-item">
                                    <i class="fi-cog"></i> <span>Đổi Mật Khẩu</span>
                                </a>
                                <!-- item-->
                                <a href="{!!url('admin/logout')!!}" class="dropdown-item notify-item">
                                    <i class="fi-power"></i> <span>Đăng Xuất</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>

</div>