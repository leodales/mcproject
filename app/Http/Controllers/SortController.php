<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;
use Excel;
use File;
use Illuminate\Support\Facades\Auth;
class SortController extends Controller
{
     private $arr = array();

    public function __construct()
    {
        
        $this->middleware('auth');
    }
	public function index()
	{
        if(Auth::user()->role == "staff")
		{
		 return view('sort');
		}else{
            return redirect('home');
        }
    }

    public function import(Request $request){
        $this->validate($request, array(
			'file'      => 'required'
        ));
        
        if($request->hasFile('file')){
			$extension = File::extension($request->file->getClientOriginalName());
			if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                
                
                $path = $request->file->getRealPath();
            
                $data = Excel::load($path, function($reader) use($path) {
                    $fulldataset = array();
                    $returnval = array();
                    $firstrow = $reader->first()->toArray();
                    // $keys = explode("0",$keys);
                    // $keys = implode(' ' ,array_keys($firstrow));
                    foreach ($firstrow as $key => $value) {
                        if($key != '0'){
                            $returnval[] =  $key;
                        }
                        
                    }
                  
                    print_r($returnval);
                   
                    // $keys = array_values($keys);
                    // print_r($keys); 
                   // $keys = implode(','array_values($keys));
                    //echo $keys;
                    if(isset($firstrow['zip']) || isset($firstrow['Postal code'])|| isset($firstrow['pos code'])|| isset($firstrow['Postal Code'])||isset($firstrow['sort'])){
                        $rows = $reader->all();
                        
                        Excel::filter('chunk')->load($path)->chunk(250, function($results) use($fulldataset)
                        {
                         
                           foreach($results as $row){
                                array_push($fulldataset, $row);
                               
                           }
                          //echo sizeof($fulldataset);
                          
                        });
                        
                    }else{
                        Session::flash('error', 'Different file format..');
						//echo "hi";	
					   // return back(); 
                    }
        
                    
                           
                  });
              
			
                }
         }
        
    }//end of import

    public function show($arr2){
        array_push($this->arr, $arr2);
        echo sizeof($this->arr);
    }
}
