<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wishlist</title>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-OYtfQLIh44db+qhIErkWKrmij09a8CNwItEH4yiRIY0gZhRj2sKNIIsRrvEPdqMbgzT1opjSAJXsteTfxuJjOQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Styling for Poppins font -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">Muse Art</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('exhibitions.events') }}"><i class="fa fa-calendar"></i> Exhibitions</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('gallery.index') }}"><i class="fa fa-image"></i> Galleries</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('notification.index') }}"><i class="fa fa-bell"></i> Notifications</a></li>
                </ul>
            </div>
        </div>
    </nav>

</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center py-5 text-primary mt-7">My Wishlist</h2>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($wishlistItems->isEmpty())
        <div class="text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/1178/1178428.png" alt="Empty Wishlist" class="img-fluid" width="200">
            <p class="text-muted mt-3">Your wishlist is empty.</p>
        </div>
        <a href="{{ route('gallery.index') }}" class="btn btn-primary">Explore Products</a>
        @else
        <div class="row">
            @foreach ($wishlistItems as $wishlist)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="card-img-top" alt="{{ $wishlist->product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                        <p class="card-text">{{ $wishlist->product->long_description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $wishlist->product->price }}</p>

                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
