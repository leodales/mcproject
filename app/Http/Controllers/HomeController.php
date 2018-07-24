<?php

namespace App\Http\Controllers;
use App\mcproduction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = mcproduction::get();
        $production=array();
        foreach ($data as $key) {
            $production[] = array($key['PODATE'],$key['PBONUM'],$key['COMNUM'],
            $key['COMMITMENTTYPE'],$key['TITLE'],$key['ISBN'],$key['NEWBOOKFLAG'],
            $key['PRINTERCODE'],$key['PRINTERNAME'],$key['TITLESERIAL'],$key['PRODUCTCATEGORY'],
            $key['EXTENT_COVER'],$key['HEIGHT'],$key['WIDTH'],$key['USAGE1'],
            $key['PAPERTYPE1'],$key['FINISHING1'],$key['NUMOFCOLOUR1'],$key['EXTENT'],
            $key['USAGE2'],$key['PAPERTYPE2'],$key['FINISHING2'],$key['NUMOFCOLOUR2'],
            $key['BINDING'],$key['POQTY'],$key['TOTALUNIT'],$key['TOTALCOST']);
        }
        
       
       // $productions = json_encode($data, true);
       $productions = json_encode($production,true);
        //print_r($productions);
        return view('welcome', compact("productions"));
    }

}
