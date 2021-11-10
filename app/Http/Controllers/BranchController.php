<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Controllers\BaseController;

class BranchController extends BaseController
{

    public function index(Request $request)
    {
        $branches = Branch::paginate(10);

        if($request->ajax()){
            $data['branches'] = Branch::all();
             return $this->sendResponse($data,'all branches');
        }

        return view('branches.index',compact('branches'));
    }


    public function create()
    {
        //return view('branches.create');
    }


    public function store(StoreBranchRequest $request){

        $branch = Branch::create([
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if($request->ajax()){
            $data['branch'] = $branch;
            return $this->sendResponse($data,'Branch successfully created');
        }

        //return back();
    }

    public function show(Branch $branch, Request $request)
    {
       if($request->ajax()){
        $data['branch'] = $branch;
        return $this->sendResponse($data,'show Branch');
       }

       //return view('branches.show',compact('branch'));
    }


    public function edit(Branch $branch, Request $request)
    {
        if($request->ajax()){
            $data['branch'] = $branch;
            return $this->sendResponse($data,'edit Branch');
           }

        //return view('branches.edit',compact('branch'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update([
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        if($request->ajax()){
            $data['branch'] = $branch;
            return $this->sendResponse($data,'Branch successfully updated');
        }

        //return back();
    }


    public function destroy(Branch $branch, Request $request)
    {
        $branch->delete();
        if($request->ajax()){
            $data['branch'] = $branch;
            return $this->sendResponse($data,'Branch successfully deleted');
        }

        //return back();

    }
}
