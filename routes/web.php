<?php

use App\Http\Controllers\Frontend\AssociationController;
use App\Http\Controllers\Frontend\Auth\EmailVerificationController;
use App\Http\Controllers\Frontend\Auth\FacebookAuthController;
use App\Http\Controllers\Frontend\Auth\GoogleAuthController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\LogoutController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\SignUpController;
use App\Http\Controllers\Frontend\Auth\TwitterAuthController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\EditProfileController;
use App\Http\Controllers\Frontend\EligibilityController;
use App\Http\Controllers\Frontend\EventTicketController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HostCityController;
use App\Http\Controllers\Frontend\HowItWorksController;
use App\Http\Controllers\Frontend\JudgesController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\ParticipatingCountriesController;
use App\Http\Controllers\Frontend\PrizeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SponsorshipController;
use App\Http\Controllers\Frontend\TermsAndConditionsController;
use App\Http\Controllers\Frontend\VoteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    Route::get("/login", [LoginController::class, "index"])->name("loginView");
    Route::post("/login", [LoginController::class, "login"])->name("login");

    Route::get("/sign_up", [SignUpController::class, "index"])->name("signUpView");
    Route::post("/sign_up", [SignUpController::class, "signUp"])->name("signUp");

    // Google Social Auth
    Route::get("/google", [GoogleAuthController::class, "redirect"])->name("googleAuth");
    Route::get("/google/call-back", [GoogleAuthController::class, "callBackGoogle"])->name("callBackGoogle");

    // Facebook Social Auth
    Route::get("/facebook", [FacebookAuthController::class, "redirect"])->name("facebookAuth");
    Route::get("/facebook/call-back", [FacebookAuthController::class, "callBackFacebook"])->name("callBackFacebook");

    // Google Social Auth
    Route::get("/twitter", [TwitterAuthController::class, "redirect"])->name("twitterAuth");
    Route::get("/twitter/call-back", [TwitterAuthController::class, "callBackTwitter"])->name("callBackTwitter");

    Route::get("/reset_password", [ResetPasswordController::class, "sendEmailView"])->name("resetPassword");
    Route::post("/reset_password", [ResetPasswordController::class, "sendResetPasswordMail"])->name("sendResetPasswordMail");
    Route::get("/reset_password_code/{id}", [ResetPasswordController::class, "sendCodeView"])->name("resetPasswordCode");
    Route::post("/reset_password_code/{id}", [ResetPasswordController::class, "verifyCode"])->name("verifyCode");
    Route::post("/new_password", [ResetPasswordController::class, "newPassword"])->name("newPassword");

    // Profile Detail Routes
    Route::group(['middleware' => 'auth:web'], function () {
        Route::group(['middleware' => 'isVerified'], function () {
            Route::get("/personal", [SignUpController::class, "addPersonalDetailView"])->name("addPersonalDetailView");
            Route::post("/personal", [SignUpController::class, "addPersonalDetail"])->name("addPersonalDetail");

            Route::get("/personality", [SignUpController::class, "addPersonalityView"])->name("addPersonalityView");
            Route::post("/personality", [SignUpController::class, "addPersonality"])->name("addPersonality");

            Route::get("/bio", [SignUpController::class, "addBioView"])->name("addBioView");
            Route::post("/bio", [SignUpController::class, "addBio"])->name("addBio");

            Route::get("/profile_photo", [SignUpController::class, "addProfilePhotoView"])->name("addProfilePhotoView");
            Route::post("/profile_photo", [SignUpController::class, "addProfilePhoto"])->name("addProfilePhoto");
        });

        Route::get("/logout", [LogoutController::class, "logout"])->name("logout");
    });
});

// Profile Stuff
Route::group(["middleware" => ["auth:web", 'isVerified']], function () {
    Route::get("/delete_url/{id}", [SignUpController::class, "deleteUrl"]);
    Route::get("/delete_video/{id}", [SignUpController::class, "deleteVideo"]);
    Route::get("/delete_img/{id}", [SignUpController::class, "deleteImg"]);
});

// Email Verification Route
Route::get('/email/verify', function () {
    if (Auth::guard("web")->user()->email_verified_at != null) {
        return redirect()->route('home');
    }
    return view('frontend.auth.verify-email');
})->middleware('auth')->name('verification.code');
Route::post("/email/verify", [EmailVerificationController::class, "verifyEmail"])->name("verifyMail");
Route::get("/email/resend_verification_code", [EmailVerificationController::class, "resendVerificationCode"])->name("resendVerificationCode");


