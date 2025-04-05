 <div class="offcanvas-menu">
                <span class="menu-close"><i class="fas fa-times"></i></span>
              <form role="search" method="get" id="searchform"   class="searchform" action="http://wordpress.zcube.in/xconsulta/">
                                <input type="text" name="s" id="search" value="" placeholder="Search"  />
                                <button><i class="fa fa-search"></i></button>
                            </form>


                    <div id="cssmenu3" class="menu-one-page-menu-container">
                        <ul id="menu-one-page-menu-2" class="menu">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.about')}}">{{ __('messages.About Us') }}</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.services')}}">{{ __('messages.Services') }}</a></li>
                             {{-- <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="pricing.html">Pricing </a></li> --}}
                             {{-- <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="team.html">Team </a></li> --}}

                             <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.gallery')}}">{{ __('messages.Gallery') }}</a></li>
                             {{-- <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.blog')}}">{{ __('messages.Blog') }}</a></li> --}}
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="{{ route('home.contact')}}">{{ __('messages.Contact') }}</a></li>

                        </ul>
                    </div>

                    <div id="cssmenu2" class="menu-one-page-menu-container">
                        <ul id="menu-one-page-menu-1" class="menu">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#home"><span>{{$getSetting->phone}}</span></a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#howitwork"><span>{{$getSetting->email}}</span></a></li>
                            <li>
                                <a href="{{ url('language/en') }}" class="{{ App::getLocale() === 'en' ? 'active' : '' }}">English
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('language/mr') }}" class="{{ App::getLocale() === 'mr' ? 'active' : '' }}">Marathi</a>
                            </li>
                            <li>
                                <a href="{{ url('language/hi') }}" class="{{ App::getLocale() === 'hi' ? 'active' : '' }}">Hindi</a>
                            </li>
                        </ul>
                    </div>
            </div>
            <div class="offcanvas-overly"></div>
