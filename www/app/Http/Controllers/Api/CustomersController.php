<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomersController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function show($id)
    {
        $customer = Customer::where('id', $id)
            ->take(1)
            ->get();


        return $customer ?: response()
            ->json([
                'error' => "Customer `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    public function update(Request $input, $id)
    {

    	$first_name = $input->first_name;
    	$last_name = $input->last_name;

    	Customer::find($id)
            ->update(array('first_name' => $first_name, 'last_name' => $last_name));

    	return Customer::all()->with('id', $id)->get();
    }

    public function registerCustomer(Request $input)
    {
        $customer = new Customer();
        $customer->user_name = $input['user_name'];
        $customer->first_name = $input['first_name'];
        $customer->last_name = $input['last_name'];
        $customer->password = $input['password'];
        $customer->email = $input['email'];
        $customer->save();
        return json_encode($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            if ($customer->delete()) {
                return response()
                    ->json($customer)
                    ->setStatusCode(Response::HTTP_OK);
            }

            return response()
                ->json([
                    'error' => "Customer `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }

        return response()
            ->json([
                'error' => "Customer `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
