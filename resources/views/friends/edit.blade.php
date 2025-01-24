<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Friend</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Friend</h1>
        <form action="{{ route('friends.update', $friend->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $friend->name }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($friend->image)
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $friend->image) }}" alt="Friend Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Friend</button>
        </form>
    </div>
</body>
</html>
