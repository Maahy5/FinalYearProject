<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Exhibition Notification</title>
</head>
<body>
    <h2> {{ $event['title'] }} </h2>
    <p> {{ $event['description'] }} </p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event['event_date'])->format('F j, Y') }}</p>

    <p>Are you interested in this event?</p>
     
    <a href="{{ route('event.interested', ['id' => $event['id']]) }}"
        style="padding: 10% 20%; background: #28a745; color:black; text-decoration: none; border-radius: 5px;">

    Interested
    </a>

    <a href="#" onclick="alert('Thank you for your attention!'); return false;"
        style="padding: 10% 20%; background: #04250c; color:black; text-decoration: none; border-radius: 5px;">
     Not Interested
    </a>
</body>
</html>