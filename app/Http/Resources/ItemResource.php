<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            '_links' => [
                'self' => [
                    'href' => url("/api/items/{$this->id}"),
                    'method' => 'GET'
                ],
                'update' => [
                    'href' => url("/api/items/{$this->id}"),
                    'method' => 'PUT'
                ],
                'delete' => [
                    'href' => url("/api/items/{$this->id}"),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => url("/api/lists/me"),
                    'method' => 'GET'
                ]
            ]
        ];
    }
}
