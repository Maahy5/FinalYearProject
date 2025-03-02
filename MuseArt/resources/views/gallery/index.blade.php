<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galleries</title>

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

        .artwork-img {
            animation: floatEffect 3s ease-in-out infinite; /* Floating effect */
        }

        .card {
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-body {
            background: #f8f9fa;
        }
    </style>
</head>
<body class="bg-black">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">Muse Art</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('home') }}"><i class="fa fa-home me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('exhibitions.events') }}"><i class="fa fa-calendar me-1"></i> Exhibitions</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('wishlist.index') }}"><i class="fa fa-heart me-1"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('notification.index') }}"><i class="fa fa-bell me-1"></i> Notifications</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Gallery Section -->
    <div id="app" class="container mt-5">
        <h1 class="text-center py-5 text-white">Gallery of Artworks</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="{{ route('gallery.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                            
                            <p class="card-text">
                                <span class="short-text">
                                    {{ Str::limit($product->long_description, 50, '...') }}
                                </span>
                                <span class="full-text d-none">
                                    {{ $product->long_description }}
                                </span>
                                <a href="javascript:void(0);" class="read-more text-primary fw-bold" onclick="toggleReadMore(this)">Read More</a>
                            </p>

                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-warning">Add to Wishlist <i class="fa fa-heart"></i></button>
                            </form>

                            <a href="{{ route('gallery.show', $product->id) }}" class="btn btn-primary btn-sm mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap & Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.min.js"></script>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    expanded: {}
                };
            },
            methods: {
                toggleReadMore(event) {
                    const cardText = event.closest('.card-text');
                    const shortText = cardText.querySelector('.short-text');
                    const fullText = cardText.querySelector('.full-text');
                    
                    if (shortText.classList.contains('d-none')) {
                        shortText.classList.remove('d-none');
                        fullText.classList.add('d-none');
                        event.textContent = "Read More";
                    } else {
                        shortText.classList.add('d-none');
                        fullText.classList.remove('d-none');
                        event.textContent = "Read Less";
                    }
                }
            }
        });

        app.mount("#app");

        function toggleReadMore(link) {
            let cardText = link.closest('.card-text');
            let shortText = cardText.querySelector('.short-text');
            let fullText = cardText.querySelector('.full-text');

            if (shortText.classList.contains('d-none')) {
                shortText.classList.remove('d-none');
                fullText.classList.add('d-none');
                link.textContent = "Read More";
            } else {
                shortText.classList.add('d-none');
                fullText.classList.remove('d-none');
                link.textContent = "Read Less";
            }
        }
    </script>
</body>
</html>
