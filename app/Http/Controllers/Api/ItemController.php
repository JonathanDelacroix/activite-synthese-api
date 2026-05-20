<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:50'
        ]);

        $list = ShoppingList::firstOrCreate([
            'user_id' => $request->user()->id
        ]);

        $item = Item::create([
            'name' => $validated['name'],
            'shopping_list_id' => $list->id
        ]);

        return new ItemResource($item);
    }

    public function show(Request $request, Item $item)
    {
        $this->authorizeItem($request, $item);

        return new ItemResource($item);
    }

    public function update(Request $request, Item $item)
    {
        $this->authorizeItem($request, $item);

        $validated = $request->validate([
            'name' => 'required|string|min:5|max:50'
        ]);

        $item->update($validated);

        return new ItemResource($item);
    }

    public function destroy(Request $request, Item $item)
    {
        $this->authorizeItem($request, $item);

        $item->delete();

        return response()->json([
            'message' => 'Item supprimé'
        ]);
    }

    private function authorizeItem(Request $request, Item $item)
    {
        if ($item->shoppingList->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }
    }
}