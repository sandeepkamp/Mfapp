<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundScheme extends Model
{
    //
    protected $table ='funds';

    protected $fillable = [
        'fund_id',
        'fund_scheme',
    ];
   /* public function scheme() {
        return $this->belongsTo('App\Fund');
    }*/
    public function fundtype(){
        return $this->hasMany('App\Category','category_id');
        }
}
