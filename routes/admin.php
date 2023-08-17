<?php

use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\AssociateController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\AuthSliderController;
use App\Http\Controllers\Admin\CommentSliderController;
use App\Http\Controllers\Admin\CorporatePagesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\HostCityController;
use App\Http\Controllers\Admin\InquiriesController;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\NominationController;
use App\Http\Controllers\Admin\NotificationSliderController;
use App\Http\Controllers\Admin\ParticipatingCountriesController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\ProfileSliderController;
use App\Http\Controllers\Admin\SearchSliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserCommentController;
use App\Http\Controllers\Admin\Users360Controller;
use App\Http\Controllers\Admin\Users72Controller;
use App\Http\Controllers\Admin\VoteController;
use App\Http\Controllers\Admin\VotePlansController;
use App\Http\Controllers\Admin\VoteOrderController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    // Auth Routes
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::get("/sign_in", [AuthController::class, "signInView"])->name("signInView");
        Route::post("/sign_in", [AuthController::class, "signIn"])->name("signIn");
        Route::post("/logout", [AuthController::class, "logout"])->name("logout")->middleware("auth:admin");
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");


        // Manage Users (Work Remaining)
        Route::group(['namespace' => 'ManageUser', 'as' => 'manageUser.', 'prefix' => 'manage_user'], function () {
            Route::get("/list", [ManageUserController::class, "index"])->name("list");
            Route::get("/view/{id}", [ManageUserController::class, "view"])->name("view");
            Route::get("/edit/{id}", [ManageUserController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [ManageUserController::class, "update"])->name("update");
            Route::get("/delete/{id}", [ManageUserController::class, "delete"])->name("delete");
            Route::delete("/delete_all", [ManageUserController::class, "deleteAll"])->name("deleteAll");

            Route::post('/give_vote/{id}', [VoteController::class, "giveVote"])->name('giveVote');
            Route::post('/take_vote/{id}', [VoteController::class, "takeVote"])->name('takeVote');

            Route::post("/edit_status/{id}", [ManageUserController::class, "editStatus"])->name("editStatus");
            Route::post("/edit_commenting_status/{id}", [ManageUserController::class, "editCommentingStatus"])->name("editCommentingStatus");
            Route::post("/edit_liking_status/{id}", [ManageUserController::class, "editLikingStatus"])->name("editLikingStatus");
            Route::post("/edit_voting_status/{id}", [ManageUserController::class, "editVotingStatus"])->name("editVotingStatus");
            Route::post("/edit_rating_status/{id}", [ManageUserController::class, "editRatingStatus"])->name("editRatingStatus");

            Route::get("/edit_image/{id}", [ManageUserController::class, "editImage"])->name("editImage");
            Route::post("/update_image/{id}", [ManageUserController::class, "updateImage"])->name("updateImage");
            Route::get("/delete_image/{id}", [ManageUserController::class, "deleteImage"])->name("deleteImage");
            Route::get("/edit_video/{id}", [ManageUserController::class, "editVideo"])->name("editVideo");
            Route::post("/update_video/{id}", [ManageUserController::class, "updateVideo"])->name("updateVideo");
            Route::get("/delete_video/{id}", [ManageUserController::class, "deleteVideo"])->name("deleteVideo");
            Route::get("/edit_url/{id}", [ManageUserController::class, "editUrl"])->name("editUrl");
            Route::post("/update_url/{id}", [ManageUserController::class, "updateUrl"])->name("updateUrl");
            Route::get("/delete_url/{id}", [ManageUserController::class, "deleteUrl"])->name("deleteUrl");


            Route::post("/block_all", [ManageUserController::class, "blockAll"])->name("blockAll");
            Route::post("/un_block_all", [ManageUserController::class, "unBlockAll"])->name("unBlockAll");
            Route::get("/download", [ManageUserController::class, "download"])->name("download");

            Route::group(['namespace' => 'Users360', 'as' => 'users360.', 'prefix' => 'users_360'], function () {
                Route::get("/list", [Users360Controller::class, "index"])->name("list");
                Route::post("/add", [Users360Controller::class, "add"])->name("add");
                Route::get("/add_single/{id}", [Users360Controller::class, "addSingle"])->name("addSingle");
                Route::get("/delete/{id}", [Users360Controller::class, "delete"])->name("delete");
            });

            Route::group(['namespace' => 'Users72', 'as' => 'users72.', 'prefix' => 'users_72'], function () {
                Route::get("/list", [Users72Controller::class, "index"])->name("list");
                Route::post("/add", [Users72Controller::class, "add"])->name("add");
                Route::get("/add_single/{id}", [Users72Controller::class, "addSingle"])->name("addSingle");
                Route::get("/delete/{id}", [Users72Controller::class, "delete"])->name("delete");
            });
        });



        // User All Comments
        Route::group(['namespace' => 'UserAllComments', 'as' => 'userAllComments.', 'prefix' => 'user_all_comments'], function () {
            Route::get("/list", [UserCommentController::class, "index"])->name("list");
            Route::get("/edit/{id}", [UserCommentController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [UserCommentController::class, "update"])->name("update");
            Route::get("/delete/{id}", [UserCommentController::class, "delete"])->name("delete");
            Route::post("/edit_status/{id}", [UserCommentController::class, "editStatus"])->name("editStatus");
            Route::get("/download", [UserCommentController::class, "download"])->name("download");
        });



        // Vote Plans
        Route::group(['namespace' => 'VotePlans', 'as' => 'votePlans.', 'prefix' => 'vote_plans'], function () {
            Route::get("/list", [VotePlansController::class, "index"])->name("list");
            Route::get("/add", [VotePlansController::class, "add"])->name("add");
            Route::post("/insert", [VotePlansController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [VotePlansController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [VotePlansController::class, "update"])->name("update");
            Route::get("/delete/{id}", [VotePlansController::class, "delete"])->name("delete");
            Route::get("/download", [VotePlansController::class, "download"])->name("download");
        });



        // Vote Orders
        Route::group(['namespace' => 'VoteOrders', 'as' => 'voteOrders.', 'prefix' => 'vote_orders'], function () {
            Route::get("/list", [VoteOrderController::class, "index"])->name("list");
            Route::get("/edit/{id}", [VoteOrderController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [VoteOrderController::class, "update"])->name("update");
            Route::get("/delete/{id}", [VoteOrderController::class, "delete"])->name("delete");
            Route::get("/download", [VoteOrderController::class, "download"])->name("download");
        });



        // Nomination
        Route::group(['namespace' => 'Nominations', 'as' => 'nominations.', 'prefix' => 'nominations'], function () {
            Route::get("/list", [NominationController::class, "index"])->name("list");
            Route::get("/add", [NominationController::class, "add"])->name("add");
            Route::post("/insert", [NominationController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [NominationController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [NominationController::class, "update"])->name("update");
            Route::get("/delete/{id}", [NominationController::class, "delete"])->name("delete");
            Route::post("/edit_status/{id}", [NominationController::class, "editStatus"])->name("editStatus");
            Route::get("/download", [NominationController::class, "download"])->name("download");
        });

        // Actions (Not Confirmed)
        Route::group(['namespace' => 'Actions', 'as' => 'actions.', 'prefix' => 'actions'], function () {
            Route::get("/list", [ActionController::class, "index"])->name("list");
            Route::post("/edit_status/{id}", [ActionController::class, "editStatus"])->name("editStatus");
        });


        // Inquiries
        Route::group(['namespace' => 'Inquiries', 'as' => 'inquiries.', 'prefix' => 'inquiries'], function () {
            Route::get("/list", [InquiriesController::class, "index"])->name("list");
            Route::get("/edit/{id}", [InquiriesController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [InquiriesController::class, "update"])->name("update");
            Route::get("/delete/{id}", [InquiriesController::class, "delete"])->name("delete");
            Route::get("/download", [InquiriesController::class, "download"])->name("download");
        });



        // Profile Setting
        Route::group(['namespace' => 'GeneralSetting', 'as' => 'generalSetting.', 'prefix' => 'general_setting'], function () {
            Route::get("/edit", [ProfileSettingController::class, "index"])->name("edit");
            Route::post("/update", [ProfileSettingController::class, "update"])->name("update");
        });



        // Corporate Pages
        Route::group(['namespace' => 'CorporatePages', 'as' => 'corporatePages.', 'prefix' => 'corporate_pages'], function () {
            Route::get("/list", [CorporatePagesController::class, "index"])->name("list");
            Route::get("/edit/{key}", [CorporatePagesController::class, "edit"])->name("edit");
            Route::post("/update/{key}", [CorporatePagesController::class, "update"])->name("update");
        });

        Route::group(['namespace' => 'ParticipatingCountries', 'as' => 'participatingCountries.', 'prefix' => 'participating_countries'], function () {
            Route::get("/list", [ParticipatingCountriesController::class, "index"])->name("list");
            Route::get("/add", [ParticipatingCountriesController::class, "add"])->name("add");
            Route::post("/insert", [ParticipatingCountriesController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [ParticipatingCountriesController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [ParticipatingCountriesController::class, "update"])->name("update");
            Route::get("/delete/{id}", [ParticipatingCountriesController::class, "delete"])->name("delete");
            Route::post("/edit_status/{id}", [ParticipatingCountriesController::class, "editStatus"])->name("editStatus");
        });

        Route::group(['namespace' => 'FAQs', 'as' => 'faqs.', 'prefix' => 'faqs'], function () {
            Route::get("/list", [FAQController::class, "index"])->name("list");
            Route::get("/add", [FAQController::class, "add"])->name("add");
            Route::post("/insert", [FAQController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [FAQController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [FAQController::class, "update"])->name("update");
            Route::get("/delete/{id}", [FAQController::class, "delete"])->name("delete");
        });

        Route::group(['namespace' => 'Judges', 'as' => 'judges.', 'prefix' => 'judges'], function () {
            Route::get("/list", [JudgeController::class, "index"])->name("list");
            Route::get("/add", [JudgeController::class, "add"])->name("add");
            Route::post("/insert", [JudgeController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [JudgeController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [JudgeController::class, "update"])->name("update");
            Route::get("/delete/{id}", [JudgeController::class, "delete"])->name("delete");
        });

        Route::group(['namespace' => 'HostCities', 'as' => 'hostCities.', 'prefix' => 'host_cities'], function () {
            Route::get("/list", [HostCityController::class, "index"])->name("list");
            Route::get("/add", [HostCityController::class, "add"])->name("add");
            Route::post("/insert", [HostCityController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [HostCityController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [HostCityController::class, "update"])->name("update");
            Route::get("/delete/{id}", [HostCityController::class, "delete"])->name("delete");
        });

        Route::group(['namespace' => 'Associates', 'as' => 'associates.', 'prefix' => 'associates'], function () {
            Route::get("/list", [AssociateController::class, "index"])->name("list");
            Route::get("/add", [AssociateController::class, "add"])->name("add");
            Route::post("/insert", [AssociateController::class, "insert"])->name("insert");
            Route::get("/edit/{id}", [AssociateController::class, "edit"])->name("edit");
            Route::post("/update/{id}", [AssociateController::class, "update"])->name("update");
            Route::get("/delete/{id}", [AssociateController::class, "delete"])->name("delete");
        });

        Route::group(['namespace' => 'Slider', 'as' => 'sliders.', 'prefix' => 'sliders'], function () {
            // Auth Slider
            Route::group(['namespace' => 'Auth', 'as' => 'auth.', 'prefix' => 'auth'], function () {
                Route::get("/list", [AuthSliderController::class, "index"])->name("list");
                Route::get("/add", [AuthSliderController::class, "add"])->name("add");
                Route::post("/insert", [AuthSliderController::class, "insert"])->name("insert");
                Route::get("/edit/{id}", [AuthSliderController::class, "edit"])->name("edit");
                Route::post("/update/{id}", [AuthSliderController::class, "update"])->name("update");
                Route::get("/delete/{id}", [AuthSliderController::class, "delete"])->name("delete");
            });

            // Profile Slider
            Route::group(['namespace' => 'Profile', 'as' => 'profile.', 'prefix' => 'profile'], function () {
                Route::get("/list", [ProfileSliderController::class, "index"])->name("list");
                Route::get("/add", [ProfileSliderController::class, "add"])->name("add");
                Route::post("/insert", [ProfileSliderController::class, "insert"])->name("insert");
                Route::get("/edit/{id}", [ProfileSliderController::class, "edit"])->name("edit");
                Route::post("/update/{id}", [ProfileSliderController::class, "update"])->name("update");
                Route::get("/delete/{id}", [ProfileSliderController::class, "delete"])->name("delete");
            });

            // Comment Slider
            Route::group(['namespace' => 'Comment', 'as' => 'comment.', 'prefix' => 'comment'], function () {
                Route::get("/list", [CommentSliderController::class, "index"])->name("list");
                Route::get("/add", [CommentSliderController::class, "add"])->name("add");
                Route::post("/insert", [CommentSliderController::class, "insert"])->name("insert");
                Route::get("/edit/{id}", [CommentSliderController::class, "edit"])->name("edit");
                Route::post("/update/{id}", [CommentSliderController::class, "update"])->name("update");
                Route::get("/delete/{id}", [CommentSliderController::class, "delete"])->name("delete");
            });

            // Notification Slider
            Route::group(['namespace' => 'Notification', 'as' => 'notification.', 'prefix' => 'notification'], function () {
                Route::get("/list", [NotificationSliderController::class, "index"])->name("list");
                Route::get("/add", [NotificationSliderController::class, "add"])->name("add");
                Route::post("/insert", [NotificationSliderController::class, "insert"])->name("insert");
                Route::get("/edit/{id}", [NotificationSliderController::class, "edit"])->name("edit");
                Route::post("/update/{id}", [NotificationSliderController::class, "update"])->name("update");
                Route::get("/delete/{id}", [NotificationSliderController::class, "delete"])->name("delete");
            });

            // Search Slider
            Route::group(['namespace' => 'Search', 'as' => 'search.', 'prefix' => 'search'], function () {
                Route::get("/list", [SearchSliderController::class, "index"])->name("list");
                Route::get("/add", [SearchSliderController::class, "add"])->name("add");
                Route::post("/insert", [SearchSliderController::class, "insert"])->name("insert");
                Route::get("/edit/{id}", [SearchSliderController::class, "edit"])->name("edit");
                Route::post("/update/{id}", [SearchSliderController::class, "update"])->name("update");
                Route::get("/delete/{id}", [SearchSliderController::class, "delete"])->name("delete");
            });
        });

        // Website



        // App Setting
        Route::group(['namespace' => 'AppSetting', 'as' => 'appSetting.', 'prefix' => 'app_setting'], function () {
            Route::get("/edit", [SettingController::class, "index"])->name("index");
            Route::post("/update", [SettingController::class, "update"])->name("update");
        });
    });
});
