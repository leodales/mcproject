<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseorder extends Model
{

    public $fillable = ['PONUM','TITLENAME','ISBN','ORDERQTY','UNITPRICE','TOTALPRICE'];

}