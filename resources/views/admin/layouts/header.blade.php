<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline" method="GET">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="text" placeholder="Tìm kiếm"
                            aria-label="Search" value="{{ Request::get('id') }}">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">

                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">

                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">

                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

    </ul>
</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="brand-link" style="text-align: center">
        <span class="brand-text">Ecommerce</span>
    </div>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://i.pinimg.com/564x/ea/4c/0b/ea4c0b55cdf65d93ae32f63f54463813.jpg"
                    class="img-circle elevation-2">
            </div>
            <div class="info">
                <a class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link @if (Request::segment(2) == 'dashboard' && Request::segment(3) == null) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/category/list') }}"
                        class="nav-link @if (Request::segment(2) == 'category') active @endif">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Danh mục</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/sub_category/list') }}"
                        class="nav-link @if (Request::segment(2) == 'sub_category') active @endif">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Danh mục phụ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/product/list') }}"
                        class="nav-link @if (Request::segment(2) == 'product') active @endif">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/order/list') }}"
                        class="nav-link @if (Request::segment(2) == 'order') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Quản lý đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/brand/list') }}"
                        class="nav-link @if (Request::segment(2) == 'brand') active @endif">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Thương hiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/color/list') }}"
                        class="nav-link @if (Request::segment(2) == 'color') active @endif">
                        <i class="nav-icon fas fa-solid fa-palette"></i>
                        <p>Màu sắc</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/discount_code/list') }}"
                        class="nav-link @if (Request::segment(2) == 'discount_code') active @endif">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Mã giảm giá</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/shipping_charge/list') }}"
                        class="nav-link @if (Request::segment(2) == 'shipping_charge') active @endif">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>Phí vận chuyển</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/account/list') }}"
                        class="nav-link @if (Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Tài khoản Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/customer/list') }}"
                        class="nav-link @if (Request::segment(2) == 'customer') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Tài khoản khách hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/contact') }}"
                        class="nav-link @if (Request::segment(2) == 'contact') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Liên hệ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Đăng xuất</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>
