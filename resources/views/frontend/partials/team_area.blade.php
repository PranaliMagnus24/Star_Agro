<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

<!-- <section id="faq" class="faq-area pt-120 pb-100" style="background: url(frontend/assets/img/bg/faq-bg.png);background-size: cover; background-position: center center;">
     -->
<section id="faq" class="faq-area pt-120 pb-100 faq-bg">

    <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="about-title second-atitle mb-30">
                        <h5>{{ __('messages.FAQ') }}</h5>
                        <h2>{{ __('messages.Frequently Asked Quesions') }}</h2>
                </div>
            <div class="faq-wrap">
        <div class="accordion" id="accordionExample">
    @foreach($datas as $index => $data)
    <div class="card">
        <div class="card-header" id="heading{{ $index }}">
            <h2 class="mb-0">
                <button class="faq-btn collapsed" type="button" data-toggle="collapse" 
                        data-target="#collapse{{ $index }}" 
                        aria-expanded="false" 
                        aria-controls="collapse{{ $index }}">
                    {{ $data->question }}
                </button>
            </h2>
        </div>
        <div id="collapse{{ $index }}" class="collapse" 
             aria-labelledby="heading{{ $index }}" 
             data-parent="#accordionExample">
            <div class="card-body">
                {{ $data->answer }}
            </div>
        </div>
    </div>
    @endforeach

    <!-- Read More Button -->
    <div class="slider-btn mt-30">
        <a href="#" class="btn ss-btn mr-15" data-animation="fadeInRight" data-delay=".8s">
            {{ __('messages.Read More') }}
        </a>
    </div>
</div>

                </div>
            </div>
            <div class="col-lg-6 col-md-4">

            </div>


        </div>
    </div>
</section>
