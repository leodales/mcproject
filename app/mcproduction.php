<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mcproduction extends Model
{
    protected $table = "mcproduction";
    
    protected $fillable = ['PODATE','PBONUM','COMNUM','COMMITMENTTYPE','TITLE','ISBN','NEWBOOKFLAG','PRINTERCODE','PRINTERNAME','TITLESERIAL','PRODUCTCATEGORY','EXTENT_COVER','HEIGHT','WIDTH','USAGE1','PAPERTYPE1','FINISHING1','NUMOFCOLOUR1','EXTENT','USAGE2','PAPERTYPE2','FINISHING2','NUMOFCOLOUR2','BINDING','POQTY','TOTALUNIT','TOTALCOST'];

}