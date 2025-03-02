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

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="container">
            <h1 class="text-center mb-4">Edit Product</h1>

            <!-- Display Product Info -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Long Description -->
                <div class="mb-3">
                    <label for="long_description" class="form-label">Long Description</label>
                    <textarea name="long_description" id="long_description" class="form-control" rows="4">{{ old('long_description', $product->long_description) }}</textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required step="0.01">
                </div>

                <!-- Product Image (Optional) -->
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for form validation or other JS components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
