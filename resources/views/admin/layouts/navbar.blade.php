<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ url('/') }}/design/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('home') }}" class="nav-link">{{ trans('main.home') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @include('admin.layouts.menu')

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{ url('/') }}/design/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ trans('main.brand') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/') }}/design/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} <br> <small><i class="fa fa-circle text-success"></i> Online</small></a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('main.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ active_menu('cities')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas  fa-globe-africa"></i>
                        <p>
                            {{ trans('main.cities') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('cities')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('cities') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.cities_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('regions')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            {{ trans('main.regions') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ active_menu('cities')[1] }}">
                        <li class="nav-item">
                            <a href="{{ adminUrl('regions') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.regions_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('categories')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.categories') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('categories')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('categories') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.categories_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('transactions')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.transactions') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('transactions')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('transactions') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.transactions_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('offers')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.offers') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('offers')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('offers') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.offers_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('restaurants')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.restaurants') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('restaurants')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('restaurants') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.restaurants_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('payment-methods')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.payment_methods') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('payment-methods')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('payment-methods') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.payment_methods_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('clients')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.clients') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('clients')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('clients') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.clients_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('orders')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('main.orders') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('orders')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('orders') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>{{ trans('main.orders_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
{{--                <li class="nav-item {{ active_menu('users')[0] }}">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="fas fa-user-shield"></i>--}}
{{--                        <p>--}}
{{--                            {{ trans('main.users') }}--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview" {{ active_menu('users')[1] }}>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ adminUrl('users') }}" class="nav-link">--}}
{{--                                <i class="fas fa-user-plus"></i>--}}
{{--                                <p>{{ trans('main.users_list') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ adminUrl('roles') }}" class="nav-link">--}}
{{--                                <i class="fas fa-user-secret"></i>--}}
{{--                                <p>{{ trans('main.roles_list') }}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="nav-item {{ active_menu('contacts')[0] }}">
                    <a href="{{ adminUrl('contacts') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open"></i>
                        <p>{{ trans('main.contacts') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ active_menu('settings')[0] }}">
                    <a href="{{ adminUrl('settings') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>{{ trans('main.settings') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
