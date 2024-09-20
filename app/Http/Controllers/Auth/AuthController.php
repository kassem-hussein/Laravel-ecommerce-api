<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(AuthRequest $request){
        User::create($request->all());
        return $this->sendSuccess("Registeration user successfully",201);
    }
    public function login(AuthRequest $request){
            if(!Auth::attempt($request->all())){
               return $this->sendError("Username or password not correct");
            }
            $user =User::find(Auth::user()->id);
            $result = [
                "user"=>$user,
                "token"=>$user->createToken("API TOKEN")->plainTextToken
            ];
            return $this->sendSuccessWithResult("logged successfully",$result,200);
    }

    public function profile(){
        $user = request()->user();
        return $this->sendSuccessWithResult("success",$user,200);
    }
}
