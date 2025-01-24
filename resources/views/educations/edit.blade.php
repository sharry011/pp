<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Education</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Education</h1>
        <form action="{{ route('educations.update', $education->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="detail">Detail</label>
                <input type="text" name="detail" id="detail" class="form-control" value="{{ old('detail', $education->detail) }}" required>
                @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_year">Start Year</label>
                <input type="number" name="start_year" id="start_year" class="form-control" value="{{ old('start_year', $education->start_year) }}" required>
                @error('start_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_year">End Year</label>
                <input type="number" name="end_year" id="end_year" class="form-control" value="{{ old('end_year', $education->end_year) }}">
                @error('end_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($education->image)
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $education->image) }}" alt="Education Image" class="img-thumbnail" style="width: 150px; height: 150px;">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Education</button>
        </form>
    </div>
</body>
</html>
