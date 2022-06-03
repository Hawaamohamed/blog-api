<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\API\baseController as baseController;
use Validator; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;  

class registerController extends baseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        
        if($validator->fails()){
            return $this->sendError('Please validate error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Hawaa')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User Registered Successfully');
    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            
            $user = Auth::user();
            $success['token'] = $user->createToken('Hawaa')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User Login Successfully');
        }else{
            return $this->sendError('Please check your Auth', ['error' => 'Unauthorised']);
        }

 
 
    }
}
