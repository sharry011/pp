<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Project</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $project->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="client">Client</label>
                <input type="text" name="client" id="client" class="form-control" value="{{ $project->client }}">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date }}">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date }}">
            </div>

            <div class="form-group">
                <label for="project_url">Project URL</label>
                <input type="url" name="project_url" id="project_url" class="form-control" value="{{ $project->project_url }}">
            </div>

            <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" name="cost" id="cost" class="form-control" value="{{ $project->cost }}" min="0">
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
</body>
</html>
