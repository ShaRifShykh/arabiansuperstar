<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'username', 'email', 'phone_no', 'password', 'country', 'nationality', 'gender',
        'date_of_birth', 'zodiac', 'hobbies', 'bio', 'profile_photo', 'google_id', 'facebook_id', 'twitter_id',
        'email_verified_at', 'verification_code', 'block', 'device_token'
    ];

    protected $hidden = [
        'password',
    ];

    public function galleries()
    {
        return $this->hasMany(UserGallery::class, "user_id", "id")->orderBy('id', 'DESC');
    }

    public function unOrderGalleries()
    {
        return $this->hasMany(UserGallery::class, "user_id", "id");
    }

    public function videos()
    {
        return $this->hasMany(UserVideo::class, "user_id", "id")->orderBy('id', 'DESC');
    }

    public function unOrderVideos()
    {
        return $this->hasMany(UserVideo::class, "user_id", "id");
    }

    public function urls()
    {
        return $this->hasMany(UserUrl::class, "user_id", "id")->orderBy('id', 'DESC');
    }

    public function nominations()
    {
        return $this->hasMany(UserNomination::class, "user_id", "id")
            ->with("nomination");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "to", "id")->with("commentBY")
            ->where('block', '=', 0)->orderBy('id', 'DESC');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, "to", "id")->with("likeBY");
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, "to", "id")->with("ratingBY");
    }

    public function votes()
    {
        return $this->hasMany(VoteBy::class, "to", "id")->with("voteBY");
    }

    public function availableVote()
    {
        return $this->hasOne(UserVote::class, "user_id", "id");
    }

    public function isUser360()
    {
        return $this->hasOne(User360::class, 'user_id', 'id');
    }

    public function isUser72()
    {
        return $this->hasOne(User72::class, 'user_id', 'id');
    }

    public function userAction()
    {
        return $this->hasOne(UserAction::class, 'user_id', 'id');
    }

    public function creditCard()
    {
        return $this->hasOne(UserCreditCard::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, "user_id", "id");
    }

    public function feedGallery() {
        return $this->hasOne(UserGallery::class, "user_id", "id");
    }
}
