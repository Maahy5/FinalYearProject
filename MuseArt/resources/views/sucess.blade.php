<!-- resources/views/payment/success.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Your payment has been successfully processed. Transaction ID: {{ $transaction_id }}</p>
    <a href="/">Go back to home</a>
</body>
</html>
