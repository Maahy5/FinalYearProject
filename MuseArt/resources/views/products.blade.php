<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
     <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }

        /* Ensure Content Doesn't Overlap Sidebar */
        .content {

            margin-left: 270px; /* Push content to the right */
            padding: 20px;
        }

        .content h2 {
            font-size: 32px;
            color: #343a40;
            margin-bottom: 20px;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            transition: 0.3s;
        }
        
     </style>
</head>
    <body class="bg-light">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-white text-center mb-4">Admin Dashboard</h4>
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="{{ route('products') }}"><i class="fas fa-box"></i> Products</a>
            <a href="{{ route('artists') }}"><i class="fas fa-paint-brush"></i> Artists</a>
            <a href="{{ route('events') }}"><i class="fas fa-calendar"></i> Events</a>
            <a href="{{ route('user.index') }}"><i class="fas fa-users"></i> Manage Users</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-white ps-3">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Log Out
                </button>
            </form>
        </div>
       <div class="content">
            <h1 class="text-center mb-4">Manage Artworks</h1>
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4>Manage Events</h4>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
                                 <i class="fas fa-plus"></i> Add Products
                            </button>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                     @foreach($products as $product)
                        <div class="col">
                            <div class="card shadow-sm mb-4">
                             <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                             <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
    
                                                <!-- Long Description -->
                                                <p class="card-text"><strong>Details:</strong> {{ Str::limit($product->long_description, 100) }}</p>
    
                                                <!-- Edit and Delete Buttons -->
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
    
                                                <form action="{{ route('products.destroy', $product->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this artwork?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     </body>
</html>
