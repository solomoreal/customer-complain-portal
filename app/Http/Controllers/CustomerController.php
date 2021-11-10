<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Branch;
use App\Notifications\CustomerCreated;
use Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        if($request->ajax()){
            $success['customers'] = $customers;
            return $this->sendResponse($success, 'Managers retrieved');
        }

        return view('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        return view('customer.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
       if($request->hasFile('photo')){
        $original = $request->file('photo');
        $image = Image::make($original)->resize(100, 100);
        $photo_url = time().'.'.$original->extension();
        //upload image
        $path = $image->storeAs('public', $photo_url);

       }

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
            'photo' => $photo_url,
        ]);
        $customer->notify(new CustomerCreated($customer));
        if($request->ajax()){

            return $this->sendResponse($success, 'Customer Successfuly Created');
        }

        //return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if(Request::ajax()){
            $success['customer'] = $customer;
            return $this->sendResponse($success, 'customer');
        }

        //return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $branches = Branch::all();
        if(Request::ajax()){
            $data['branches'] = $branches;
            $data['customer'] = $customer;

            return $this->sendResponse($data,'use the data for customer update');
        }
        //return view('customer.edit',compact('branches','customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
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
       if($request->hasFile('photo')){
        $original = $request->file('photo');
        $image = Image::make($original)->resize(100, 100);
        $photo_url = time().'.'.$original->extension();
        //upload image
        $path = $image->storeAs('public', $photo_url);

       }else{
           $photo_url = $customer->photo;
       }

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
        $customer->notify(new CustomerCreated($customer));
        if($request->ajax()){

            return $this->sendResponse($success, 'Customer Successfuly Created');
        }

        //return back();
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();
        if(Request::ajax()){
            return $this->sendResponse([],'Customer successfully Deleted');
        }
        //return back();

    }
}
