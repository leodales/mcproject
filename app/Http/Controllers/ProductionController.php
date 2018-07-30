<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;
use Excel;
use File;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
	{
		if(Auth::user()->role == "finance")
		{
			return response('Page not found', Response::HTTP_NO_CONTENT);
		}
		return view('add-production');
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
				$data = Excel::load($path, function($reader) {
				})->get();
				if(!empty($data) && $data->count()){

					$attb1 = array();
					
					foreach ($data as $key) {
						try{
						$attb = $key['pbo_num'];
						}catch(\ErrorException $e){
							Session::flash('error', 'Error inserting the data..');
							return back(); 
						}
						if($attb!=null||$attb!=''){
						array_push($attb1,$attb);
						//$attb[] = $key['pbo_num'];	
						//var_dump($attb);
						
						$insert[$key['pbo_num'] ] = [
						'PODATE' => $key['po_date'],
						'PBONUM' => $key['pbo_num'],
						'COMNUM' => $key['com_num'],
						'COMMITMENTTYPE'=> $key['commitment_type'] ,
                        'TITLE'=>$key['title'],
                        'ISBN'=>$key['isbn'],
                        'NEWBOOKFLAG'=> $key['new_book_flag'], 
                        'PRINTERCODE'=> $key['printer_code'],
                        'PRINTERNAME'=> $key['printer_name'],
                        'TITLESERIAL'=> $key['title_serial'],
                        'PRODUCTCATEGORY'=> $key['product_category'],
                        'EXTENT_COVER'=> $key['extent_4pp_cover'],
                        'HEIGHT'=> $key['heightmm'] ,
                        'WIDTH'=> $key['widthmm'],
                        'USAGE1'=> $key['usage_1'],
                    	'PAPERTYPE1'=> $key['paper_type1'],
                        'FINISHING1'=> $key['finishing1'],
                        'NUMOFCOLOUR1'=> $key['num_of_colour1'],
                        'EXTENT'=> $key['extent'],
                        'USAGE2'=> $key['usage_2'],
                        'PAPERTYPE2'=> $key['paper_type'],
                        'FINISHING2'=> $key['finishing'],
                        'NUMOFCOLOUR2'=> $key['num_of_colour'],
                        'BINDING'=> $key['binding'],
                        'POQTY'=> $key['po_qty'],
                        'TOTALUNIT'=> $key['total_unit_cost'],
						'TOTALCOST'=> $key['total_cost'],
						
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
							 
							if (!DB::table('mcproduction')->select('PBONUM')->where('PBONUM',$attbeach)->count()) {
								$insertData = DB::table('mcproduction')->insert($insert[$attbeach]);
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
							return view('add-production',compact("duplicationRec", "successfulRec"));
							
						}else if(!$insertRec && sizeof($duplicationRec)>0){
							
							Session::flash('error','No records imported. Duplication records exists ');
							return view('add-production',compact("duplicationRec", "successfulRec"));
						}else{
							Session::flash('success','Your Data has successfully imported');
							return view('add-production', compact("successfulRec"));
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


