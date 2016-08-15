<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\{
    // Product,
    // Customer,
    Order
};

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        return Order::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

    public function create()
    {
        //
    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order = new Order();
        $order->customer_id = $request['customer_id'];
        $order->product_id = $request['product_id'];


        /*
        $rules = [
            'customer_id' => 'integer',
            'product_id' => 'integer',
        ];

        $this->validate($request, $rules);
        */

        /*
        $order = new Order($request->only(['customer_id', 'product_id']));

        $customer = Customer::find($request->get('customer')['id']);
        $order->customer()->associate($customer);

        $product = Product::find($request->get('product')['id']);
        $order->product()->associate($product);
        */

        /*
        $order = new Order();
        // $order = new Order($request->only(['id']));

        $product_id = $request['product_id'];

        $product = Product::get($product_id);

        $order->product()->associate($product);

        $customer_id = $request['customer_id'];

        $customer = Customer::get($customer_id);

        $order->customer()->associate($customer);

        */

        if ($order->save()) {
            return response()
                ->json($order)
                ->setStatusCode(Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('id')->find($id);

        return $order ?: response()
            ->json([
                'error' => "Order `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function getOrdersByCustomerId($customer_id)
    {
        /*
        $orders = Order::find($customer_id);

        return $orders ?: response()
            ->json([
                'error' => "Order not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
        */

        $events = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'product.id')
            ->where('orders.customer_id', $customer_id)
            ->get();
        return $events;

        /*
        $orders = Order::all()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.customer_id', $customer_id)
            ->get();
        return $orders;
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response

    public function update(Request $request, $id)
    {
        //
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            if ($order->delete()) {
                return response()
                    ->json($order)
                    ->setStatusCode(Response::HTTP_OK);
            }

            return response()
                ->json([
                    'error' => "Order `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }

        return response()
            ->json([
                'error' => "Order `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
