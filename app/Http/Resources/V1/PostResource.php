<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => Str::limit($this->description, 512),
            'contact_phone' => $this->contact_phone,
            'created_at' => $this->created_at,
            'user' => UserResource::make($this->user),
        ];
    }
}
