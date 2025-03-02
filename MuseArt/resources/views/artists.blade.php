<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Artists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        .card:hover {
            transform: scale(1.02);
        }

        /* Fix Table Layout */
        .table th, .table td {
            vertical-align: middle;
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
        <h1 class="text-center mb-5">🎨 Artists</h1>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4>Manage Events</h4>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    <i class="fas fa-plus"></i> Add Artists
                </button>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($artists as $artist)
                <div class="col">
                    <div class="card shadow-sm mb-4">
                        <!--Specifying the location of image directory-->
                        <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $artist->name }}</h5>
                            <!--Limiting description shown to 100-->
                            <p class="card-text">{{ Str::limit($artist->bio, 100) }}</p> 
                                    
                            <!-- Edit Button -->
                            <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                                    
                            <!-- Delete Button -->
                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this artist?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
     </div>

    

        <div class="row g-4">
           
        </div>
    </div>

    <!-- Optional: Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
