<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary mb-3">Back to Gallery</a>
        <div class="row">
            <div class="col-md-6">
                <!-- Displaying the product image -->
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->description }}</p>
                <h4><strong>Price:</strong> NPR{{ number_format($product->price, 2) }}</h4>
                <p>
                    <strong>Additional Details:</strong>
                    {!! nl2br(e($product->long_description)) !!}
                </p>
                <!-- Payment Button -->
                <button type="button" id="pay-button" class="btn btn-primary">Pay with Khalti</button>
            </div>
        </div>
    </div>

<script src="https://cdn.khalti.com/khalti-checkout.js"></script>
<script>
    // Initialize Khalti Checkout
    var config = {
        publicKey: "0963c0e751344200b05a752357cc176c", // Your public key
        productIdentity: "{{ $product->id }}", // Product ID
        productName: "{{ $product->name }}", // Product Name
        productUrl: "{{ url()->current() }}", // Current page URL for the product
        transactionAmount: {{ $product->price * 100 }}, // Transaction amount (converted to paisa)
        eventHandler: {
            onSuccess: function (payload) {
                // Handle the successful payment payload (token) here
                console.log("Payment Successful! Payload:", payload);
                // Send the token and amount to your server for verification and order processing
                fetch('{{ route('verify.payment') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        token: payload.token,
                        amount: config.transactionAmount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Payment Successful!') {
                        alert('Payment was successful.');
                    } else {
                        alert('Payment verification failed.');
                    }
                })
                .catch(error => console.error('Error:', error));
            },
            onError: function (error) {
                alert("Payment Error: " + error);
            },
            onClose: function () {
                console.log("Payment popup closed");
            }
        }
    };

    // Initialize Khalti Checkout instance
    var checkout = new KhaltiCheckout(config);

    // Trigger Khalti Checkout when the button is clicked
    document.getElementById("pay-button").onclick = function () {
        checkout.show({ 
            amount: config.transactionAmount
        });
    };
</script>

</body>
</html>
