<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(25);

        return view('admin.orders.index', compact('orders'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }
    public function showBill(Request $request)
    {
        $orderId = $request->input('order');
        $order = Order::with(['customer', 'orderProducts'])
            ->where('id', $orderId)
            ->first();
        if (!$order) {
            abort(404, 'Order not found');
        }
        return view('admin.print.bill', ['order' => $order]);
    }
    public function show($orderId)
    {
       
        $order = Order::with(['customer', 'orderProducts'])
            ->where('id', $orderId)
            ->first();
        if (!$order) {
            abort(404, 'Order not found');
        }
        return view('admin.orders.show', ['order' => $order]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            Order::create($request->all());

            return redirect()->route('orders.index')->with('success', 'Order created successfully!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $order = Order::find($id)->delete();
        return back()->with('success', 'Order Deleted');

    }

    public function reject($id){
        $order = Order::find($id);

        $status = $order->status == 'cancled' ? 'Pending' : 'cancled';
        $order->update(['status'=>$status]);

        return back()->with('success', 'Order Rejected !!');
    }
    public function approve($id){
        $order = Order::find($id);

        $status = $order->status == 'Approved' ? 'Pending' : 'Approved';
        $order->update(['status'=>$status]);

        return back()->with('success', 'Order Approved !!');
    }
}
