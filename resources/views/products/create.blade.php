<h1>Create a new product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
    </div>

    <div>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            <option value="standard">standard</option>

        </select>
    </div>

    <button type="submit">Create</button>
</form>