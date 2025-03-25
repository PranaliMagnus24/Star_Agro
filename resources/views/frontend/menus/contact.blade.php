@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>Contact us</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section id="services" class="services-area pt-120 pb-90 fix">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
             <div class="col-lg-6 col-md-6">

               <div class="services-box text-center mb-30">
                  <div class="services-icon">
                       <i class="fal fa-envelope"></i>
                    </div>
                   <div class="services-content2">
                        <h5>Email Address</h5>
                        <p>info@webexample.com <br/> jobs@webtrueexample.com</p>
                    </div>
                </div>


            </div>
             <div class="col-lg-6 col-md-6">

               <div class="services-box text-center mb-30">
                  <div class="services-icon">
                       <i class="fal fa-phone-alt"></i>
                    </div>
                   <div class="services-content2">
                        <h5>Phone Number</h5>
                         <p>090-098-765-09 <br/>093-456-432-654-7</p>

                    </div>
                </div>


            </div>
             <div class="col-lg-6 col-md-6">

              <div class="services-box text-center mb-30">
                  <div class="services-icon">
                      <i class="fal fa-map-marked"></i>
                    </div>
                   <div class="services-content2">
                        <h5>Office Address</h5>
                        <p>12/A, Miranda Halim Tower,<br>New York, USA</p>
                    </div>
                </div>


            </div>
             <div class="col-lg-6 col-md-6">

              <div class="services-box text-center mb-30">
                  <div class="services-icon">
                     <i class="fal fa-alarm-clock"></i>
                    </div>
                   <div class="services-content2">
                        <h5>Timeing</h5>
                        <p>Monday - Friday <br>9am - 6pm</p>
                    </div>
                </div>


            </div>

        </div>

            </div>
            <div class="col-lg-6">
             <div class="contact-bg02 ">
                <div class="section-title  mb-50">
                    <h5>Contact</h5>
                    <h2>
                        Get A Quote
                    </h2>

                </div>

            <form action="mail.php" method="post" class="contact-form mt-30">
                <div class="row">
                <div class="col-lg-6">
                    <div class="contact-field p-relative c-name mb-30">
                        <input type="text" id="firstn" name="firstn" placeholder="First Name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-field p-relative c-email mb-30">
                        <input type="text" id="lastn" name="lastn" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-field p-relative c-subject mb-30">
                        <input type="text" id="email" name="email" placeholder="Eamil" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-field p-relative c-subject mb-30">
                        <input type="text" id="phone" name="phone" placeholder="Phone No." required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="contact-field p-relative c-option mb-30">
                        <input type="text" id="subject" name="phone" placeholder="Subject" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="contact-field p-relative c-message mb-30">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Write comments"></textarea>
                    </div>
                    <div class="slider-btn">
                                <button class="btn ss-btn active" data-animation="fadeInRight" data-delay=".8s">Submit Now</button>
                            </div>
                </div>
                </div>

        </form>

                </div>
            </div>
        </div>


    </div>
</section>

@endsection
