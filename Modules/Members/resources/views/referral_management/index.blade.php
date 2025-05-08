@extends('members::layouts.master')

@section('title', __('messages.Referral'))
@section('pagetitle', __('messages.Referral'))

@section('member')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <form class="d-flex me-5" method="GET" action="#">
                                
                            </form>

                            <div class="card p-4">
                            <h4>{{ __('messages.Your Referral Link') }}</h4>
                                <h6 class="text-muted mb-3">
                            {{ __('messages.Share this link with your friends, family, and network to earn reward points in your wallet.') }}
                            </h6>

                                <div class="input-group my-3">
                                    <input type="text" id="referralLink" class="form-control" value="{{ $referralLink }}"
                                        readonly>
                                    <button class="btn btn-primary" onclick="copyReferral()">Copy</button>
                                </div>
                                <small class="text-success" id="copyMsg" style="display: none;">Copied to
                                    clipboard!</small>
                                    <div class="mt-3">
                                        <p>{{__("messages.Share with friends:") }}</p>
                                        <a href="https://wa.me/?text={{ urlencode(__('messages.Hi! I’ve been using Star Agro and thought you’d find it useful too. You can register using my referral link to get started:') . $referralLink) }}" target="_blank" class="btn btn-success me-2">
                                             <i class="bi bi-whatsapp"></i>
                                         </a>
                                        <a href="mailto:?subject=Discover%20Star%20Agro&body={!!(__('messages.Hi there! I’m using Star Agro to manage and explore agricultural services. I highly recommend it. Register now using my referral link:') . $referralLink) !!}" class="btn btn-danger me-2">
                                             <i class="bi bi-envelope-fill"></i>
                                         </a>
                                         <!-- <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($referralLink) }}&quote={{ urlencode(__('messages.Hi! I’ve been using Star Agro and thought you’d find it useful too. You can register using my referral link to get started:')) }}" 
                                        target="_blank" class="btn btn-primary me-2">
                                        <i class="bi bi-facebook"></i>
                                        </a>    -->
                                    </div>
                            </div>
                           
                            <script>
                                function copyReferral() {
                                    const linkInput = document.getElementById("referralLink");
                                    linkInput.select();
                                    linkInput.setSelectionRange(0, 99999); // For mobile
                                    document.execCommand("copy");

                                    document.getElementById("copyMsg").style.display = "inline";
                                    setTimeout(() => {
                                        document.getElementById("copyMsg").style.display = "none";
                                    }, 2000);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
