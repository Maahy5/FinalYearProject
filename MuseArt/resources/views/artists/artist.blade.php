<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
       body {
        background-color: #f8f9fa;
       }

       .notification-card {
           max-width: 400 px;
           background: gray;
           margin: 0%;
       }

       .btn-unique: hover {
        background-color: #0056b3;
       }

  </style>
</head>

<body class="bg-light">
  <nav>
        <li>
          <form method="POST" action="{{ route('logout') }}" class="d-inline text-black">
              @csrf
              <button type="submit" class="dropdown-item"><i class="fa-solid fa-sign-out-alt me-2"></i>Log Out</button>
          </form>
      </li>
  </nav>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
          <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 80%; width: 70%;" >
            <h2 class="text-center text-black mt-3 font-semibold"><i class="fa-solid fa-bell me-2"></i> Send Notification for Live Exhibitions </h2>
            @if(isset($subscribedUsers) && count($subscribedUsers) > 0)
            <ul class="group-list group-list-flush">
                @foreach($subscribedUsers as $user)
                    <li class="list-group-item">
                        <i class="fa-solid fa-user me-2"></i>{{ $user->name }} ({{ $user->email }})
                    </li>
                @endforeach
            </ul>
        @else
            <p>No subscribed users found.</p>
        @endif
        

              @if(isset($artist))
              <form action="{{ route('artist.sendNotifications', ['artistId' => $artist->id]) }}" method="POST">
               @csrf
               <div class="mb-3">
                  <label for="message" class="form-label fw-semibold">Notification Message</label>
                  <textarea class="form-control" v-model="message" name="message" id="message" rows="3"  required placeholder="Enter the notification message for subscribers here."></textarea>
               </div>

                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-paper-plane me-2"></i> Send Notifications</button>
                @else
                 <p>Errrooor</p>
                @endif
              </form>
                  <!--List of subscribed users-->
                    <div class="mt-4">
                      <h4 class="text-center font-semibold">Subscribed Users</h4>
                        <ul class="group-list group-list-flush">
                          @foreach($subscribedUsers as $user)
                            <li class="list-group-item"><i class="fa-solid fa-user me-2"></i>
                              <i class="fa-solid fa-user me-2"></i>{{ $user->name }} ({{ $user->email }})
                            </li>
                          @endforeach
                        </ul>
                    </div>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
  </html>