<?php

use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\SignUpController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\EditProfileController;
use App\Http\Controllers\Api\ExtraController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\NominationController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TopContestantController;
use App\Http\Controllers\Api\UrlController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\VotePlanController;
use Illuminate\Support\Facades\Route;


// Unauthenticated Route
Route::get('auth-failed', function () {
    return response('unauthenticated', 401);
})->name('authFailed');


// All API Routes
Route::group(['as' => 'api.'], function () {
    // Auth API Routes
    Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
        Route::post("/login", [LoginController::class, "login"]);
        Route::post("/sign_up", [SignUpController::class, "signUp"]);

        Route::post("/send_reset_password_mail", [ResetPasswordController::class, "sendResetPasswordMail"]);
        Route::post("/verify_code", [ResetPasswordController::class, "verifyCode"]);
        Route::post("/reset_password", [ResetPasswordController::class, "newPassword"]);

        Route::group(["middleware" => "auth:api"], function () {
            // Verify Email
            Route::post("/email/verify", [EmailVerificationController::class, "verifyEmail"]);
            Route::get("/email/resend", [EmailVerificationController::class, "resendVerificationCode"]);
            // Get User
            Route::get("/user", [UserController::class, "user"]);
            // Add User Details
            Route::post("/add_personal_detail", [SignUpController::class, "addPersonalDetail"]);
            Route::post("/add_personality_detail", [SignUpController::class, "addPersonalityDetail"]);
            Route::post("/add_bio", [SignUpController::class, "addBio"]);
            Route::post("/add_profile_photo", [SignUpController::class, "addProfilePhoto"]);
            // Logout Route
            Route::get("/logout", [LogoutController::class, "logout"]);
        });
    });

    // Main Routes
    Route::group(["middleware" => "auth:api"], function () {
        Route::get("/feeds", [FeedController::class, "index"]);
        Route::get("/top_contestants", [TopContestantController::class, "index"]);

        // Nominations
        Route::get("/nominations", [NominationController::class, "index"]);
        Route::get("/male_nominations", [NominationController::class, "maleNominations"]);
        Route::get("/female_nominations", [NominationController::class, "femaleNominations"]);
        Route::get("/user_selected_nominations", [NominationController::class, "userSelectedNominations"]);

        // Profile Routes
        Route::get("/profile", [ProfileController::class, "getProfile"]);
        Route::get("/profile/{username}", [ProfileController::class, "getUserProfile"]);

        // Comment Routes
        Route::get("/comments/{id}", [CommentController::class, "index"]);
        Route::post("/add_comment/{to}", [CommentController::class, "insert"]);

        // Add Like Route
        Route::get("/add_like/{to}", [LikeController::class, "insert"]);

        // Send Vote Route
        Route::get("/send_vote/{to}", [VoteController::class, "sendVote"]);

        // Add Rating Route
        Route::post("/add_rating/{to}", [RatingController::class, "addRating"]);

        // Searching Route
        Route::post("/search", [SearchController::class, "search"]);

        // Vote Plan Routes
        Route::get("/vote_plans", [VotePlanController::class, "index"]);
        Route::post("/buy_votes/{id}", [VotePlanController::class, "buyVotes"]);

        // Notifications Route
        Route::get("/notifications", [NotificationController::class, "index"]);

        // Countries Route
        Route::get("/countries", [CountryController::class, "index"]);
        Route::get("/countries_to_show", [CountryController::class, "countriesToShow"]);

        // Extra Routes
        Route::get("/terms_and_conditions", [ExtraController::class, "termsAndCondition"]);
        Route::get("/faqs", [ExtraController::class, "faqs"]);
        Route::get("/how_it_works", [ExtraController::class, "howItWorks"]);

        // Image CRUD
        Route::post("/gallery/create", [GalleryController::class, "create"]);
        Route::post("/gallery/update/{id}", [GalleryController::class, "update"]);
        Route::get("/gallery/delete/{id}", [GalleryController::class, "delete"]);

        // Video CRUD
        Route::post("/video/create", [VideoController::class, "create"]);
        Route::post("/video/update/{id}", [VideoController::class, "update"]);
        Route::get("/video/delete/{id}", [VideoController::class, "delete"]);

        // Url CRUD
        Route::post("/url/create", [UrlController::class, "create"]);
        Route::get("/url/delete/{id}", [UrlController::class, "delete"]);

        // Edit Profile
        Route::post("/edit_profile", [EditProfileController::class, "editProfile"]);
        Route::post("/edit_gender", [EditProfileController::class, "updateGender"]);

        // Contact Route
        Route::post("/contact", [ContactController::class, "create"]);
    });
});
