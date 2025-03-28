<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('member')}}">
          <i class="bi bi-grid"></i>
          <span>{{ __('messages.Dashboard') }}</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="{{ route('crop.index')}}">
            <i class="bi bi-cart-check-fill"></i>
          <span>{{ __('messages.Crop Management') }}</span>
        </a>
      </li><!-- End Crop Management -->

    </ul>

  </aside><!-- End Sidebar-->
