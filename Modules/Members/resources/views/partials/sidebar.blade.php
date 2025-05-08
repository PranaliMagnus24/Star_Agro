<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

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
    <!-- Wallet Dropdown -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#wallet-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-wallet2"></i><span>{{ __('messages.Wallet') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="wallet-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="{{ route('razorpay.index', ['payment_id' => 1]) }}">
              <i class="bi bi-circle"></i><span>{{ __('messages.Recharge') }}</span>
            </a>
          </li>
        </ul>
      </li> -->
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
