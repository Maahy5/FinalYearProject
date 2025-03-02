<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Muse Art</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .card {
            border-radius: 10px;
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .btn-add {
            margin-top: -40px;
            margin-bottom: 10px;
        }
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
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .content h2 {
            font-size: 32px;
            color: #343a40;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .modal-content {
            border-radius: 10px;
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

    <!-- Main Content Area -->
    <div class="content">
        <h2>Admin Dashboard</h2>

        <!-- Statistics Overview -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm bg-info text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Users</h5>
                        <p class="fs-3">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-warning text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Artists</h5>
                        <p class="fs-3">{{ \App\Models\Artist::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Products</h5>
                        <p class="fs-3">{{ \App\Models\Product::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-warning text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Events</h5>
                        <p class="fs-3">{{ \App\Models\Event::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Product & Artist Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArtistModal">
                <i class="fas fa-plus"></i> Add Artist
            </button>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addEventModal">
                <i class="fas fa-plus"></i> Add Event
            </button>
        </div>

        <!-- Manage Products Section -->
        <div class="card mt-5 shadow-sm">
            <div class="card-header bg-warning text-white">
                <h4>Manage Products</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Product::all() as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage Artists Section -->
        <div class="card mt-5 shadow-sm">
            <div class="card-header bg-success text-white">
                <h4>Manage Artists</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Bio</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Artist::all() as $artist)
                            <tr>
                                <td>{{ $artist->id }}</td>
                                <td>{{ $artist->name }}</td>
                                <td>{{ $artist->bio }}</td>
                                <td>
                                    <a href="{{ route('artists.show', $artist->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage Events Section -->
        <div class="card mt-5 shadow-sm">
            <div class="card-header bg-info text-white">
                <h4>Manage Events</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Event Title</th>
                            <th>Event Description</th>
                            <th>Event Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Event::all() as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal for Add Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea class="form-control" name="long_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <button type="submit" class="btn btn-warning">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Artist -->
    <div class="modal fade" id="addArtistModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add New Artist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb -3">
                            <label class="form-label">Artist Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <button type="submit" class="btn btn-success">Add Artist</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Event -->
    <div class="modal fade" id="addEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Add New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date</label>
                            <input type="date" class="form-control" name="event_date" required>
                        </div>
                        <button type="submit" class="btn btn-info">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
