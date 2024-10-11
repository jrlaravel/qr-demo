<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Content</title>
</head>
<body>
    <div style="text-align: center; padding: 50px;">
        <h1>Add New Content</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div>
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" required>
            </div>
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="body">Body:</label>
                <textarea name="body" id="body" required></textarea>
            </div>
            <div>
                <label for="website">Website:</label>
                <input type="text" name="website" id="website" required placeholder="https://example.com">
            </div>
            <button type="submit">Add Content</button>
        </form>
        
    </div>

    <h2>Existing Slugs</h2>

    <ul>
        @foreach ($contents as $content)
            <li>{{ $content->slug }}</li>
        @endforeach
    </ul>

</body>
</html>
