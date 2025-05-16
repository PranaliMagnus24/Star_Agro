@extends('members::layouts.master')

@section('title', __('messages.Referral'))
@section('pagetitle', __('messages.Referral'))

@section('member')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                 <div class="card p-4">
                                <p style="font-weight: 700;font-size: 1.1rem;color: #2c3e50;background-color: #d4edda;padding: 10px 15px;border-radius: 8px;display: inline-block;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                {{__('messages.Total Referral Points Earned') }}:  <span style="color: #27ae60;">{{ $totalReferralPoints }}</span>
                                </p>
                                <h4>{{ __('messages.Your Referral Link') }}</h4>
                                <h6 class="text-muted mb-3">
                                    {{ __('messages.Share this link with your friends, family, and network to earn reward points in your wallet.') }}
                                </h6>

                                <div class="input-group my-3">
                                    <input type="text" id="referralLink" class="form-control" value="{{ $referralLink }}" readonly>
                                    <button class="btn btn-primary" onclick="copyReferral()">Copy</button>
                                </div>
                                <small class="text-success" id="copyMsg" style="display: none;">Copied to clipboard!</small>

                                <div class="mt-3">
                                    <p>{{__("messages.Share with friends:") }}</p>
                                    <a href="https://wa.me/?text={{ urlencode(__('messages.Hi! I’ve been using Star Agro and thought you’d find it useful too. You can register using my referral link to get started:') . $referralLink) }}" target="_blank" class="btn btn-success me-2">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a href="mailto:?subject=Discover%20Star%20Agro&body={!!(__('messages.Hi there! I’m using Star Agro to manage and explore agricultural services. I highly recommend it. Register now using my referral link:') . $referralLink) !!}" class="btn btn-danger me-2">
                                        <i class="bi bi-envelope-fill"></i>
                                    </a>
                                </div>

                                <!-- Total Referrals Count -->
                                <div class="mt-3">
                                <p>
                                    {!! __('messages.Total Referrals: :count', ['count' => '<span id="referralCount" style="cursor: pointer; color: blue;" onclick="showReferralDetails()">' . $totalReferrals . '</span>']) !!}
                                </p>

                                </div>

                                <!-- Referral User Details Table -->
                                <div id="userDetails" style="display: none;">
                                    <h5>{{ __('messages.User Referred by You: Details') }}</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            
                                                
                                                <th>{{ __('messages.Name') }}</th>
                                                <th>{{ __('messages.Phone') }}</th>
                                                <th>{{__('messages.Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userDetails as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
            </div>
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

        function showReferralDetails() {
            const userDetails = document.getElementById("userDetails");
            userDetails.style.display = userDetails.style.display === "none" ? "block" : "none";
        }
    </script>
@endsection
