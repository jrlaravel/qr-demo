<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Websites</h1>
    <a href="{{ route('admin.websites.create') }}">Add New Website</a>

    <ul>
        @foreach($websites as $website)
            <li>{{ $website->domain }} - {{ $website->path }}
                <a href="{{ route('admin.websites.edit', $website->id) }}">Edit</a>
                <a href="{{route('api/script',$website->id)}}">generate script</a>
                <form action="{{ route('admin.websites.destroy', $website->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>