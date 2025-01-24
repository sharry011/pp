<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Portfolio Submission</h1>

        <!-- Personal Info Form -->
        <form action="{{ url('/personal-info') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Personal Info</h2>
            
            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            
            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <!-- Phone Field -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <!-- Intro Heading Field -->
            <div class="form-group">
                <label for="intro_heading">Intro Heading:</label>
                <input type="text" id="intro_heading" name="intro_heading" class="form-control" required>
            </div>
            
            <!-- Intro Detail Field -->
            <div class="form-group">
                <label for="intro_detail">Intro Detail:</label>
                <textarea id="intro_detail" name="intro_detail" class="form-control" required></textarea>
            </div>
            
            <!-- CV Upload Field -->
            <div class="form-group">
                <label for="cv">Upload CV:</label>
                <input type="file" id="cv" name="cv" class="form-control" accept=".pdf,.doc,.docx">
            </div>
        
            <!-- Image Upload Field -->
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept=".jpeg,.jpg,.png">
            </div>
        
            <button type="submit" class="btn btn-primary">Submit Personal Info</button>
        </form>
        
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
