<?php

use App\Models\Skill;

use App\Models\Friend;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PersonalInfoController;
use Illuminate\Support\Facades\Auth;
Route::get('/ss', function () {
    return view('welcome');
});
Route::get('/p', function () {
    return view('Portfolio');
})->name('viewPortfolio');

Route::get('/', function () {
    return view('register');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/personal-info', [PersonalInfoController::class, 'storePersonalInfo']);

// Skills Routes
Route::post('/skills', [SkillController::class, 'storeSkills']);

// Experience Routes
Route::post('/experience', [ExperienceController::class, 'storeExperience']);

// Education Routes
Route::post('/education', [EducationController::class, 'storeEducation']);

// Friends Routes
Route::post('/friends', [FriendController::class, 'storeFriends']);

// Projects Routes
Route::post('/projects', [ProjectController::class, 'store']);


Route::get('/view-portfolio', function () {
    return view('ViewPortfolio', [
        'personalInfo' => App\Models\PersonalInfo::where('id', Auth::id())->first(),
        'skills' => App\Models\Skill::where('user_id', Auth::id())->get(),
        'experiences' => App\Models\Experience::where('user_id', Auth::id())->get(),
        'educations' => App\Models\Education::where('user_id', Auth::id())->get(),
        'friends' => App\Models\Friend::where('user_id', Auth::id())->get(),
        'projects' => App\Models\Project::where('user_id', Auth::id())->get(),
        'reviews' => App\Models\Review::where('status', 'unchecked')->get(), // Fetch unchecked reviews
    ]);
})->name('view-portfolio');


Route::get('/personal-info/edit/{id}', [PersonalInfoController::class, 'edit'])->name('personalInfo.edit');
Route::put('/personal-info/update/{id}', [PersonalInfoController::class, 'update'])->name('personalInfo.update');


Route::get('/skills/edit/{id}', [SkillController::class, 'edit'])->name('skills.edit');
Route::put('/skills/update/{id}', [SkillController::class, 'update'])->name('skills.update');
Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');


Route::get('/experiences/{id}/edit', [ExperienceController::class, 'edit'])->name('experiences.edit');

// Update Experience
Route::put('/experiences/{id}', [ExperienceController::class, 'update'])->name('experiences.update');

// Delete Experience
Route::delete('/experiences/{id}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

Route::get('/educations/{id}/edit', [EducationController::class, 'edit'])->name('educations.edit');

// Update Education
Route::put('/educations/{id}', [EducationController::class, 'update'])->name('educations.update');

// Delete Education
Route::delete('/educations/{id}', [EducationController::class, 'destroy'])->name('educations.destroy');


Route::get('/friends/{id}/edit', [FriendController::class, 'edit'])->name('friends.edit');

// Update Friend
Route::put('/friends/{id}', [FriendController::class, 'update'])->name('friends.update');

// Delete Friend
Route::delete('/friends/{id}', [FriendController::class, 'destroy'])->name('friends.destroy');

Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

// Update Project
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

// Delete Project
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{id}/download', [InvoiceController::class, 'downloadPDF'])->name('invoices.download');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('/portfolio/reviews/{id}/approve', [ReviewController::class, 'approveReview'])->name('reviews.approve');