// Frontend Routes
Route::group(['middleware' => ['user.profile', 'isVerified']], function () {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/judges", [JudgesController::class, "index"])->name("judges");
    Route::get("/prize", [PrizeController::class, "index"])->name("prize");
    Route::get("/association", [AssociationController::class, "index"])->name("association");
    Route::get("/event_ticket", [EventTicketController::class, "index"])->name("eventTicket");
    Route::get("/participating_countries", [ParticipatingCountriesController::class, "index"])->name("participatingCountries");
    Route::get("/faqs", [FaqController::class, "index"])->name("faqs");
    Route::get("/how_it_works", [HowItWorksController::class, "index"])->name("howItWorks");
    Route::get("/eligibility", [EligibilityController::class, "index"])->name("eligibility");
    Route::get("/sponsorship", [SponsorshipController::class, "index"])->name("sponsorship");
    Route::get("/terms_and_conditions", [TermsAndConditionsController::class, "index"])->name("termsAndConditions");
    Route::get("/host_city", [HostCityController::class, "index"])->name("hostCity");
    Route::get("/contact", [ContactController::class, "index"])->name("contactUs");
    Route::post("/contact", [ContactController::class, "create"])->name("contactUsSubmit");
    Route::get("/search", [SearchController::class, "index"])->name("search");
});


Route::group(['middleware' => ['auth:web', 'user.profile', 'isVerified']], function () {
    // User Panel Routes
    // Profile Route
    Route::get("/profile", [ProfileController::class, "index"])->name("profile");
    Route::get("/profile/{username}", [ProfileController::class, "usersProfile"])->name("usersProfile");
    // Edit Profile Route
    Route::get("/edit_profile", [EditProfileController::class, "index"])->name("editProfile");
    Route::post("/edit_profile", [EditProfileController::class, "editProfile"])->name("updateProfile");
    // Image CRUD
    Route::post("/add_image", [EditProfileController::class, "insertImage"])->name("insertImage");
    Route::post("/update_image/{id}", [EditProfileController::class, "updateImage"])->name("updateImage");
    Route::get("/delete_image/{id}", [EditProfileController::class, "deleteImage"])->name("deleteImage");
    // Video CRUD
    Route::post("/add_video", [EditProfileController::class, "insertVideo"])->name("insertVideo");
    Route::post("/update_video/{id}", [EditProfileController::class, "updateVideo"])->name("updateVideo");
    Route::get("/delete_video/{id}", [EditProfileController::class, "deleteVideo"])->name("deleteVideo");
    // Url CRUD
    Route::post("/add_url", [EditProfileController::class, "insertUrl"])->name("insertUrl");
    Route::post("/update_url/{id}", [EditProfileController::class, "updateUrl"])->name("updateUrl");
    Route::get("/delete_url/{id}", [EditProfileController::class, "deleteUrl"])->name("deleteUrl");
    // Change Password
    Route::post("/change_password", [EditProfileController::class, "changePassword"])->name("changePassword");

    Route::get("/notifications", [NotificationController::class, "index"])->name("notifications");

    Route::post("/add_rating/{to}", [RatingController::class, "add"])->name("addRating");

    Route::get("/comments/{username}", [CommentController::class, "index"])->name("comments");
    Route::post("/add_comment/{to}", [CommentController::class, "add"])->name("addComment");

    Route::get("/add_like/{to}", [LikeController::class, "add"])->name("addLike");

    // Votes Routes
    Route::get("/my_votes_bucket", [VoteController::class, "myVotesBucket"])->name("myVotesBucket");
    Route::get("/sendVotes/{id}", [VoteController::class, "sendVotes"])->name("sendVotes");
    Route::get("/buy_votes", [VoteController::class, "buyVotesView"])->name("buyVotesView");
    Route::get("/checkout/{id}", [VoteController::class, "checkout"])->name("checkout");
    Route::post("/buy_votes/{id}", [VoteController::class, "buyVotes"])->name("buyVotes");
    Route::get("/votes_purchased", [VoteController::class, "votesPurchasedView"])->name("votesPurchasedView");
});

Route::get("/share_profile/{username}", [ProfileController::class, "usersShareProfile"])->name("usersShareProfile");





// TEMP ROUTE
Route::get('/linkstorage', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('/linkstorage2', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';
    symlink($targetFolder, $linkFolder);
});

//Clear Cache facade value:
Route::get('/clear_cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route_cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route_clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view_clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config_cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
