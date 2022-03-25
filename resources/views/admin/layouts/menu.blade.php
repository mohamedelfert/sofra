<!-- Languages Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-globe"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a class="dropdown-item" href="{{ adminUrl('lang/ar') }}"><img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt=""> Arabic </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ adminUrl('lang/en') }}"><img src="{{ URL::asset('assets/images/flags/US.png') }}" alt=""> English </a>
    </div>
</li>
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="true" aria-expanded="false">
        <img src="{{ url('/') }}/design/admin/dist/img/user2-160x160.jpg" class="img-circle user-image elevation-2" alt="User Image">
    </a>
    <ul class="dropdown-menu">
        <!-- Menu Footer-->
        <li class="user-footer">
            <a class="dropdown-item" href="{{ adminUrl('settings') }}"><i class="text-info fas fa-cogs"></i> Settings </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="text-danger fas fa-sign-out-alt"></i> {{ trans('main.logout') }} </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</li>
