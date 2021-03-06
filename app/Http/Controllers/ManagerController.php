<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateManagerRequest;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\BranchResource;
use App\Http\Controllers\BaseController;

class ManagerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $managers = Manager::paginate(10);

        if($request->expectsJson()){
            $success['managers'] = ManagerResource::collection(Manager::all());
            return $this->sendResponse($success, 'Managers retrieved');
        }

        return view('managers.index',compact('managers'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('managers.create',compact('branches'));
    }

    public function store(StoreManagerRequest $request)
    {
       $validated = $request->validated();
       $manager = Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
        ]);

        if($request->expectsJson()){
            $success['token'] =  $token = $manager->createToken($manager->email,['role:manager'])->plainTextToken;
            return $this->sendResponse($success, 'Manager Successfuly Created');
        }

        //return view('managers.login');
    }

    public function show(Manager $manager, Request $request)
    {
        if($request->expectsJson()){
            $success['manager'] = new ManagerResource($manager);
            return $this->sendResponse($success, 'Manager');
        }

        //return view('managers.show',compact('manager'));
    }

    public function edit(Manager $manager)
    {
        $branches = Branch::all();
        //return view('managers.edit',compact('branches','manager'));
    }

    public function update(UpdateManagerRequest $request, Manager $manager)
    {
       $validated = $request->validated();
       $manager->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
        ]);

        if($request->expectsJson()){
            $success['manager'] = new ManagerResource($manager);
            return $this->sendResponse($success, 'Manager Successfuly updated');
        }

        //return back();
    }

    public function destroy(Manager $manager, Request $request)
    {
        $manager->delete();
        if($request->expectsJson()){
            $success['manager'] = new ManagerResource($manager);
            return $this->sendResponse($success, 'Manager Successfuly deleted');
        }

        //return back();

    }
}
