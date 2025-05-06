<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0; /* Adjust padding as needed */
}

.header-top .container {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping for smaller screens */
}

.header-top .search-bar {
    flex: 1; /* Allow search bar to take available space */
    margin: 0 10px; /* Add margin for spacing */
}

.header-cta {
    display: flex;
    justify-content: flex-end; /* Align items to the right */
}

.header-cta ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.header-cta ul li {
    margin-left: 20px; /* Space between items */
}



</style>
<header class="header-area header-three">
<!-- <i class="bi bi-search" aria-hidden="true" title="Search"></i> -->

    <div class="header-top second-header d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 text-center">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ url('upload/general_setting/'.$getSetting->header_logo) }}" alt="logo" style="height: 172px; width: 128px; margin-bottom: -27px;">
                        <div style="font-size: 20px;"><strong>शेतकऱ्यांचे हक्काचे व्यासपीठ</strong></div>
                      

                    </a>
                  
                </div>
               
                <!-- <div class="col-lg-3 col-md-3">
                    <div class="search-bar position-relative">
                        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('home.index') }}">
                            <input id="liveSearchInput" type="text" name="query" placeholder="{{ __('messages.Search crops') }}.." title="Enter search keyword" autocomplete="off">
                            <button type="submit" title="Search"><i class="fa fa-search"></i></button>
                        </form>
                        <ul id="liveSearchResults" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
                    </div>
                </div> -->
               
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            
             <div class="search-bar position-relative">
                             
                    <form class="search-form d-flex align-items-center" method="GET" action="{{ route('home.crops') }}">
                        <input id="liveSearchInput" class="form-control " type="text" name="search" placeholder="{{ __('messages.Search crops') }}.." title="Enter search keyword" autocomplete="off"value="{{ request('query') }}">
                        <button type="submit" class="btn btn-outline-secondary" title="Search"><i class="fa fa-search"></i></button>
                    </form>
                <!-- <ul id="liveSearchResults" class="list-group position-absolute w-100" style="z-index: 1000;"></ul> -->
            </div>
        </div>


                <!-- <div class="col-lg-6 col-md-6 text-right">
                    <div class="header-cta">
                        <ul class="list-inline">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                      <div class="col-lg-6 col-sm-4 d-block d-lg-none">
                      <a href="index.html" class="logo"><img src="{{ url('upload/general_setting/'.$getSetting->header_logo) }}" alt="logo" style="height: 67px; width: 128px; margin-bottom: -27px;">
                    </a>
                    
                    <div style="font-size: 14px; margin-top: 5px; color: #fff"><strong>शेतकऱ्यांचे हक्काचे व्यासपीठ</strong>
                      <i class="bi bi-search" aria-hidden="true" title="Search"></i>
                      
                    </div>
                  
                    </div>

                    <div class="col-xl-10 col-lg-10">

                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li class="has-sub">
                                        <a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a>
                                    </li>
                                    <li><a href="{{ route('home.about')}}">{{ __('messages.About Us') }}</a></li>
                                    <li class="has-sub">
                                        <a href="{{ route('home.services')}}">{{ __('messages.Services') }}</a>
                                      </li>
                                      <li><a href="{{ route('home.crops')}}">{{ __('messages.Crops') }}</a></li>

                                    <li class="has-sub"><a href="{{ route('home.gallery')}}">{{ __('messages.Gallery') }}</a>
                                    </li>

                                    <li><a href="{{ route('home.contact')}}">{{ __('messages.Contact') }}</a></li>
                                    <!-------------Login------------------>
                                    @if(Auth::check())
                                    <li class="has-sub">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                        <ul>
                                            <li>
                                                <a href="{{ route('member.profile') }}" style="color:#76bc02;">
                                                    {{ __('messages.My Profile') }}
                                                </a>
                                            </li>
                                            <li>

                                            </li>
                                            @if(Auth::user()->hasRole('farmer'))
                                             <li>
                                                 <a href="{{ route('crop.index') }}" style="color:#76bc02;">
                                                    {{ __('messages.Crop Management') }}
                                                 </a>
                                            </li>
                                             @endif

                                            <li>
                                                <a href="{{ route('wallet.management.index') }}" style="color:#76bc02;">
                                                    {{ __('messages.Wallet') }}
                                                </a>
                                            </li>
                                          

                                            <li>
                                            <a href="{{ route(  'member.inquiries') }}" style="color:#76bc02;">
                                                    {{ __('messages.My Inquiry') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route('logout') }}" class="text-success" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('messages.Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                     </li>
                                     @else
                                     <li><a href="{{ route('home.register')}}">{{ __('messages.Register') }}</a></li>
                                     <li>
                                        <a href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                    </li>
                                    @endif
                                    <!------------login end------------------>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block">
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
                                <!-- <li><a href="#" class="menu-tigger"><i class="fal fa-bars"></i></a></li> -->
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
<!-- 
<script>
 $(document).ready(function () {
    $('#liveSearchInput').on('keyup', function () {
        let query = $(this).val().trim();

        if (query.length > 1) {
            $.ajax({
                url: '{{ route("live.search") }}',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    let resultsList = $('#liveSearchResults');
                    resultsList.empty();

                    if (data.length > 0) {
                        $.each(data, function (index, item) {
                            resultsList.append(`
                                <li class="list-group-item">
                                    <a href="${item.url}" class="text-dark text-decoration-none">${item.name}</a>
                                    <a href="${item.url}" class="text-dark text-decoration-none">${item.description}</a>
                                </li>
                            `);
                        });
                    } else {
                        resultsList.append('<li class="list-group-item text-muted">No results found</li>');
                    }
                },
                error: function (xhr) {
                    console.error("Search error:", xhr.responseText);
                }
            });
        } else {
            $('#liveSearchResults').empty();
        }
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.search-bar').length) {
            $('#liveSearchResults').empty();
        }
    });
});
</script> -->


<script>
    document.getElementById('mobileSearchToggle').addEventListener('click', function () {
        const form = document.getElementById('liveSearchResults');
        form.classList.toggle('d-none');
    });

    $(document).ready(function () {
    $('#liveSearchInput').on('keyup', function () {
        const query = $(this).val();
        if (query.length < 1) {
            $('#liveSearchResults').empty();
            return;
        }

        $.ajax({
            url: '/live-search',
            data: { search: query },
            success: function (data) {
                let resultsHtml = '';
                if (data.length > 0) {
                    data.forEach(function (item) {
                        resultsHtml += '<li class="list-group-item"><a href="' + item.url + '">' + item.name + '</a></li>';

                    });
                } else {
                    resultsHtml = '<li class="list-group-item text-muted">No results found</li>';
                }
                $('#liveSearchResults').html(resultsHtml);
            }
        });
    });

    // Optional: hide results when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest('.search-bar').length) {
            $('#liveSearchResults').empty();
        }
    });
});

</script>


