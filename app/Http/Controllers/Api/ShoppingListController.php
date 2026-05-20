<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingListResource;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function show(Request $request)
    {
        $list = ShoppingList::with('items')
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$list) {
            $list = ShoppingList::create([
                'user_id' => $request->user()->id
            ]);

            $list->load('items');
        }

        return new ShoppingListResource($list);
    }
}