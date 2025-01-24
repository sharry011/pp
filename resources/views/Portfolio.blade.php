<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .tab-content {
            margin-top: 20px;
        }
        .btn-primary, .btn-secondary {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('/view-portfolio') }}" class="btn btn-info">View Portfolio</a>
        </div>

        <h1 class="text-center"> Add Portfolio Submission</h1>
        <ul class="nav nav-tabs" id="portfolioTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="skills-tab" data-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="true">Skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="false">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoice</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Skills Tab -->
            <div class="tab-pane fade show active" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                <form action="{{ url('/skills') }}" method="POST">
                    @csrf
                    <h2>Skills</h2>
                    <div id="skillsContainer">
                        <div class="form-group">
                            <label for="skill_name">Skill Name:</label>
                            <input type="text" name="skills[0][name]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="skill_percentage">Skill Percentage:</label>
                            <input type="number" name="skills[0][percentage]" class="form-control" min="0" max="100" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addSkill()">Add More Skills</button>
                    <button type="submit" class="btn btn-primary">Submit Skills</button>
                </form>
            </div>

            <!-- Experience Tab -->
            <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                <form action="{{ url('/experience') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Experience</h2>
                    <div id="experienceContainer">
                        <div class="form-group">
                            <label for="experience_image">Add Image:</label>
                            <input type="file" name="experiences[0][image]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="experience_heading">Experience Heading:</label>
                            <input type="text" name="experiences[0][heading]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="experience_detail">Experience Detail:</label>
                            <textarea name="experiences[0][detail]" class="form-control" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addExperience()">Add More Experience</button>
                    <button type="submit" class="btn btn-primary">Submit Experience</button>
                </form>
            </div>

            <!-- Education Tab -->
            <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                <form action="{{ url('/education') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Education</h2>
                    <div id="educationContainer">
                        <div class="form-group">
                            <label for="education_image">Add Image:</label>
                            <input type="file" name="educations[0][image]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="education_detail">Education Detail:</label>
                            <input type="text" name="educations[0][detail]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="education_year_start">Start Year:</label>
                            <input type="text" name="educations[0][start_year]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="education_year_end">End Year:</label>
                            <input type="text" name="educations[0][end_year]" class="form-control" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addEducation()">Add More Education</button>
                    <button type="submit" class="btn btn-primary">Submit Education</button>
                </form>
            </div>

            <!-- Friends Tab -->
            <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                <form action="{{ url('/friends') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Add Friends</h2>
                    <div id="friendsContainer">
                        <div class="form-group">
                            <label for="friend_name">Friend Name:</label>
                            <input type="text" name="friends[0][name]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="friend_image">Friend Image:</label>
                            <input type="file" name="friends[0][image]" class="form-control" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addFriend()">Add More Friends</button>
                    <button type="submit" class="btn btn-primary">Submit Friends</button>
                </form>
            </div>

            <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                <form action="{{ url('/invoices') }}" method="POST">
                    @csrf
                    <h2>Create Invoice</h2>
            
                    <!-- Client Name -->
                    <div class="form-group">
                        <label for="client_name">Client Name:</label>
                        <input type="text" id="client_name" name="client_name" class="form-control" required>
                        @error('client_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Project Name -->
                    <div class="form-group">
                        <label for="project_name">Project Name:</label>
                        <input type="text" id="project_name" name="project_name" class="form-control" required>
                        @error('project_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category" class="form-control" required>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price ($):</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Invoice</button>
                </form>
            </div>

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
                <form action="{{ url('/projects') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Create New Project</h2>
                    
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Project Title:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Client -->
                    <div class="form-group">
                        <label for="client">Client:</label>
                        <input type="text" id="client" name="client" class="form-control" value="{{ old('client') }}">
                        @error('client')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Start Date -->
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- End Date -->
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Project URL -->
                    <div class="form-group">
                        <label for="project_url">Project URL:</label>
                        <input type="url" id="project_url" name="project_url" class="form-control" value="{{ old('project_url') }}">
                        @error('project_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Cost -->
                    <div class="form-group">
                        <label for="cost">Cost ($):</label>
                        <input type="number" id="cost" name="cost" class="form-control" value="{{ old('cost') }}">
                        @error('cost')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Upload Project Image -->
                    <div class="form-group">
                        <label for="image">Upload Image (Optional):</label>
                        <input type="file" id="image" name="image" class="form-control-file">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit Project</button>
                </form>
            </div>
         
            
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript functions (addSkill, addExperience, addEducation, addFriend) remain the same
    </script>
</body>
</html>
