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


	public function export(){

        $data = DB::table('mcproduction')->select('*')->get();
		$ldate = date('Y-m-d H:i:s');
		
		$exportName = 'Production'.$ldate;


		Excel::create($exportName	, function($excel) use($data){
			$excel->sheet('production',function($sheet) use($data){
				{
					$sheet->cell('A1',function($cell){$cell->setValue('PO Date'); });
					$sheet->cell('B1',function($cell){$cell->setValue('PBO Num'); });
					$sheet->cell('C1',function($cell){$cell->setValue('Com Num'); });
					$sheet->cell('D1',function($cell){$cell->setValue('Commitment Type'); });
					$sheet->cell('E1',function($cell){$cell->setValue('Title'); });
					$sheet->cell('F1',function($cell){$cell->setValue('ISBN'); });
					$sheet->cell('G1',function($cell){$cell->setValue('New Book Flag'); });
					$sheet->cell('H1',function($cell){$cell->setValue('Printer Code'); });
					$sheet->cell('I1',function($cell){$cell->setValue('Printer Name'); });
					$sheet->cell('J1',function($cell){$cell->setValue('Title Serial'); });
					$sheet->cell('K1',function($cell){$cell->setValue('Product Category'); });
					$sheet->cell('L1',function($cell){$cell->setValue('Extent (+4pp Cover)'); });
					$sheet->cell('M1',function($cell){$cell->setValue('Height(mm)'); });
					$sheet->cell('N1',function($cell){$cell->setValue('Width(mm)'); });
					$sheet->cell('O1',function($cell){$cell->setValue('Usage 1'); });
					$sheet->cell('P1',function($cell){$cell->setValue('Paper Type1'); });
					$sheet->cell('Q1',function($cell){$cell->setValue('Finishing1'); });
					$sheet->cell('R1',function($cell){$cell->setValue('Num of Colour1'); });
					$sheet->cell('S1',function($cell){$cell->setValue('Extent'); });
					$sheet->cell('T1',function($cell){$cell->setValue('Usage 2'); });
					$sheet->cell('U1',function($cell){$cell->setValue('Paper Type'); });
					$sheet->cell('V1',function($cell){$cell->setValue('Finishing '); });
					$sheet->cell('W1',function($cell){$cell->setValue('Num of Colour'); });
					$sheet->cell('X1',function($cell){$cell->setValue('Binding'); });
					$sheet->cell('Y1',function($cell){$cell->setValue('PO Qty'); });
					$sheet->cell('Z1',function($cell){$cell->setValue('Total Unit Cost'); });
					$sheet->cell('AA1',function($cell){$cell->setValue('Total Cost'); });
					
					$i=2;
					if(!empty($data)){
						for($j=0; $j<sizeof($data); $j++){
							$sheet->cell('A'.$i, $data[$j]->PODATE);
							$sheet->cell('B'.$i, $data[$j]->PBONUM);
							$sheet->cell('C'.$i, $data[$j]->COMNUM);
							$sheet->cell('D'.$i, $data[$j]->COMMITMENTTYPE);
							$sheet->cell('E'.$i, $data[$j]->TITLE);
							$sheet->cell('F'.$i, $data[$j]->ISBN);
							$sheet->cell('G'.$i, $data[$j]->NEWBOOKFLAG);
							$sheet->cell('H'.$i, $data[$j]->PRINTERCODE);
							$sheet->cell('I'.$i, $data[$j]->PRINTERNAME);
							$sheet->cell('J'.$i, $data[$j]->TITLESERIAL);
							$sheet->cell('K'.$i, $data[$j]->PRODUCTCATEGORY);
							$sheet->cell('L'.$i, $data[$j]->EXTENT_COVER);
							$sheet->cell('M'.$i, $data[$j]->HEIGHT);
							$sheet->cell('N'.$i, $data[$j]->WIDTH);
							$sheet->cell('O'.$i, $data[$j]->USAGE1);
							$sheet->cell('P'.$i, $data[$j]->PAPERTYPE1);
							$sheet->cell('Q'.$i, $data[$j]->FINISHING1);
							$sheet->cell('R'.$i, $data[$j]->NUMOFCOLOUR1);
							$sheet->cell('S'.$i, $data[$j]->EXTENT);
							$sheet->cell('T'.$i, $data[$j]->USAGE2);
							$sheet->cell('U'.$i, $data[$j]->PAPERTYPE2);
							$sheet->cell('V'.$i, $data[$j]->FINISHING2);
							$sheet->cell('W'.$i, $data[$j]->NUMOFCOLOUR2);
							$sheet->cell('X'.$i, $data[$j]->BINDING);
							$sheet->cell('Y'.$i, $data[$j]->POQTY);
							$sheet->cell('Z'.$i, $data[$j]->TOTALUNIT);
							$sheet->cell('AA'.$i, $data[$j]->TOTALCOST);	
							$i++;
						}
					}


				}
			});
		})->export('xls');
	

        
           
        }//end of export

       
       
    }



