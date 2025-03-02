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

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">


        <style>
             body {
            font-family: 'Poppins', sans-serif;
        }

            /* Floating Animation */
            @keyframes floatEffect {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); } /* Moves up */
                100% { transform: translateY(0px); } /* Back to normal */
            }
            
            .artwork-img {
                animation: floatEffect 3s ease-in-out infinite; /* Floating effect */
            }
            </style>
            
</head>
<body class="bg-black">

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold  fs-3" href="#">Muse Art</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('home') }}"><i class="fa fa-home me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('exhibitions.events') }}"><i class="fa fa-calendar me-1"></i> Exhibitions</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('gallery.index') }}">Galleries</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('wishlist.index') }}">Wishlist <i class="fa fa-heart"></i>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('notification.index') }}">Notification<i class="fa fa-bell"></i>
                </a>
            </li>
                


            @if (Route::has('login'))
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="fa-solid fa-user me-2"></i> Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-sign-out-alt me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
            @else
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('login') }}">Log in</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            @endif
            </ul>
        </div>
    </div>
  </nav>

  <!-- Vue App -->
  <div id="app" style="margin-top: 5px;">

    <!-- Featured Artworks Section -->
    <div class="container pt-5 mt-5">
        <h2 class="text-center text-dark mb-4">Artworks Collection</h2>
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
                            <a href="{{ route('gallery.index') }}" class="btn btn-warning">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Meet the Artists Section -->
<div class="container mt-8">
    <h2 class="text-center mb-4">
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
                        <h5 class="card-title text-dark">{{ $artist->name }}</h5>
                        
                        <!-- Artist Bio with Read More Feature -->
                        <p class="card-text">
                            <span v-if="expandedBios[{{ $artist->id }}]">
                                {{ $artist->bio }}
                            </span>
                            <span v-else>
                                {{ Str::limit($artist->bio, 100) }}
                            </span>
                        </p>

                        <!-- Read More / Read Less Button -->
                        <button class="btn btn-link p-0 text-primary" @click="toggleBio({{ $artist->id }})">
                            <span v-if="expandedBios[{{ $artist->id }}]">Read Less</span>
                            <span v-else>Read More</span>
                        </button>


                        @if(Auth::check()) 
                            @if(Auth::user()->subscribedArtists->contains($artist->id))
                                <form action="{{ route('unsubscribe', $artist->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa-solid fa-user-minus me-2"></i> Unsubscribe
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('subscribe', $artist->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-user-plus me-2"></i> Subscribe
                                    </button>
                                </form>
                                    @endif
                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
    </div>
</div>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">


<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">


  <!-- Vue & Bootstrap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.prod.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>

  <script>
    const app = Vue.createApp({
        data() {
            return {
                zoomedImages: {},
                expandedBios: {}
            };
        },
        methods: {
            toggleBio(artistId) {
                this.expandedBios[artistId] = !this.expandedBios[artistId];
            }
        },
    });
    app.mount("#app");
  </script>

</body>
</html> 