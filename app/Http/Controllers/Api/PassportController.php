<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User; 
use App\Util;
use Illuminate\Support\Facades\Auth; 

class PassportController extends Controller
{
    public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){
 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
  
            $user = Auth::user();
  
            $success['token'] =  $user->createToken('MyApp')->accessToken;
  
            return response()->json(['success' => $success], $this->successStatus);
  
        }
  
        else{
  
            return response()->json(['error'=>'Unauthorised'], 401);
  
        }
  
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'bank_name' =>'required',
            'account_no' =>'required',
            'pan_no' => 'required',
            'phone_no' =>'required',
            'address' =>'required',
            ]);

            if ($validator->fails()) { 
                        return response()->json(['error'=>$validator->errors()], 401);            
                    }
            $input = $request->all();

            $input= [
                    'name'=>$input['name'],
                    'email'=>$input['email'],
                    'password' => bcrypt($input['password']), 
                    'bank_name' => $input['bank_name'],
                    'account_no' => $input['account_no'], 
                    'pan_no' => $input['pan_no'],
                    'phone_no' => $input['phone_no'], 
                    'address' => $input['address'], 
            ];

                    $user = User::create($input); 
                    $success['token'] =  $user->createToken('MyApp')->accessToken;
                    $success['name'] =  $user->name;
        
            return response()->json(['success'=>$success], $this-> successStatus); 
                }
            /** 
                 * details api 
                 * 
                 * @return \Illuminate\Http\Response 
                 */ 
                public function details()
                { 
                    $user = Auth::user(); 
                    return response()->json(['success' => $user], $this-> successStatus); 
                }
}
