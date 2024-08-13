<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup;
use App\Models\Item;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('isAdmin');
    // }

    // Method to display the form for creating an Item Group
    public function createItemGroupForm()
    {
        return view('admin.item-group-create');
    }

    public function createItemGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ItemGroup::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.itemGroups.create')->with('success', 'Item group created successfully!');
    }

        // Show form to create item
    public function createItemForm()
    {
        $itemGroups = ItemGroup::all();
        return view('admin.item-create', compact('itemGroups'));
    }

    // Handle form submission for creating item
    public function createItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'item_group_id' => 'required|exists:item_groups,id',
        ]);

        Item::create([
            'name' => $request->name,
            'item_group_id' => $request->item_group_id,
        ]);

        return redirect()->route('admin.items.create')->with('success', 'Item created successfully.');
    }

}
