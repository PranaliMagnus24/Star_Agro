<section id="home" class="slider-area slider-four fix p-relative">

    <div class="slider-active">
    <div class="single-slider slider-bg d-flex align-items-center" style="background: url(frontend/assets/img/slider/slider_img_bg.png) no-repeat;background-size: cover; background-position: center center;">
            <div class="container">
               <div class="row justify-content-center pt-50">
                    <div class="col-lg-10 col-md-10">
                        <div class="slider-content s-slider-content">
                            {{-- <h5 data-animation="fadeInDown" data-delay=".4s">शेतकऱ्याचे हक्काचे व्यासपीठ</h5> --}}
                             <h2 data-animation="fadeInUp" data-delay=".4s">शेतकरी हिताय । शेतकरी सुखाय ॥ </h2>
                            <p data-animation="fadeInUp" data-delay=".6s">वाळवा, टिकवा, मुल्यवर्धन करा</p>

                             <div class="slider-btn mt-30">
                                <a href="{{ route('home.contact')}}" class="btn ss-btn mr-15" data-animation="fadeInRight" data-delay=".8s">{{ __('messages.Contact us') }}</a>
                                  {{-- <a href="services.html" class="btn ss-btn active mr-15" data-animation="fadeInRight" data-delay=".8s">{{ __('messages.Contact us') }}</a> --}}

                            </div>

                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-2">
                        <div class="slider-img" data-animation="fadeInUp" data-delay=".4s">
                       <img src="{{asset('frontend/assets/img/slider/slider_img05.png') }}" alt="slider_img05">
                        </div>
                    </div> -->
                    <div class="col-lg-2 col-md-2 d-none d-md-block">
    <div class="slider-img" data-animation="fadeInUp" data-delay=".4s">
        <img src="{{ asset('frontend/assets/img/slider/slider_img05.png') }}" alt="slider_img05">
    </div>
</div>

                </div>
            </div>
        </div>


        </div>

    <div class="back-to-top text-center">
        <a href="#about2" class="smoth-scroll"><img src="{{asset('frontend/assets/img/bg/back-to-top.png') }}" alt="back-to-top"></a>
    </div>


</section>
