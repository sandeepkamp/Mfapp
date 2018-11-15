<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table ='fund_house';
    protected $fillable = ['fund_name','launch_date'];

   /* public function funds()
    {
      //  return $this->hasMany(FundsModel::class);   
      return $this->hasMany('Funds');
  
    }*/
    public function categories(){
      return $this->hasMany('App\FundScheme','fund_id');
    }
}
