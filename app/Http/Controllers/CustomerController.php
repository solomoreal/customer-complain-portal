<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\BranchResource;
use App\Http\Controllers\BaseController;
use App\Models\Branch;
use App\Notifications\CustomerCreated;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::latest()->paginate(10);
        if($request->expectsJson()){
            $success['customers'] = CustomerResource::collection(Customer::latest()->get());
            return $this->sendResponse($success, 'Customers retrieved');
        }

        return view('customers.index',compact('customers'));
    }

    public function create(Request $request)
    {
        $branches = Branch::all();
        if($request->expectsJson()){
            $data['branches'] = BranchResource::collection($branches);
            return $this->sendResponse($data,'associate customer with branch');
        }
        //return view('customers.create',compact('branches'));
    }

    public function store(StoreCustomerRequest $request)
    {
       $validated = $request->validated();
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
        if($request->expectsJson()){
            $success['customer'] = new CustomerResource($customer);
            return $this->sendResponse($success, 'Customer Successfuly Created');
        }

        //return back();
    }

    public function show(Customer $customer, Request $request)
    {
        if($request->expectsJson()){
            $success['customer'] = new CustomerResource($customer);
            return $this->sendResponse($success, 'customer');
        }
        //return view('customers.show',compact('customer'));
    }

    public function edit(Customer $customer, Request $request)
    {
        $branches = Branch::all();
        if($request->expectsJson()){
            $data['branches'] = BranchResource::collection($branches);
            $data['customer'] = new CustomerResource($customer);

            return $this->sendResponse($data,'use the data for customer update');
        }
        //return view('customers.edit',compact('branches','customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
       $validated = $request->validated();
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

        if($request->expectsJson()){

            return $this->sendResponse([], 'Customer Successfuly Updated');
        }

        //return back();
    }


    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();
        if($request->expectsJson()){
            return $this->sendResponse([],'Customer successfully Deleted');
        }
        //return back();

    }
}
