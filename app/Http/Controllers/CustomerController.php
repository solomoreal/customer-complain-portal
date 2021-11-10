<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Branch;
use App\Notifications\CustomerCreated;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::latest()->paginate(10);
        if($request->ajax()){
            $success['customers'] = $customers;
            return $this->sendResponse($success, 'Managers retrieved');
        }

        return view('customers.index',compact('customers'));
    }

    public function create(Request $request)
    {
        $branches = Branch::all();
        if($request->ajax()){
            $data['branches'] = $branches;
            return $this->sendResponse($data,'associate customer with branch');
        }
        //return view('customers.create',compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'photo' => 'required|image',
        ]);


       $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
        ]);
        if($request->hasFile('photo')){
            $original = $request->file('photo');
            $customer->addMedia($original)->toMediaCollection('photo');
           }
        $customer->notify(new CustomerCreated($customer));
        if($request->ajax()){

            return $this->sendResponse($success, 'Customer Successfuly Created');
        }

        //return back();
    }

    public function show(Customer $customer, Request $request)
    {
        if($request->ajax()){
            $success['customer'] = $customer;
            return $this->sendResponse($success, 'customer');
        }
        //return view('customers.show',compact('customer'));
    }

    public function edit(Customer $customer, Request $request)
    {
        $branches = Branch::all();
        if($request->ajax()){
            $data['branches'] = $branches;
            $data['customer'] = $customer;

            return $this->sendResponse($data,'use the data for customer update');
        }
        //return view('customers.edit',compact('branches','customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'branch_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);


       $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'photo' => $photo_url,
        ]);
        if($request->hasFile('photo')){
            $original = $request->file('photo');
            $customer->addMedia($original)->toMediaCollection('photo');
           }

        if($request->ajax()){

            return $this->sendResponse($success, 'Customer Successfuly Created');
        }

        //return back();
    }


    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();
        if($request->ajax()){
            return $this->sendResponse([],'Customer successfully Deleted');
        }
        //return back();

    }
}
