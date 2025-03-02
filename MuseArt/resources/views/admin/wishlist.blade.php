<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212; 
            color: white;
        }
        .wishlist-container {
            max-width: 900px;
            margin: 50px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }
        .wishlist-item {
            background: #333;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .wishlist-item h6 {
            margin: 0;
            color: #007bff;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
        }
        .delete-btn:hover {
            color: darkred;
        }
</head>
<body>
    
    <!-- Navbar -->
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white text-center mb-4">Admin Dashboard</h4>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('products') }}"><i class="fas fa-box"></i> Products</a>
        <a href="{{ route('artists') }}"><i class="fas fa-paint-brush"></i> Artists</a>
        <a href="{{ route('events') }}"><i class="fas fa-calendar"></i> Events</a>
        <a href="{{ route('user.index') }}"><i class="fas fa-users"></i> Manage Users</a>
    </div>

    <!-- Wishlist Management -->
    <div class="container wishlist-container">
        <h3 class="text-center text-primary">User Wishlists</h3>

        <!-- Search Bar -->
        <input type="text" id="searchUser" class="form-control mb-3" placeholder="Search by user name..." onkeyup="searchUsers()">

        <!-- Wishlist Table -->
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Item</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="wishlistTable">
                    @foreach ($wishlists as $wishlist)
                    <tr class="wishlist-row">
                        <td>{{ $wishlist->user->name }}</td>
                        <td>{{ $wishlist->item->title }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="deleteWishlist({{ $wishlist->id }})">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($wishlists->isEmpty())
            <p class="text-center text-warning">No wishlist items found.</p>
        @endif
    </div>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function searchUsers() {
            let input = document.getElementById("searchUser").value.toLowerCase();
            let rows = document.querySelectorAll(".wishlist-row");

            rows.forEach(row => {
                let userName = row.children[0].textContent.toLowerCase();
                row.style.display = userName.includes(input) ? "" : "none";
            });
        }

        function deleteWishlist(id) {
            if (confirm("Are you sure you want to remove this item from the wishlist?")) {
                $.ajax({
                    url: `/admin/wishlist/${id}`,
                    type: "DELETE",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(err) {
                        alert("Error removing item.");
                    }
                });
            }
        }
    </script>

</body>
</html>