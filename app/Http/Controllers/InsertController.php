<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class InsertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
        if(Auth::user()->role == "admin")
		{
		 return view('insert');
		}else{
            return redirect('home');
        }
    }
    public function confirmation(Request $request){
       $data =  $request->all();
       if($data!=null || sizeof($data)>0){
        
        return view('insert_confirmation',compact("data"));
       }else{
            Session::flash('error','Error in your input!');
            return view('insert');
       }
    }

    public static function insertfin($data){
        
        try{
            $fin_success = DB::table('purchaseorder')->insert($data);
            Session::flash('fin_success','Your Data(PONUM) '.$data[0]['PONUM'].' has successfully added into financial data!');
        }catch(QueryException $e){
            if($e->getCode() === '23000') {
            Session::flash('fin_error','Your Data(PONUM) '.$data[0]['PONUM'].' is not added into financial data successfully!! ( duplicate PO number)');
            }
        }
       
    }

    public static function insertfins($data,$i){
        
        try{
            $fin_success = DB::table('purchaseorder')->insert($data);
            Session::flash('fin_success'.$i,'Your Data(PONUM) '.$data[0]['PONUM'].' has successfully added into financial data!');
        }catch(QueryException $e){
            if($e->getCode() === '23000') {
            Session::flash('fin_error'.$i,'Your Data(PONUM) '.$data[0]['PONUM'].' is not added into financial data successfully!! ( duplicate PO number)');
            }
        }
       
    }


    public function insert(Request $request){
        $data = $request->all();
        
        array_shift($data);
        
       try{
            $prod_success = DB::table('mcproduction')->insert($data);
            
            Session::flash('prod_success','Your Data has successfully added into production data!');
       }catch(QueryException $e){
            if($e->getCode() === '23000') {
            Session::flash('prod_error','Your Data is not added into production data successfully!! ( duplicate PO number)');
            }
       }
       $finArr = array(['PONUM'=>$data['pbonum'],
        'TITLENAME'=>$data['titleserial'],'ISBN'=>$data['isbn'],
        'ORDERQTY'=>$data['poqty'],'UNITPRICE'=>$data['totalunit'],
        'TOTALPRICE'=>$data['totalcost']
        ]);
        if(array_key_exists('fin', $data)){
            $this->insertfin($finArr);
        }
      
       

      
     return view('insert');
    }

    public function massiveInsert(Request $request){
        $data = $request->all();
        array_shift($data);
        $prodArr = array();
      
        for($i=0; $i<$data['rowcount']; $i++){
            $prodArr = array(['PODATE'=>$data['podate'.$i],
            'PBONUM'=>$data['pbonum'.$i],'COMNUM'=>$data['comnum'.$i],
            'COMMITMENTTYPE'=>$data['commitmenttype'.$i],'TITLE'=>$data['title'.$i],
            'ISBN'=>$data['isbn'.$i],'NEWBOOKFLAG'=>$data['newbookflag'.$i],'PRINTERCODE'=>$data['printercode'.$i],
            'PRINTERNAME'=>$data['printername'.$i],'TITLESERIAL'=>$data['titleserial'.$i],'productcategory'=>$data['productcategory'.$i],
            'EXTENT_COVER'=>$data['extentcover'.$i],'Height'=>$data['height'.$i],'WIDTH'=>$data['width'.$i],'USAGE1'=>$data['usage1'.$i],
            'PAPERTYPE1'=>$data['papertype1'.$i], 'FINISHING1'=>$data['finishing1'.$i], 'NUMOFCOLOUR1'=>$data['numofcolour1'.$i],'EXTENT'=>$data['extent'.$i],
            'USAGE2'=>$data['usage2'.$i],'PAPERTYPE2'=>$data['papertype2'.$i], 'FINISHING1'=>$data['finishing1'.$i], 'NUMOFCOLOUR2'=>$data['numofcolour2'.$i],
            'BINDING'=>$data['binding'.$i],'POQTY'=>$data['poqty'.$i],'TOTALUNIT'=>$data['totalunit'.$i],'TOTALCOST'=>$data['totalcost'.$i]
            
            ]);
            $finArr = array(['PONUM'=>$data['pbonum'.$i],
                    'TITLENAME'=>$data['titleserial'.$i],'ISBN'=>$data['isbn'.$i],
                    'ORDERQTY'=>$data['poqty'.$i],'UNITPRICE'=>$data['totalunit'.$i],
                    'TOTALPRICE'=>$data['totalcost'.$i]
                    ]);
            $fin_checked = 'fin'.$i;
            $prod_checked = 'prod'.$i;
           
            if(array_key_exists($prod_checked, $data)){
                try{
                   
                    $prod_success = DB::table('mcproduction')->insert($prodArr);
                 
                   
                    Session::flash('prod_success'.$i,'Your Data(PBONum)'.$data['pbonum'.$i].' has successfully added into production data!');
               }catch(QueryException $e){
                    if($e->getCode() === '23000') {
                        
                    Session::flash('prod_error'.$i,'Your Data (PBONum)'.$data['pbonum'.$i].' is not added into production data successfully!! ( duplicate PO number)');
                    }
                }
            }
            
            if(array_key_exists($fin_checked, $data)){
                $this->insertfins($finArr,$i);
            }

        }
       $rowcount = array($data['rowcount']);
       
        return view('insert2',compact("rowcount"));
    }

    
}
