<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
class ManagerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::all();

        if($request->ajax()){
            $success['managers'] = $manager;
            return $this->sendResponse($success, 'Managers retrieved');
        }

        return view('manager.index',compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        return view('manager.register',compact('branches'));
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
        ]);

       $manager = Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
        ]);

        if($request->ajax()){
            $success['token'] =  $token = $manager->createToken($manager->email,['role:manager'])->plainTextToken;
            return $this->sendResponse($success, 'Manager Successfuly Created');
        }

        return view('manager.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        if(Request::ajax()){
            $success['manager'] = $manager;
            return $this->sendResponse($success, 'Manager Successfuly Created');
        }

        return view('manager.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $branches = Branch::all();
        return view('manager.edit',compact('branches','manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'branch_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|confirmed',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

       $manager = Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => bcript($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
        ]);

        if($request->ajax()){
            $success['manager'] = $manager;
            return $this->sendResponse($success, 'Manager Successfuly updated');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();
        if($request->ajax()){
            $success['manager'] = $manager;
            return $this->sendResponse($success, 'Manager Successfuly deleted');
        }

        return back();

    }
}
