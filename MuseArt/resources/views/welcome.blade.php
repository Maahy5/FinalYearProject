<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muse Art</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold  fs-3" href="#">Muse Art</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-sign-out-alt me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('login') }}">Log in</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link  fw-semibold" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
  </nav>

  <!-- Vue App -->
  <div id="app">
    <!-- Hero Section -->
    <div class="container mt-5 pt-5 text-center">
        <h1 class="display-4 text-dark">Welcome to Muse Art</h1>
        <p class="lead">Explore stunning art exhibitions and connect with talented artists.</p>
    </div>

    <!-- Featured Artworks Section -->
    <div class="container mt-4">
        <h2 class="text-center text-dark mb-4">Featured Artworks</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" data-masonry='{"percentPosition": true }'>
            @foreach ($products as $product)
                <div class="col">
                    <div class="card shadow-sm">
                        @if($product->image)
                            <div class="overflow-hidden position-relative">
                                <img 
                                    src="{{ asset('storage/' . $product->image) }}" 
                                    class="img-fluid w-100 rounded-2 artwork-img"
                                    :style="{ transition: 'transform 0.3s ease', transform: zoomedImages[{{ $product->id }}] ? 'scale(1.1)' : 'scale(1)' }"
                                    @mouseenter="zoomedImages[{{ $product->id }}] = true"
                                    @mouseleave="zoomedImages[{{ $product->id }}] = false"
                                    alt="{{ $product->name }}"
                                >
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-warning">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Meet the Artists Section -->
<div class="container mt-4">
    <h2 class="text-center text-light mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: bold;">
        Meet the Artists
    </h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($artists as $artist)
            <div class="col">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    @if($artist->image)
                        <img 
                            src="{{ asset('storage/' . $artist->image) }}" 
                            class="card-img-top"
                            alt="{{ $artist->name }}"
                            style="height: 300px; object-fit: cover;"
                        >
                    @endif
                    <div class="card-body text-center bg-white rounded-bottom-4">
                        <h5 class="card-title text-dark" style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: bold;">
                            {{ $artist->name }}
                        </h5>
                        <p class="card-text text-muted" style="font-family: 'Lora', serif; font-size: 1rem; font-weight: 500;">
                            {{ Str::limit($artist->bio, 100) }}
                        </p>
                        <a href="{{ route('artists.show', $artist->id) }}" class="btn btn-outline-primary" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Google Fonts (Add to <head>) -->
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">


<!-- Google Fonts (Add to <head>) -->
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">


  <!-- Vue & Bootstrap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.prod.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>

  <script>
    const app = Vue.createApp({
        data() {
            return {
                zoomedImages: {}
            };
        }
    });
    app.mount("#app");
  </script>

</body>
</html>
