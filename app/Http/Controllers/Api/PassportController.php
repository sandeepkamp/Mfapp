<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User; 
use App\Util;
use App\Fund;
use DB;
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
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6', 
            'c_password' => 'required|same:password', 
            'bank_name' =>'required',
            'account_no' =>'required|unique:users',
            'pan_no' => 'required|unique:users|alpha_num',
            'phone_no' =>'required|min:10|numeric',
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


                // Get all Fund House Names

                public function getFundDetails() 
                {
                    $allFund = Fund::all();
                    $allFund = DB::select('Select id,fund_name from fund_house');
                    if(empty($allFund))
                    {
                        $result = array("status"=>0);
                    }
                    else
                    {
                        $result = array("status"=>1,"data"=>$allFund);
                    }
                    return $result;
                }

                //Get All Funds Related To Equity Type

                public function getEquityFunds()  
                {
                    $allFund = Fund::all();
                    $allFund = DB::select('SELECT fund_house.fund_name,fund_house.launch_date,funds.fund_scheme,fund_category.category_name
                    FROM funds
                    JOIN fund_house  ON funds.fund_id = fund_house.id
                    JOIN fund_category  ON fund_category.category_id = funds.id WHERE category_name = "equity"') ;
                    if(empty($allFund))
                    {
                        $result = array("status"=>0);
                    }
                    else
                    {
                        $result = array("status"=>1,"data"=>$allFund);
                    }
                    return $result;
                }
}
