<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oI = OrderItem::where("order_id", $id)->get();
        $response = [];

        foreach ($oI as $item) {
            $singleItem = Item::findOrFail($item['item_id']);
            $singleItem->category;
            array_push($response, [
                'quantity' => $item['quantity'],
                'item' => $singleItem
            ]);
        }
        return response()->json($response);
    }
}
