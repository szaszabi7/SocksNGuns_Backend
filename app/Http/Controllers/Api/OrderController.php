<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "status" => "required|string",
            "user_id" => "required|integer",
            "total_price" => "required|integer|min:0"
        ]);

        $order = Order::create($data);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return response()->json(['message' => 'Nincs adat'], 404);
        } else {
            return response()->json($order);
        }
    }

    //Bejelentkezett user összes rendelését adja vissza.
    public function userOrders()
    {
        $order = Order::where('user_id', auth()->user()->id)->get();
        if (is_null($order)) {
            return response()->json(['message' => 'Nincs adat'], 404);
        } else {
            return response()->json($order);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            "status" => "required|string"
        ]);
        $o = Order::findOrFail($order->id);
        $o->fill($request->only("status"));
        $o->save();
        return response()->json(["message" => "Adatkok sikeresen módosítva"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return response()->noContent();
    }

    public function orderCount() {
        $orders = Order::all()->count();
        return response()->json($orders);
    }
}
