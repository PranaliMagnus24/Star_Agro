@extends('members::layouts.master')

@section('title', __('messages.Recharge'))
@section('pagetitle', __('messages.Recharge'))

@section('member')


    <h2>{{__('messages.Complete Your Payment') }}</h2>
  <!-- Input for amount -->
    <!-- Form for entering the payment amount -->
    <label for="amount">{{__('messages.Amount (₹):') }}</label>
    <input type="number" id="amount" placeholder="{{__('messages.Enter amount min 100Rs') }}" required min="100">
    <button id="pay-btn">{{__('messages.Proceed to Pay') }}</button>


    <script>
        document.getElementById('pay-btn').addEventListener('click', function() {
            

            let enteredAmount = document.getElementById('amount').value;

            // Validate the entered amount
            if (!enteredAmount || enteredAmount <= 0) {
                 Swal.fire({
                icon: 'error',
                title: 'Invalid Amount',
                text: 'Please enter an amount of at least ₹100.',
                confirmButtonText: 'OK'
            });
                return;
            }
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Dynamically create a hidden input for the amount to be submitted with the form
            // let amountInput = document.createElement("input");
            // amountInput.setAttribute("type", "hidden");
            // amountInput.setAttribute("name", "amount");
            // amountInput.setAttribute("value", enteredAmount);
            // this.appendChild(amountInput);

            

            // Send the amount to the backend to create the Razorpay order
            fetch("{{ route('razorpay.createOrder') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken 
                   
                },
                
                body: JSON.stringify({ amount: enteredAmount })
            })
            .then(response => response.json())
            .then(data => {
                if (data.orderId) {
                    // console.log(data);

                    // Razorpay order creation was successful, proceed with payment
                    var options = {
                        "key": "{{ $razorpayKey }}", // Your Razorpay Key ID
                        "amount": enteredAmount * 100, // Amount in paise
                        "currency": "INR",
                        "name": "{{ $userName }}",
                        "description": "Payment for Order #" + data.orderId,
                        "image": "https://example.com/your_logo.png",
                        "order_id": data.orderId,// The Razorpay order ID created in the backend
                        "handler": function (response) {
                            // Payment successful: submit payment details
                            let form = document.createElement('form');
                            form.setAttribute('method', 'POST');
                            form.setAttribute('action',  "{{ route('razorpay.verifyPayment') }}");


                             // Add CSRF token
                             let csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = csrfToken;
                            form.appendChild(csrfInput);

                            let paymentIdInput = document.createElement('input');
                            paymentIdInput.setAttribute('type', 'hidden');
                            paymentIdInput.setAttribute('name', 'razorpay_payment_id');
                            paymentIdInput.setAttribute('value', response.razorpay_payment_id);
                            form.appendChild(paymentIdInput);

                            let orderIdInput = document.createElement('input');
                            orderIdInput.setAttribute('type', 'hidden');
                            orderIdInput.setAttribute('name', 'razorpay_order_id');
                            orderIdInput.setAttribute('value', data.orderId);
                            form.appendChild(orderIdInput);

                            let amountInput = document.createElement('input');
                            amountInput.setAttribute('type', 'hidden');
                            amountInput.setAttribute('name', 'amount');
                            amountInput.setAttribute('value', enteredAmount);
                            form.appendChild(amountInput);

                            document.body.appendChild(form);
                            form.submit();
                        },
                        "theme": {
                            "color": "#F37254"
                        }
                    };

                    // Open the Razorpay payment popup
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                } else {
                    alert("Error creating Razorpay order. Please try again.");
                }
            })
            .catch(error => {
                alert("Error: " + error);
            });
        });
    </script>
     <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection
