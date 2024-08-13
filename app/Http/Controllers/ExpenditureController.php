<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;
use App\Models\Item;
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

        $expenditure = $request->user()->expenditures()->create($request->only('item_id', 'amount', 'description'));

        return redirect()->back()->with('success', 'Expenditure added successfully');
    }

    public function viewExpenditures()
    {
        $expenditures = auth()->user()->expenditures()->with('item')->get();

        return view('expenditures.index', compact('expenditures'));
    }
}
