<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
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
        $orders = Order::orderBy("id", "DESC")->get();
        return response()->json($orders);
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
        $order = Order::where('user_id', auth()->user()->id)->orderBy("id", "DESC")->get();
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

    public function newOrderCount() {
        $orders = Order::where("status", "Feldolgozásra vár")->count();
        return response()->json($orders);
    }

    public function getNewOrders() {
        $orders = Order::where("status", "Feldolgozásra vár")->get();
        return response()->json($orders);
    }

    public function order(Request $request) {
        $orderlist = $request->all();
        $order = new Order();
        $order->fill(['user_id' => auth()->user()->id,
                    'total_price' => 0]);
        $order->save();
        $orderId = $order->id;

        $totalPrice = 0;
        foreach ($orderlist as $item) {
            if (Item::where('id', $item['item_id'])->count() == 0) {
                Order::destroy($orderId);
                return response()->json(["message" => "Nincs ilyen id: " . $item['item_id']], 404);
            }
            $orderItem = new OrderItem();
            $orderItem->fill([
                'order_id' => $orderId,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ]);
            $orderItem->save();
            $totalPrice += Item::where('id', $item['item_id'])->pluck('price')->first();
        }

        $order->fill([
            'total_price' => $totalPrice
        ]);
        $order->save();

        return response()->json([$order, "success" => "Rendelés sikeresen leadva"], 201);
    }
}
