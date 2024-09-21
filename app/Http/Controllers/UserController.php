<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function index(){
        $users = User::query()->paginate(5);
        return $this->sendSuccessWithResult("success",$users,200);
    }
    public function show(String $id){
        $user = User::find($id);
        if(!$user){
            return $this->sendError("Not Found",404);
        }
        return $this->sendSuccessWithResult("success",$user,200);
    }
    public function store(UserRequest $request){
        User::create($request->all());
        return $this->sendSuccess("Added User Successfully",201);
    }
    public function destroy(String $id){
        $user = User::find($id);
        if(!$user){
            return $this->sendError("Not Found",404);
        }
        $user->delete();
        return $this->sendSuccess("Deleted User successfully",204);
    }
}
