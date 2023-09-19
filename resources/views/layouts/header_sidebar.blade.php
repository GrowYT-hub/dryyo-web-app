@php
    $settings = \App\Models\Setting::where('user_id', \Illuminate\Support\Facades\Auth::guard()->user()->id)->first();
@endphp
<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="/dashboard">
                <img src="{{ asset('assets/img/logo.jpg') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('assets/img/logo.jpg') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
            <!-- <div class="main-header-center ms-3 d-none d-lg-block">
                <input type="text" class="form-control" id="typehead" placeholder="Search for results...">
                <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
            </div> -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <!-- <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- FULL-SCREEN -->
                            <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i
                                        class="fe fe-bell"></i><span class=" pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <a class="dropdown-item d-flex" href="/">
                                            <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                <i class="fe fe-mail"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New Application received
                                                </h5>
                                                <span class="notification-subtext">3 days ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="/">
                                            <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                <i class="fe fe-check-circle"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Project has been
                                                    approved</h5>
                                                <span class="notification-subtext">2 hours ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="/">
                                            <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                                                <i class="fe fe-shopping-cart"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Your Product Delivered
                                                </h5>
                                                <span class="notification-subtext">30 min ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="/">
                                            <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                                <i class="fe fe-user-plus"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Friend Requests</h5>
                                                <span class="notification-subtext">1 day ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="notify-list.html"
                                        class="dropdown-item text-center p-3 text-muted">View all
                                        Notification</a>
                                </div>
                            </div>
                            <!-- NOTIFICATIONS -->
                            <!-- SIDE-MENU -->
                            <div class="d-flex ">
                                <div class="dropdown d-flex profile-1">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                        <img src="{{ asset('assets/images/users/21.jpg') }}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                        <div class="drop-heading">
                                            <div class="text-center">
                                                <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h5>
                                                <small class="text-muted">{{ implode(',',array_column(Auth::guard()->user()->roles->toArray(),'name')) }}</small>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <div class="dropdown-divider m-0"></div>
                                        <!-- <a class="dropdown-item" href="profile.html">
                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                        </a> -->
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /app-Header -->

<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header pb-6">
            <a class="header-brand1" href="index.html">

                <img src="{{  Storage::url($settings->logo) }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ Storage::url($settings->logo) }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ Storage::url($settings->logo) }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ Storage::url($settings->logo) }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                @if(in_array('user',array_column(Auth::guard()->user()->roles->toArray(),'name')))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/request-form">
                        <i class="side-menu__icon fe fe-layout"></i>
                        <span class="side-menu__label">Request Form</span>
                    </a>
                </li>
                @elseif(in_array('admin',array_column(Auth::guard()->user()->roles->toArray(),'name')))
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/dashboard">
                        <i class="side-menu__icon fe fe-layout"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/users">
                        <i class="side-menu__icon fe fe-user"></i>
                        <span class="side-menu__label">User</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/new-request-listing">
                        <i class="side-menu__icon fe fe-truck"></i>
                        <span class="side-menu__label">Orders</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/invoice">
                        <i class="side-menu__icon  fe fe-file-text"></i>
                        <span class="side-menu__label">Invoice</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/reports">
                        <i class="side-menu__icon fe fe-pie-chart"></i>
                        <span class="side-menu__label">Reports</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin/feedback">
                        <i class="side-menu__icon fe fe-edit-3"></i>
                        <span class="side-menu__label">Feedback</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-cpu"></i>
                        <span class="side-menu__label">General Settings</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side25">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Submenu items</a></li>
                                            <li class="sub-slide">
                                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                        class="sub-side-menu__label">Settings</span><i
                                                        class="sub-angle fe fe-chevron-right"></i></a>
                                                <ul class="sub-slide-menu">
                                                    <li><a class="sub-slide-item" href="{{ route('setting.index') }}">Logos & Footer</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side25">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                                            <li class="sub-slide">
                                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                                    <span class="sub-side-menu__label">Category & Subcategory</span>
                                                    <i class="sub-angle fe fe-chevron-right"></i>
                                                </a>
                                                <ul class="sub-slide-menu">
                                                    <li><a class="sub-slide-item" href="/admin/types">Type</a></li>
                                                    <li><a class="sub-slide-item" href="/admin/category">Category</a></li>
                                                    <li><a class="sub-slide-item" href="/admin/sub-category">Subcategory</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!--/APP-SIDEBAR-->
