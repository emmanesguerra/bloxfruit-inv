<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Account;
use App\Models\Fruit;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    public function index()
    {
        $accounts = Account::all();
        $fruits = Fruit::all();
        $inv = Inventory::all();
        
        return view('inventory.index', [
            'accounts' => $accounts,
            'fruits' => $fruits,
            'inv' => $inv
        ]);
    }
    
    public function store(Request $request)
    {
        $inv = Inventory::where('account_id', $request->account_id)
                        ->where('fruit_id', $request->fruit_id)
                        ->first();
        
        if($inv) {
            if($request->isCheck == 'true') {
                $inv->quantity = $inv->quantity + 1;
            } else {
                $inv->quantity = $inv->quantity - 1;
            }
            $inv->save();
        } else {
            $createInv = new Inventory();
            $createInv->account_id = $request->account_id;
            $createInv->fruit_id = $request->fruit_id;
            $createInv->quantity = 1;
            $createInv->save();
        }
    }
}
