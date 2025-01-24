<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Experience</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Experience</h1>
        <form action="{{ route('experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="heading">Heading</label>
                <input type="text" name="heading" id="heading" class="form-control" value="{{ $experience->heading }}" required>
            </div>

            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" class="form-control" required>{{ $experience->detail }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($experience->image)
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $experience->image) }}" alt="Experience Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Experience</button>
        </form>
    </div>
</body>
</html>
