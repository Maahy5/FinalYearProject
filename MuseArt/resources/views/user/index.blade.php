<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
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

    
 </style>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-white text-center mb-4">Admin Dashboard</h4>
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="{{ route('products') }}"><i class="fas fa-box"></i> Products</a>
    <a href="{{ route('artists') }}"><i class="fas fa-paint-brush"></i> Artists</a>
    <a href="{{ route('events') }}"><i class="fas fa-calendar"></i> Events</a>
    <a href="{{ route('user.index') }}"><i class="fas fa-users"></i> Manage Users</a>
</div>

<body class="content">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Users</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">All Users</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <!-- Edit User Button -->
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete User Button -->
                                    <form action="{{ route('admin.wishlist.destroy', $user->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination (if necessary) -->
        {{ $users->links() }}

        <!-- Wishlist Management Section -->
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Manage Wishlists</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>Product Name</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @foreach($user->wishlist as $item)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.wishlist.destroy', $item->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this item?')">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm">
                                              <i class="fas fa-trash"></i> Delete
                                          </button>
                                      </form>
                                      
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                @if($users->isEmpty() || $users->every(fn($user) => $user->wishlist->isEmpty()))
                    <p class="text-center">No wishlist items found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Optional: Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
