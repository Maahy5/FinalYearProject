<form action="{{ url('/admin/products') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Image:</label>
    <input type="file" name="name" required>

    <label>Description:</label>
    <input name="description" required>

    <label>Description:</label>
    <textarea name="description" required>

    <label>Long Description:</label>
    <textarea name="long_description" required>

    <label>Price:</label>
    <input type="number" name="price" required>

    <button type="submit">Save Product</button>
    </form>