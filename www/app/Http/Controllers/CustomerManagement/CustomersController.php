<?php

namespace App\Http\Controllers\CustomerManagement;

use App\Models\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CustomersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {

        $customers = Customer::all();

        \Debugbar::info($customers);

        $data = [
            'customers' => $customers,
        ];

        return view('management.customers.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) : Response
    {
        Customer::find($id)->delete();

        return response(Response::HTTP_OK);
    }

}
