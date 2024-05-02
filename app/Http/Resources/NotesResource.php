<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ([
            "id" => $this->id,
            "title" => $this->title,
            "note" => $this->note,
            "isFavourite" => $this->isFavourite,
            "book_id" => $this->book_id,
            "user_id" => $this->user_id,
        ]);
    }
}
