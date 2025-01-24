<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Personal Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Personal Information</h1>
        <form action="{{ route('personalInfo.update', $personalInfo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $personalInfo->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $personalInfo->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a new password if you want to change it">
            </div>
            

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $personalInfo->phone }}">
            </div>

            <div class="form-group">
                <label for="intro_heading">Intro Heading</label>
                <input type="text" class="form-control" id="intro_heading" name="intro_heading" value="{{ $personalInfo->intro_heading }}">
            </div>

            <div class="form-group">
                <label for="intro_detail">Intro Detail</label>
                <textarea class="form-control" id="intro_detail" name="intro_detail">{{ $personalInfo->intro_detail }}</textarea>
            </div>

            <div class="form-group">
                <label for="cv">Upload CV</label>
                <input type="file" class="form-control-file" id="cv" name="cv">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</body>
</html>
