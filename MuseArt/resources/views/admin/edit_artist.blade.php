<!-- resources/views/admin/edit_product.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; ">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="container">
            <h1 class="text-center mb-4">Edit Artist</h1>

            <!-- Display Artist Info -->
            <form action="{{ route('artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Artist Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Artist Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $artist->name) }}" required>
                </div>

                <!-- Bio -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio', $artist->bio) }}</textarea>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $artist->email) }}" required>
                </div>

                <!-- Artist Image (Optional) -->
                <div class="mb-3">
                    <label for="image" class="form-label">Artist Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Artist</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for form validation or other JS components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
