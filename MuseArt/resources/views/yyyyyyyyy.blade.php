<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100 rounded-4">
        <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Forgot your password?</h4>
                <p class="text-center text-muted mb-4">
                    No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>

                <!-- Session Status (You may want to replace this with actual status handling in your backend logic) -->
                <div class="alert alert-success mb-4" style="display:none;" id="session-status">
                    Your request was successful.
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" required autofocus>
                        <div class="invalid-feedback" id="email-error" style="display:none;">Please provide a valid email address.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-100">
                            Email Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
