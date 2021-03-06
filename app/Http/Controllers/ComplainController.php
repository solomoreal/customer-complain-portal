<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateComplaintRequest;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Resources\ComplainResource;
use App\Http\Resources\BranchResource;
use App\Http\Controllers\BaseController;
use App\Models\Branch;

class ComplainController extends BaseController
{

    public function index(Request $request)
    {
        $complaints = Complain::paginate(10);
        if($request->expectsJson()){
            $data['compliants'] = ComplainResource::collection(Complain::all());
             return $this->sendResponse($data,'all compliants');
        }

        return view('compliants.index',compact('complaints'));
    }

    public function create(Request $request)
    {
        $branches = Branch::all();
        if($request->expectsJson()){
            $data['branches'] =BranchResource::collection($branches);
             return $this->sendResponse($data,'all branches');
        }

        //return view('compliants.create',compact('branches'));
    }

    public function store(StoreComplaintRequest $request)
    {
        $validated = $request->validated();
        $complaint = Complain::create([
            'title' => $request->title,
            'message' => $request->message,
            'branch_id' => $request->branch_id,
            'customer_id' => auth()->user()->id,
        ]);

        if($complaint){
            if($request->expectsJson()){
                $data['compliant'] = new ComplainResource($complaint);
                 return $this->sendResponse($data,'complaint successfully submitted, we will get back to you as soon as possible');
            }

            //return back()->with('success','complaint successfully submitted, we will get back to you as soon as possible');
        }
    }

    public function show(Complain $complain, Request $request)
    {
        if($request->expectsJson()){
            $data['complaint'] = new ComplainResource($complain);
            return $this->sendResponse($data,'show Branch');
           }

           //return view('complaints.show',compact('complain'));
    }


    public function edit(Complain $complain, Request $request)
    {
        $branches = Branch::all();
        if($request->expectsJson()){
            $data['branches'] = BranchResource::collection($branches);
            $data['complaint'] = new ComplainResource($complain);
            return $this->sendResponse($data,'update data');
        }

        //return view('compliants.edit',compact('branches','complain'));
    }


    public function update(UpdateComplaintRequest $request, Complain $complain)
    {
        $validated = $request->validated();
        $complain->update([
            'title' => $request->title,
            'message' => $request->message,
            'branch_id' => $request->branch_id,
            'customer_id' => auth()->user()->id,
        ]);

        if($complain){
            if($request->expectsJson()){
                $data['compliant'] = new ComplainResource($complain);
                 return $this->sendResponse($data,'complaint successfully submitted, we will get back to you as soon as possible');
            }

            //return back()->with('success','complaint successfully submitted, we will get back to you as soon as possible');
        }
    }


    public function destroy(Complain $complain, Request $request)
    {
        $complain->delete();
        if($request->expectsJson()){
            $data['complain'] = new ComplainResource($complain);
            return $this->sendResponse($data,'complain successfully deleted');
        }

        //return back();
    }
}
