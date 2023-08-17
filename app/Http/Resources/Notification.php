<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "createdAt" => Carbon::parse($this->created_at)->format("d M Y g:i A"),
            "message" => $this->message,
            "comment" => new Comment($this->comment),
            "like" => new Like($this->like),
            "rating" => new Rating($this->rating),
        ];
    }
}
