<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $addresses = Address::query()->paginate(5);
       return $this->sendSuccessWithResult("success",$addresses,200);
    }

    public function getUserAddresses(){
        $addresses = Address::where("user",request()->user()->id)->paginate(5);
        return $this->sendSuccessWithResult("success",$addresses,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        Address::create([
            "address"=>$request->address,
            "user"=>request()->user()->id,
        ]);
        return $this->sendSuccess("Added Address Successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::find($id);
        if(!$address){
            return $this->sendError("Not Found",404);
        }
        return $this->sendSuccessWithResult("success",$address,200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $address = Address::find($id);
        if(!$address){
            return $this->sendError("Not Found",404);
        }
        $address->update([
            "address"=>$request->address,
        ]);
        return $this->sendSuccess("Updated Address Successfully",205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);
        if(!$address){
            return $this->sendError("Not Found",404);
        }
        $address->delete();
        return $this->sendSuccess("Deleted Address Successfully",204);
    }
}
