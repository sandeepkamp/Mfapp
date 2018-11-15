<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Fund;
use Response;

class FundController extends Controller
{    
 
   /* public function FundHouseall()
    {
           // $funds = Fund::all();
           $funds = Fund::with('fund_id')->get();
           return response()->json($funds);
          //return response()->json(Fund::with('fund_scheme')->get());
    }*/

    public function FundHouseall()
{
       $fundDetails = Fund::with('categories.fundtype')->get();
       return response()->json(['data' => $fundDetails]);
       // $jsonData = json_encode($fundDetails->toArray());
    }
}
    

