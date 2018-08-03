<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\mc_production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use Session;

class SearchController extends Controller
{
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
        return view('search');
    }

    public function singleSearch(){
        return view('singleSearch');
    }

    public function titleSearch(){
        return view('titleSearch');
    }

    public function isbnSearch(){
        return view('isbnSearch');
    }

    public function ssSearch(Request $request){

       $titleSerial =  $request->titleSerial;
       $isbn = $request->ISBN;
       $mode = $request->mode;
       $pbonum =$request ->PBONum;

       $arr = array('PBONUM'=>$pbonum, 'ISBN'=>$isbn, 'TITLESERIAL'=>$titleSerial);
       $fin_arr = array('PONUM'=>$pbonum, 'ISBN'=>$isbn,'TITLENAME'=>$titleSerial);
       foreach($arr as $key=>$value){
           if(is_null($value)){
               unset($arr[$key]);
           }
       }
       foreach($fin_arr as $key=>$value){
           if(is_null($value)){
               unset($fin_arr[$key]);
           }
       }
       if(sizeof($arr)==0 && sizeof($fin_arr)==0){
        Session::flash('error','Please enter a value!');
        return view('singleSearch');
    }
      

        $production_results = DB::table('mcproduction')->select('*')->orwhere($arr)->get();
        $fin_results =  DB::table('purchaseorder')->select('*')->orwhere($fin_arr)->get();
     

       //echo($fin_results);
       $result =array(true);
       //print_r($production_results);
      //print_r($fin_results);
    return view('singleSearch',compact("production_results","fin_results","result"));
       
          
      

    }// end of sssearch 

    public function ttSearch(Request $request){
        
        $titlenuma  = $request->titlenum;
        $titleArr = array();
        for($i=1; $i<=$titlenuma; $i++){
            $titleval = "title$i";
            $eachTitle = $request->$titleval;
            if($eachTitle!= null || $eachTitle !=''){
                array_push($titleArr, strtoupper($eachTitle));
            }
        }

        if(sizeof($titleArr)==0){
            Session::flash('error','Please enter a value!');
            return view('titleSearch');
        }
      
       
        $finTitleArr = $titleArr;
        $productionSpec_query = DB::table('mcproduction')->select('TITLE','ISBN','TITLESERIAL','EXTENT_COVER','HEIGHT','WIDTH','USUAGE1','PAPERTYPE1','FINISHING1','NUMOFCOLOUR1','USAGE2','PAPERTYPE2','FINISHING2','NUMOFCOLOUR2','BINDING');

        
        $production_query = DB::table('mcproduction')->select('*');
       
        foreach($titleArr as $title){
            $productionSpec_query->orWhere('TITLESERIAL',$title);
            $production_query->orWhere('TITLESERIAL',$title);
        }
        $productionSpec_query->groupBy('TITLESERIAL')->orderby('PODATE','asc');
        //var_dump($productionSpec_query);
        $productionSpec_results = $production_query->get();
        $productionSpec_results=$productionSpec_results->unique('TITLESERIAL');
        
         
        $production_results = $production_query->get();
        $production_results = $production_results->sortBy('TITLESERIAL');
       
        $fin_query = DB::table('purchaseorder')->select('*');
        foreach($titleArr as $title){
            $fin_query->orWhere('TITLENAME', $title);
        }
        $fin_results = $fin_query->get();
        
        foreach($productionSpec_results as $a){
            $foundTitle =strtoupper($a->TITLESERIAL);
            if(($key=array_search(strtoupper($foundTitle),$titleArr))!==false){
                unset($titleArr[$key]);
            }
        }
      
        foreach($fin_results as $fin){
            $foundTitle = $fin->TITLENAME;
            if(($key=array_search(strtoupper($foundTitle),$finTitleArr))!==false){
                unset($finTitleArr[$key]);
            }
        }
        $result =array(true);
        return view('titleSearch',compact("production_results","productionSpec_results","fin_results","result","titleArr","finTitleArr"));

    }


    public function iSearch(Request $request){
        
        $isbnnuma  = $request->isbn_num;
        $isbnArr = array();
        for($i=1; $i<=$isbnnuma; $i++){
            $isbnval = "isbn$i";
            $eachisbn = $request->$isbnval;
            if($eachisbn!= null || $eachisbn !=''){
                array_push($isbnArr,  strtoupper($eachisbn));
            }
        }

        if(sizeof($isbnArr)==0){
            Session::flash('error','Please enter a value!');
            return view('isbnSearch');
        }
     
        $finIsbnArr = $isbnArr;
        $productionSpec_query = DB::table('mcproduction')->select('TITLE','ISBN','TITLESERIAL','EXTENT_COVER','HEIGHT','WIDTH','USUAGE1','PAPERTYPE1','FINISHING1','NUMOFCOLOUR1','USAGE2','PAPERTYPE2','FINISHING2','NUMOFCOLOUR2','BINDING');

        
        $production_query = DB::table('mcproduction')->select('*');
       
        foreach($isbnArr as $isbn){
            $productionSpec_query->orWhere('ISBN',$isbn);
            $production_query->orWhere('ISBN',$isbn);
        }
        $productionSpec_query->groupBy('ISBN','TITLE')->orderby('PODATE','desc');
    
        $productionSpec_results = $production_query->get();
        $productionSpec_results=$productionSpec_results->unique('TITLESERIAL');
       
        $production_results = $production_query->get();
        $production_results = $production_results->sortBy('TITLESERIAL');

        $fin_query = DB::table('purchaseorder')->select('*');
        foreach($isbnArr as $isbn){
            $fin_query->orWhere('ISBN', $isbn);
        }
        $fin_results = $fin_query->get();
        
        foreach($productionSpec_results as $a){
            $foundIsbn = $a->ISBN;
            if(($key=array_search(strtoupper($foundIsbn),$isbnArr))!==false){
                unset($isbnArr[$key]);
            }
        }
        foreach($fin_results as $fin){
            $foundIsbn = $fin->ISBN;
            if(($key=array_search(strtoupper($foundIsbn),$finIsbnArr))!==false){
                unset($finIsbnArr[$key]);
            }
        }
        $result =array(true);
        return view('isbnSearch',compact("production_results","productionSpec_results","fin_results","result","isbnArr","finIsbnArr"));
    }

    public function searchPBO(Request $request){
        $selectedpbo = $request->input('PBONUM');
        $products= DB::table('mcproduction')->select('*');
        foreach($selectedpbo as $a){
            $products->orWhere('PBONUM', $a);
        }
        $products_results  = $products->get();
    
            return view('exportConfirmation',compact("products_results"));

    }

     public function export(Request $request){

        $data = $request->all();
        array_shift($data);
        

        if($data['export']=="Export"){
            Excel::create('Forecast',function($excel) use($data){
                $excel->sheet('Forecast', function($sheet) use($data){
                {
                    $sheet->cell('A1',function($cell){$cell->setValue('S/NO'); });
                    $sheet->cell('B1',function($cell){$cell->setValue('Title'); });
                    $sheet->cell('C1',function($cell){$cell->setValue('ISBN'); });
                    $sheet->cell('D1',function($cell){$cell->setValue('Material Number'); });
                    $sheet->cell('E1',function($cell){$cell->setValue('Extent(+4pp cvr)'); });
                    $sheet->cell('F1',function($cell){$cell->setValue('Height(mm)'); });
                    $sheet->cell('G1',function($cell){$cell->setValue('Width(mm)'); });
                    $sheet->cell('H1',function($cell){$cell->setValue('Binding'); });
                    $sheet->cell('I1',function($cell){$cell->setValue('Paper (Cover)'); });
                    $sheet->cell('J1',function($cell){$cell->setValue('Paper (Text)'); });
                    $sheet->cell('K1',function($cell){$cell->setValue('Cover Finishing'); });
                    $sheet->cell('L1',function($cell){$cell->setValue('Cover Printing'); });
                    $sheet->cell('M1',function($cell){$cell->setValue('Text Printing'); });
                    $sheet->cell('N1',function($cell){$cell->setValue('PO Qty'); });
                    $sheet->cell('O1',function($cell){$cell->setValue('Unit Cost'); });
                    $sheet->cell('P1',function($cell){$cell->setValue('Total Amount'); });
                    $i=2;
                    if(!empty($data)){
                        for($j=0; $j<$data['rowcount']; $j++){
                            
                            $sheet->cell('A'.$i, $data['titleserial'.$j]);
                            $sheet->cell('B'.$i, $data['title'.$j]);
                            $sheet->cell('C'.$i, $data['isbn'.$j]);
                            $sheet->cell('D'.$i, $data['comnum'.$j]);
                            $sheet->cell('E'.$i,$data['extentcover'.$j]);
                            $sheet->cell('F'.$i, $data['height'.$j]);
                            $sheet->cell('G'.$i, $data['width'.$j]);
                            $sheet->cell('H'.$i, $data['binding'.$j]);
                            $sheet->cell('I'.$i, $data['papertype1'.$j]);
                            $sheet->cell('J'.$i, $data['papertype2'.$j]);
                            $sheet->cell('K'.$i, $data['finishing1'.$j]);
                            $sheet->cell('L'.$i, $data['numofcolour1'.$j]);
                            $sheet->cell('M'.$i, $data['numofcolour2'.$j]);
                            $sheet->cell('N'.$i, $data['poqty'.$j]);
                            $sheet->cell('O'.$i, $data['unit'.$j]);
                            $sheet->cell('P'.$i, $data['totalprice'.$j]);

                            $i++;
                        }
                    }

                }
                });
            })->export('xls');
        }//end of export
         else if($data['export']=="Insert"){
                 return view('massiveInsert',compact("data"));
         }//end of insert

       
       
    }



    

    

}
