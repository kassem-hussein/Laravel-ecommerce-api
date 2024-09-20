<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{

    public function sendSuccess($message,$result = [],$code = 200){
        $response =[
            "success"=>true,
            "message"=>$message,
            "data"=>$result,
        ];
        return response()->json($response,$code);
    }

    public function sendError($message,$code = 400){
        $response = [
            "success"=>false,
            "message"=>$message,
        ];
        return response()->json($response,$code);
    }
}
