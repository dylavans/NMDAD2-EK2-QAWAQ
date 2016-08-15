<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Product,
    Order,
    Customer

};

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getTotalOrders($query)
    {
        $query->select('orders')->concat()
    }
}
