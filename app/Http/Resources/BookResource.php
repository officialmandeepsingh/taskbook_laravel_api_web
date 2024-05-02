<?php

namespace App\Http\Resources;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "isFavourite" => $this->isFavourite,
            "user_id" => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            // 'notes_count' => count($this->whenLoaded('notes') ?? []),
            'notes_count' => $this->whenLoaded('notes', function () {
                return $this->notes->count();
            }),
            'notes' => NotesResource::collection($this->whenLoaded('notes')),
        ]);
    }
}
