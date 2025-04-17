<footer class="footer-bg footer-p" style="background: url(/frontend/assets/img/bg/footer-bg.png) no-repeat;background-size: cover;">
    <div class="footer-top pt-60 pb-40">
        <div class="container">
            <div class="row justify-content-between">

                  <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title mb-30">
                           <img src="{{ url('upload/general_setting/'.$getSetting->footer_logo)}}" alt="img">
                           <div style="font-size: 14px;color: #fff; margin-top: -30px;">
                           <strong>शेतकऱ्यांचे हक्काचे व्यासपीठ</strong></div>
                        </div>

                        {{-- <p>Donec luctus est turpis, viverra vestibulum augue volutpat in. Duis euismod eu justo sit amet tincidunt. Suspendisse euismod ex iaculis, sodales nulla congue.</p> --}}

                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Our Links</h2>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <!-- <li><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li> -->
                                <!-- <li><a href="{{ route('home.about')}}">{{ __('messages.About Us') }}</a></li> -->
                                <li><a href="{{ route('home.faq') }}">{{ __('messages.FAQ') }}</a></li>
                               
                                <li><a href="{{ route('home.services')}}">{{ __('messages.Services') }} </a></li>
                                <li><a href="{{ route('home.contact')}}">{{ __('messages.Contact us') }}</a></li>
                                <li><a href="{{ route('home.terms')}}">{{ __('messages.Terms and Conditions') }}</a></li>
                                {{-- <li><a href="{{ route('home.blog')}}">{{ __('messages.Blog') }}</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Our Services</h2>
                        </div>
                        <div class="f-contact">
                            <ul>
                            <li>
                                <i class="icon fal fa-phone"></i>
                                <span>{{$getSetting->phone}}</span>
                            </li>
                           <li><i class="icon fal fa-envelope"></i>
                                <span>
                                    <a href="mailto:{{$getSetting->email}}">{{$getSetting->email}}</a>
                               </span>
                            </li>
                            <li>
                                <i class="icon fal fa-map-marker-check"></i>
                                <span>{{$getSetting->address}}</span>
                            </li>

                        </ul>

                            </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="footer-widget newlater-footer mb-30">
                        <div class="f-widget-title mb-30">
                          <h3>Stay Updated !</h3>
                            <h5>Subscribe To Our Newsletter Now</h5>
                            <p>Mauris bibendum ornare vehicula. Pellentesque habitant morbi.</p>
                        </div>
                        <div class="footer-link">
                         <div class="subricbe p-relative" data-animation="fadeInDown" data-delay=".4s" >
                                    <form action="news-mail.php" method="post" class="contact-form ">
                                     <input type="text" id="email2" name="email2"  class="header-input" placeholder="Your Email..." required>
                                    <button class="btn"> Subscribe Now </button>
                                    </form>
                                </div>
                        </div>
                        <div class="footer-social  mt-30">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                       Copyright  © 2025 StarAgro. All rights reserved.
                </div>
                <div class="col-lg-6 text-right text-xl-right">

                </div>

            </div>
        </div>
    </div>
</footer>
