<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .portfolio-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .portfolio-button {
            margin-top: 5px;
        }
        .portfolio-title {
            font-weight: bold;
        }
        .tab-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Portfolio</h1>
        
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="portfolioTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab">Personal Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="skills-tab" data-toggle="tab" href="#skills" role="tab">Skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab">Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab">Education</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab">Friends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="projects-tab" data-toggle="tab" href="#projects" role="tab">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab">Pending Reviews</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="portfolioTabsContent">

            <!-- Personal Information Tab -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                <h3>Personal Information</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $personalInfo->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $personalInfo->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $personalInfo->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Intro Heading</th>
                        <td>{{ $personalInfo->intro_heading ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Intro Detail</th>
                        <td>{{ $personalInfo->intro_detail ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>CV</th>
                        <td>
                            @if($personalInfo->cv)
                                <a href="{{ asset('storage/' . $personalInfo->cv) }}" target="_blank">Download CV</a>
                            @else
                                Not uploaded
                            @endif
                        </td>
                    </tr>
                </table>
                <a href="{{ route('personalInfo.edit', $personalInfo->id) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>

            <!-- Skills Tab -->
            <div class="tab-pane fade" id="skills" role="tabpanel">
                <h3>Skills</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Skill Name</th>
                            <th>Percentage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr>
                                <td>{{ $skill->name }}</td>
                                <td>{{ $skill->percentage }}%</td>
                                <td>
                                    <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No skills added yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Experience Tab -->
            <div class="tab-pane fade" id="experience" role="tabpanel">
                <h3>Experience</h3>
                @forelse($experiences as $experience)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->heading }}" class="portfolio-image img-thumbnail">
                        <p><strong>Heading:</strong> {{ $experience->heading }}</p>
                        <p><strong>Detail:</strong> {{ $experience->detail }}</p>
                        <a href="{{ route('experiences.edit', $experience->id) }}" class="btn btn-warning btn-sm portfolio-button">Edit</a>
                        <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm portfolio-button">Delete</button>
                        </form>
                    </div>
                @empty
                    <p>No experiences added yet.</p>
                @endforelse
            </div>

            <!-- Education Tab -->
            <div class="tab-pane fade" id="education" role="tabpanel">
                <h3>Education</h3>
                @forelse($educations as $education)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $education->image) }}" alt="{{ $education->detail }}" class="portfolio-image img-thumbnail">
                        <p><strong>Detail:</strong> {{ $education->detail }}</p>
                        <p><strong>Start Year:</strong> {{ $education->start_year }}</p>
                        <p><strong>End Year:</strong> {{ $education->end_year }}</p>
                        <a href="{{ route('educations.edit', $education->id) }}" class="btn btn-warning btn-sm portfolio-button">Edit</a>
                        <form action="{{ route('educations.destroy', $education->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm portfolio-button">Delete</button>
                        </form>
                    </div>
                @empty
                    <p>No education details added yet.</p>
                @endforelse
            </div>

            <!-- Friends Tab -->
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <h3>Friends</h3>
                @forelse($friends as $friend)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $friend->image) }}" alt="{{ $friend->name }}" class="portfolio-image img-thumbnail">
                        <p><strong>Name:</strong> {{ $friend->name }}</p>
                        <a href="{{ route('friends.edit', $friend->id) }}" class="btn btn-warning btn-sm portfolio-button">Edit</a>
                        <form action="{{ route('friends.destroy', $friend->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm portfolio-button">Delete</button>
                        </form>
                    </div>
                @empty
                    <p>No friends added yet.</p>
                @endforelse
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <h3>Pending Reviews</h3>
                @if($reviews->isEmpty())
                    <p>No pending reviews available.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Review Rating</th>
                                <th>Review Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ $review->email }}</td>
                                    <td>{{ $review->phone }}</td>
                                    <td>
                                        <!-- Display the rating stars -->
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="fa{{ $i <= $review->rating ? ' fa-star' : ' fa-star-o' }}"></span>
                                        @endfor
                                    </td>
                                    <td>{{ $review->review_details }}</td>
                                    <td>
                                        <form action="{{ route('reviews.approve', $review->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="projects" role="tabpanel">
                <h3>Projects</h3>
                @forelse($projects as $project)
                    <div class="mb-3">
                        <p><strong>Title:</strong> {{ $project->title }}</p>
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Client:</strong> {{ $project->client }}</p>
                        <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                        <p><strong>Project URL:</strong> <a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a></p>
                        <p><strong>Cost:</strong> ${{ $project->cost }}</p>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm portfolio-button">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm portfolio-button">Delete</button>
                        </form>
                    </div>
                @empty
                    <p>No projects added yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
