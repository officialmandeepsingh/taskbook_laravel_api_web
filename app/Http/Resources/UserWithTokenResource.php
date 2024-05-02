<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWithTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // $data = [
        //     "id" => $this[0]->id ?? 0,
        //     "name" => $this[0]->name ?? 0,
        //     "email" => $this[0]->email,
        //     "email_verified_at" => $this[0]->email_verified_at,
        //     "isEmailVerified" => $this[0]->isEmailVerified,
        //     "api_token" => $this->whenLoaded("api_token") ?? "",
        // ];



        return ([
            "id" => $this[0]->id,
            "name" => $this[0]->name,
            "email" => $this[0]->email,
            "email_verified_at" => $this[0]->email_verified_at,
            "isEmailVerified" => $this[0]->isEmailVerified,
            "api_token" => $this[1],
        ]);
    }
}
