<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
        <a  class="nav-link"href="{{ route('home.index')}}">
          <i class="bi bi-house"></i>
          <span>{{ __('messages.Home') }}</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link " href="{{ route('member')}}">
          <i class="bi bi-grid"></i>
          <span>{{ __('messages.Dashboard') }}</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @can('view crop management')
      <li class="nav-item">
        <a class="nav-link " href="{{ route('crop.index')}}">
            <i class="bi bi-tree"></i>
          <span>{{ __('messages.Crop Management') }}</span>
        </a>
      </li><!-- End Crop Management -->
    @endcan
   
    
      <li class="nav-item">
    <a class="nav-link" href="{{ route('member.referral.link') }}">
        <i class="bi bi-person-plus"></i>
        <span>{{ __('messages.Referral') }}</span>
    </a>
</li>


      <!-- end referral  -->
      <li class="nav-item">
        <a class="nav-link " href="{{ route('wallet.management.index') }}">
            <i class="bi bi-cash"></i>
          <span>{{ __('messages.Wallet') }}</span>
        </a>
      </li>
      <!-- End Wallet Nav -->
      <li class="nav-item">
        <a class="nav-link " href="{{route('member.inquiries') }}">
            <i class="bi-info-circle"></i>
          <span>{{ __('messages.My Inquiry') }}</span>
        </a>
      </li>
      <!-- End Inquiry Nav -->
    </ul>

  </aside><!-- End Sidebar-->
