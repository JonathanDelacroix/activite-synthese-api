<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'items' => ItemResource::collection($this->items),

            '_links' => [
                'self' => [
                    'href' => url("/api/lists/me"),
                    'method' => 'GET'
                ],
                'user' => [
                    'href' => url("/api/users/" . $this->user_id),
                    'method' => 'GET'
                ],
                'add_item' => [
                    'href' => url("/api/items"),
                    'method' => 'POST'
                ]
            ]
        ];
    }
}
