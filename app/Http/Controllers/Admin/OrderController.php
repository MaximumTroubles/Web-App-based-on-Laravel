<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
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
        $orders = Order::with('status')->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $totalSum = Order::where('id',$id)->select('totalSum')->get();
        // dd($totalSum);
        $orderItems = OrderItem::where('order_id',$id)->get();
        return view('admin.order.show', compact('orderItems','totalSum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $statuses = Status::all()->pluck('name','id');
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);
        $order = Order::findOrFail($id);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->status_id = $request->status;
        $order->save();
        return redirect('/admin/order')->with('success', 'Заказ был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function aboutOrder($id)
    // {
    //     $order = OrderItem::find($id);
    //     return view('admin.order.about', compact('order'));
    // }
}
