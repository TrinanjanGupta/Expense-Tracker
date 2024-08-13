<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;
use App\Models\Item;
use App\Models\ItemGroup;

class ExpenditureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addExpenditure(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Create the expenditure for the authenticated user
        $expenditure = $request->user()->expenditures()->create([
            'item_id' => $request->input('item_id'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
        ]);

        return redirect()->back()->with('success', 'Expenditure added successfully');
    }

    public function viewExpenditures()
    {
        // Fetch expenditures with related item information
        $expenditures = auth()->user()->expenditures()->with('item.itemGroup')->get();
        $categories = ItemGroup::all();
        $items = Item::all();
        return view('expenditures.index', compact('expenditures', 'items', 'categories'));
    }

    public function getItemsByCategory($categoryId)
    {
        // Fetch items that belong to the selected category
        $items = Item::where('item_group_id', $categoryId)->get();
        //dd($items);
        return response()->json($items);
    }
}
