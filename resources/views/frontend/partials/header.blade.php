<header class="header-area header-three">
    <div class="header-top second-header d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 d-none d-lg-block">
                      <a href="index.html"><img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="logo"></a>
                </div>
                <div class="col-lg-9 col-md-9 d-none  d-md-block text-right">
                    <div class="header-cta">
                        <ul>


                             <li>
                                 <div class="text">
                                     <i class="far fa-phone-alt"></i> <div class="box">  <span>786-098-098-09</span></div>
                                </div>
                            </li>
                             <li>
                                  <div class="text">
                                   <i class="icon fal fa-envelope"></i>
                                      <div class="box">
                                          <a href="#">info@example.com</a>
                                      </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                      <div class="col-lg-6 col-sm-4 d-block d-lg-none">
                      <a href="index.html" class="logo"><img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="logo">
                    </a>
                    </div>

                    <div class="col-xl-8 col-lg-8">

                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li class="has-sub">
                                        <a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a>
                                    </li>
                                    <li><a href="{{ route('home.about')}}">{{ __('messages.About Us') }}</a></li>
                                    <li class="has-sub"><a href="{{ route('home.gallery')}}">{{ __('messages.Gallery') }}</a>
                                    </li>
                                    <li class="has-sub">
                                      <a href="{{ route('home.services')}}">{{ __('messages.Services') }}</a>
                                    </li>

                                    {{-- <li class="has-sub">
                                        <a href="{{ route('home.blog')}}">Blog</a>
                                    </li> --}}
                                    <li><a href="{{ route('home.contact')}}">{{ __('messages.Contact') }}</a></li>
                                    <li><a href="{{ route('home.register')}}">{{ __('messages.Register') }}</a></li>
                                    <li><a href="{{ route('home.crops')}}">{{ __('messages.Crops') }}</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 text-right d-none d-lg-block">
                       <div class="search-top2">
                           <ul>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-language"></i>
                                </a>
                                <ul class="dropdown-menu mt-3" style="min-width: 5rem;">
                                    <li>
                                        <a href="{{ url('language/en') }}" class="{{ App::getLocale() === 'en' ? 'active' : '' }}">Eng
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('language/mr') }}" class="{{ App::getLocale() === 'mr' ? 'active' : '' }}">Mar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('language/hi') }}" class="{{ App::getLocale() === 'hi' ? 'active' : '' }}">Hin
                                        </a>
                                    </li>
                                </ul>
                            </li>
                               <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fas fa-search"></i></a></li>
                                <li><a href="#" class="menu-tigger"><i class="fal fa-bars"></i></a></li>
                            </ul>
                        </div>
                    </div>


                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</header>

