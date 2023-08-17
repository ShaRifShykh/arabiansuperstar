<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullName' => $this->full_name,
            'username' => $this->username,
            'email' => $this->email,
            'phoneNo' => $this->phone_no,
            'country' => $this->country,
            'nationality' => $this->nationality,
            'gender' => $this->gender,
            'dateOfBirth' => $this->date_of_birth,
            'zodiac' => $this->zodiac,
            'hobbies' => $this->hobbies,
            'bio' => $this->bio,
            'profilePhoto' => $this->profile_photo ? substr($this->profile_photo, 6) : null,
            'emailVerifiedAt' => $this->email_verified_at,
            'createdAt' => $this->created_at->toDayDateTimeString(),
            'galleries' => UserGallery::collection($this->galleries),
            'unOrderGalleries' => UserGallery::collection($this->unOrderGalleries),
            'videos' => UserVideo::collection($this->videos),
            'unOrderVideos' => UserVideo::collection($this->unOrderVideos),
            'urls' => UserUrl::collection($this->urls),
            'nominations' => UserNomination::collection($this->nominations),
            'availableVotes' => new UserVote($this->availableVote),
            'totalLikes' => $this->likes->count(),
            'totalComments' =>$this->comments->count(),
            'feedGallery' => new UserGallery($this->feedGallery)
        ];
    }
}
