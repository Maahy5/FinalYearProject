<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exhibitions - Muse Art</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
          body {
            font-family: 'Poppins', sans-serif;
        }
        .exhibition-title {
            margin-top: 10%;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 10px;
            transition: 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 15px;
        }
        .event-card {
            margin-top: 20px;
        }
         
        .card-text strong {
            color: #007bff;
        }
        #calendar {
            max-width: 100%;
            overflow-x: auto;
        }

        .fc-event{
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .fc-event:hover{
            transform: scale(1.05);
            z-index: 1;  
        }

    </style>
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
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('gallery.index') }}">Galleries</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="{{ route('wishlist.index') }}">Wishlist</a> <i class="fa fa-heart"></i></li>
                </ul>
            </div>
        </div>
    </nav>
</head>
<body class="bg-black">

    <div class="container mt-5 rounded-7">
        <h2 class="exhibition-title text-center text-white">Exhibitions Calendar</h2>

        <!-- Events Calendar -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-black text-white">
                <h4><i class="fas fa-calendar-alt"></i> Events Calendar</h4>
            </div>
            <div class="card-body ">
                <div id="calendar"></div>
            </div>
        </div>

<!-- Modal to Display Event Details -->

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventDetails">
                <!-- Event details will be dynamically inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


        <div class="row mt-4">
            @foreach ($events as $event)
                <div class="col-md-4 event-card">
                    <div class="card shadow-sm">
                        <h5><a href="{{ route('events.show', $event->id) }}"></a></h5>
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ $event->description }}</p>

                            @if (!empty($event->event_date))
                                <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>
                            @else
                                <p class="card-text"><strong>Date:</strong> Not Available</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap & FullCalendar Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        <!-- FullCalendar Script -->
        document.addEventListener('DOMContentLoaded', function () {
            var calendarElem = document.getElementById('calendar'); // Corrected ID
            var calendar = new FullCalendar.Calendar(calendarElem, {
                initialView: 'dayGridMonth',
                events: {!! isset($events) ? json_encode($events->map(function($event){
                    return [
                        'title' => $event->title,
                        'start' => $event->event_date,
                        'url' => route('events.edit', $event->id),
                    ];
                })) : '[]' !!},
                eventContent: function (arg) {
            let eventsTitle = document.createElement('div');
            eventsTitle.innerText = arg.event.title;
            eventsTitle.style.fontSize = "10px"; // Reduce font size
            eventsTitle.style.padding = "2px";   // Add padding
            eventsTitle.style.textAlign = "center"; // Center text
            eventsTitle.style.whiteSpace = "normal"; // Allow text to wrap
            
            
            return { domNodes: [eventsTitle] };
        }         
     });
            calendar.render();
        });
        </script>
        
</body>
</html>
