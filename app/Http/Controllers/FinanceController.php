<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;

class FinanceController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
		return view('add-finance');
	}

	public function import(Request $request){
		//validate the xls file
			
		$this->validate($request, array(
			'file'      => 'required'
		));
		
		if($request->hasFile('file')){
			$extension = File::extension($request->file->getClientOriginalName());
			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

				$path = $request->file->getRealPath();
				//$insert[] ='';
				config(['excel.import.startRow' => 4 ]);
				$data = Excel::load($path, function($reader) {
				})->get();
				if(!empty($data) && $data->count()){
					//var_dump($data);
					$attb1 = array();
					
					foreach ($data as $key) {
						//var_dump($key);
							
						try{
						$attb = $key['po_no.'];
						
						}catch(\ErrorException $e){
							Session::flash('error', 'Different file format..');
							
							return back(); 
						}
						if($attb!=null || $attb!=''){
						array_push($attb1,$attb);
						//$attb[] = $key['po_no.'];	
						
						
						$insert[$key['po_no.'] ] = [
						'PONUM' => $key['po_no.'],
						'TITLENAME' => $key['description'],
						'ISBN' => $key['item'],
						'ORDERQTY'=> $key['order_qty'] ,
                        'UNITPRICE'=>$key['unit_price'],
                        'TOTALPRICE'=>$key['total_price'],
                        
						
						];

					}

				}
					set_time_limit(0);
					$insertRec = false;
					$duplicationRec = array();
					$successfulRec = array();
					$count =0;
					$output ='';
					if(!empty($insert)){
						foreach ($attb1 as $attbeach) {
							 
							if (!DB::table('purchaseorder')->select('PONUM')->where('PONUM',$attbeach)->count()) {
								$insertData = DB::table('purchaseorder')->insert($insert[$attbeach]);
								$count ++;
								
								$insertRec = true; 
							}
							else{
								array_push($duplicationRec, $attbeach);

							}
						}// end of attb1 foreach loop 
						array_push($successfulRec, $count);
						
						if($insertRec && sizeof($duplicationRec)>0){
							Session::flash('success','Your Data has successfully imported. Duplication records exists');
							
							//Session::flash('error','List of duplicate record(s):');
							return view('add-finance',compact("duplicationRec", "successfulRec"));
							
						}else if(!$insertRec && sizeof($duplicationRec)>0){
							
							Session::flash('error','No records imported. Duplication records exists ');
							return view('add-finance',compact("duplicationRec", "successfulRec"));
						}else{
							Session::flash('success','Your Data has successfully imported');
							return view('add-finance', compact("successfulRec"));
						}
						
						
					
				} // end of !empty if loop
					else
					{
						
						Session::flash('error', 'Error inserting the data..');
						return back();
					}
				}

				//return back();

			}else {
				Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
				return back();
			}
		}
	}
}


