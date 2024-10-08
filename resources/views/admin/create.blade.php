<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ isset($website) ? 'Edit Website' : 'Add New Website' }}</h1>

    <form action="{{ isset($website) ? route('admin.websites.update', $website->id) : route('admin.websites.store') }}" method="POST">
        @csrf
        @if(isset($website))
            @method('PUT')
        @endif

        <label>Domain:</label>
        <input type="text" name="domain" value="{{ isset($website) ? $website->domain : old('domain') }}" required>

        <label>Path:</label>
        <input type="text" name="path" value="{{ isset($website) ? $website->path : old('path') }}" required>

        <label>Content:</label>
        <textarea name="content" required>{{ isset($website) ? $website->content : old('content') }}</textarea>

        <button type="submit">{{ isset($website) ? 'Update Website' : 'Add Website' }}</button>
    </form>
</body>
</html>