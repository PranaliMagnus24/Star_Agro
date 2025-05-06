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
                  <i class="bi bi-credit-card"></i><span>{{ __('messages.Payment Gateway') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('sms.index')}}">
                  <i class="bi bi-chat-dots"></i><span>{{ __('messages.SMS Gateway') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('whatsapp.index')}}">
                  <i class="bi bi-whatsapp"></i><span>{{ __('messages.Whatsapp') }}</span>
                </a>
              </li>

             <li>
                <a href="{{ route('admin.quantityMass.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.UnitMass') }}</span>
                </a>
              </li> 

               <li>
                <a href="#">
                  <i class="bi bi-cash"></i><span>{{ __('messages.points') }}</span>
                </a>
              </li>
               
              <!-- <li>
                <a href="{{ route('admin.faq.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.FAQ') }}</span>
                </a>
              </li>  -->

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
      </li><!-- End Farmer Setting -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#entrepreneur-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>{{ __('messages.Entrepreneur') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="entrepreneur-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.entrepreneur.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.Entrepreneur') }}</span>
                </a>
              </li>
        </ul>
      </li><!-- End Entrepreneur Setting -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#trader-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>{{ __('messages.trader') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="trader-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.trader.index')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.trader') }}</span>
                </a>
              </li>
        </ul>
      </li>   <!-- end trader setting  -->

      <li class="nav-item">
    <a class="nav-link" href="{{ route('pages.index') }}">
        <i class="bi-journal-text"></i>
        <span>{{ __('messages.CMS Pages') }}</span>
    </a>
</li>


      <!-- end CMS page -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#faq-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-question-circle"></i><span>{{ __('messages.FAQ') }}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="faq-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.faq.index') }}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.FAQ') }}</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.faqCategory')}}">
                  <i class="bi bi-circle"></i><span>{{ __('messages.FAQCategory') }}</span>
                </a>
            </li>
        </ul>
      </li><!-- End FAQ Section -->

    </ul>
  </aside><!-- End Sidebar-->
