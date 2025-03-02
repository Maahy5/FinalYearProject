<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Events</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    
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

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .content h2 {
            font-size: 32px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        #eventCalendar {
            max-width: 100%;
            overflow-x: auto;
        }
    </style>
</head>
<body class="bg-black">

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

    <!-- Main Content -->
    <div class="content">
        <h1 class="text-center mb-4 text-white fw-semibold"> Art Exhibition Schedules🎨</h1>

        <!-- Events Calendar -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-black text-white">
                <h4><i class="fas fa-calendar-alt"></i> Events Calendar</h4>
            </div>
            <div class="card-body">
                <div id="eventCalendar"></div>
            </div>
        </div>

        <!-- Manage Events Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4>Manage Events</h4>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    <i class="fas fa-plus"></i> Add Event
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Event Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</td>
                            <td>
                                <!-- Edit -->
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning m-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <!-- Delete -->
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline m-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($events->isEmpty())
                <p class="text-center text-muted">No events found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <!-- FullCalendar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarElem = document.getElementById('eventCalendar'); // Corrected ID
            var eventCalendar = new FullCalendar.Calendar(calendarElem, {
                initialView: 'dayGridMonth',
                events: {!! isset($events) ? json_encode($events->map(function($event){
                    return [
                        'title' => $event->title,
                        'start' => $event->event_date,
                        'url' => route('events.edit', $event->id),
                    ];
                })) : '[]' !!}
            });
            eventCalendar.render();
        });
    </script>

</body>
</html>
