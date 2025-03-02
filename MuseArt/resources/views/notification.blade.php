<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exhibition Notifications</title>

 <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold  fs-3" href="#">Muse Art</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('exhibitions.events') }}">Exhibitions</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('gallery.index') }}">Galleries</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('wishlist.index') }}">Wishlist <i class="fa fa-heart"></i></a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('notification.index') }}"> Notifications <i class="fa fa-bell"></i></a></li>
            </ul>
        </div>
    </div>
   </nav>
         
</head>
<body class="bg-white">
    <div class="container mt-5">
        <h2 class="text-center py-5">Exhibition Notifications</h2>
            @if($exhib_notifications->isEmpty())
            <p>No any new notifications.</p>

            @else
            <div class="list-group">
                @foreach($exhib_notifications as $notification)
                    <div class="list-group-item">
                        <h5><strong>{{ $notification->data['event_name'] ?? 'Untitiled Event' }}</strong></h5>
                        <p>{{ $notification->data['event_description'] ?? 'No description available.' }}</p>
                        <p><strong>Location:</strong> {{ $notification->data['event_date'] ?? 'N/A' }} </p>
                        <a  href="{{ route('events.show', $notification->data['event_id'] ?? '#')  }}" class="btn btn-info btn-sm">View Exhibitions</a>
                    </div>
                @endforeach
            </div>


            <!--Pagination-->
            </div class="mt-4">
                {{ $exhib_notifications->links() }}
            </div>
     @endif
 </div>

</body>
</html>