<style>

</style>
@php
$categories = Modules\Category\App\Models\Category::where('parent_id', 0)->get();
@endphp
<header class="header-area header-three">
    <div class="header-top second-header d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 d-none d-lg-block text-center">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('frontend/assets/img/logo/logo.svg') }}" alt="logo" style="height: 172px; width: 128px; margin-bottom: -27px;">
                        <div style="font-size: 20px;"><strong>शेतकऱ्याचे हक्काचे व्यासपीठ</strong></div>
                    </a>

                </div>


 <!-- 🔍 Global Search Bar -->
 <div class="col-lg-3 col-md-3 d-none d-md-block">
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('search') }}">
          <input type="text" name="query" placeholder="{{ __('messages.Search crops') }}.." title="Enter search keyword">
          <button type="submit" title="Search"><i class="fa fa-search"></i></button>
        </form>
      </div>
</div>

                <div class="col-lg-6 col-md-6 d-none d-md-block text-right">
                    <div class="header-cta">
                        <ul class="list-inline">
                            <!------------profile login logout dropdown---------------->
                            <li class="list-inline-item">
                                <div class="text">
                                    @if(Auth::check())
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" style="color:#76bc02;" href="{{ route('member.profile')}}">{{ __('messages.My Profile') }}</a>
                                            <a class="dropdown-item text-success" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('messages.Logout') }}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                @endif
                                </div>
                            </li>
<!------------profile login logout dropdown End---------------->
                            <li class="list-inline-item">
                                <div class="text">
                                    <i class="far fa-phone-alt"></i>
                                    <div class="box">
                                        <span>{{$getSetting->phone}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="text">
                                    <i class="icon fal fa-envelope"></i>
                                    <div class="box">
                                        <a href="#">{{$getSetting->email}}</a>
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
                      <a href="index.html" class="logo"><img src="{{ asset('frontend/assets/img/logo/logo.svg') }}" alt="logo" style="height: 67px; width: 128px; margin-bottom: -27px;">
                    </a>
                    <div style="font-size: 14px; margin-top: 5px; color: #fff"><strong>शेतकऱ्याचे हक्काचे व्यासपीठ</strong></div>
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

