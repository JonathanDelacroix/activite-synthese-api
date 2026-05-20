<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'shopping_list_id'])]
class Item extends Model
{
    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }
    public $timestamps = false;
}
