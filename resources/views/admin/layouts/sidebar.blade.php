<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>{{ __('messages.Dashboard') }}</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gear"></i><span>{{ __('messages.Settings') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('role.list') }}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Role Management') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('permission.list') }}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Permission Management') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('users.list') }}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.User Management') }}</span>
                </a>
              </li>
        </ul>
      </li><!-- End Settings Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gear-wide-connected"></i><span>{{ __('messages.Master Settings') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="master-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('category.index') }}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Category') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('create.location')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Location') }}</span>
                </a>
              </li>
              <li>
                @can('view general setting')
                <a href="{{ route('create.generalSetting')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.General Settings') }}</span>
                </a>
                @endcan
              </li>
              <li>
                <a href="{{ route('paymentGateway.list')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Payment Gateway') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('sms.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.SMS Gateway') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('whatsapp.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Whatsapp') }}</span>
                </a>
              </li>

        </ul>
      </li><!-- End Master Setting -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#farmer-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>{{ __('messages.Farmer Registration') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="farmer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.farmer.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Farmer') }}</span>
                </a>
              </li>
        </ul>
      </li><!-- End Master Setting -->
    </ul>

  </aside><!-- End Sidebar-->
