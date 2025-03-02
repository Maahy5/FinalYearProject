<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-5">Edit Artist</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Artist Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Artist Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $artist->name) }}" required>
            </div>

            <!-- Artist Bio -->
            <div class="mb-3">
                <label for="bio" class="form-label">Artist Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="5" required>{{ old('bio', $artist->bio) }}</textarea>
            </div>

            <!-- Artist Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Artist Image</label>
                <input type="file" class="form-control" id="image" name="image">
                
                @if ($artist->image)
                    <p class="mt-2">
                        <strong>Current Image:</strong><br>
                        <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" style="width: 200px; height: auto;">
                    </p>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Artist</button>
        </form>

        <!-- Back to Artists List Button -->
        <a href="{{ route('artists.index') }}" class="btn btn-secondary mt-3">Back to Artists</a>

    </div>

    <!-- Optional: Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
