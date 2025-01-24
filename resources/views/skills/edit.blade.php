<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Skill</h1>
        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Skill Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
            </div>

            <div class="form-group">
                <label for="percentage">Skill Percentage</label>
                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ $skill->percentage }}" required min="0" max="100">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</body>
</html>
