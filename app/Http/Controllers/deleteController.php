<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class deleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
		return view('delete');
    }
    public function prodDelete()
	{
		return view('delete_prod');
    }
    public function finDelete()
    {
        return view('delete_fin');
    }

	public function prodRetrieval(Request $request){
        $titleSerial =  $request->titleSerial;
        $isbn = $request->ISBN;
        $mode = $request->mode;
        $pbonum =$request ->PBONum;
 
        $arr = array('PBONUM'=>$pbonum, 'ISBN'=>$isbn, 'TITLESERIAL'=>$titleSerial);
        
        foreach($arr as $key=>$value){
            if(is_null($value)){
                unset($arr[$key]);
            }
        }
        if(sizeof($arr)==0){
            Session::flash('zero','Please enter a value!');
            return view('delete_prod');
        }

        $production_results = DB::table('mcproduction')->select('*')->where($arr)->get();

        $result =array(true);

        return view('delete_prod',compact("production_results","result"));
    
    }
    
    public function prodDeleteProcess(Request $request){
        $ponum = $request->PBONUM;
        $results = DB::table('mcproduction')->where('PBONUM', $ponum)->delete();
      
        if($results!=0){
           Session::flash('success','Your Data has successfully delete!');
        }else{
            Session::flash('error','Your Data is not delete successfully!');
        }
        return view('delete_prod');
    }

    public function finRetrieval(Request $request){
        $titleSerial =  $request->titleSerial;
        $isbn = $request->ISBN;
        $mode = $request->mode;
        $pbonum =$request ->PBONum;
 
        $arr = array('PONUM'=>$pbonum, 'ISBN'=>$isbn, 'TITLENAME'=>$titleSerial);
        
        foreach($arr as $key=>$value){
            if(is_null($value)){
                unset($arr[$key]);
            }
        }
        if(sizeof($arr)==0){
            Session::flash('zero','Please enter a value!');
            return view('delete_fin');
        }

        $fin_results = DB::table('purchaseorder')->select('*')->where($arr)->get();

        $result =array(true);

        return view('delete_fin',compact("fin_results","result"));
    }

    public function finDeleteProcess(Request $request){
        $ponum = $request->PONUM;
        $results = DB::table('purchaseorder')->where('PONUM', $ponum)->delete();
      
        if($results!=0){
           Session::flash('success','Your Data has successfully delete!');
        }else{
            Session::flash('error','Your Data is not delete successfully!');
        }
        return view('delete_fin');
    }

}
