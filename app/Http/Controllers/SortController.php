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
                 Excel::filter('chunk')->load($path)->chunk( 100, function($results)
                 {
                     $i = 1;
                    foreach($results as $row){
                        $i++;
                        
                    }
                    echo ($i);
                 });
				// $data = Excel::load($path, function($reader) {
                //     $firstrow = $reader->first()->toArray();
                //     if(isset($firstrow['zip']) || isset($firstrow['Postal code'])|| isset($firstrow['pos code'])|| isset($firstrow['Postal Code'])||isset($firstrow['sort'])){
                //         $rows = $reader->all();
                //         print_r ($rows[0]);
                //         // foreach($rows as $row) {
                //         //     print_r($rows);
                //         // }
                //     }else{
                //         Session::flash('error', 'Different file format..');
				// 		echo "hi";	
				// 	   // return back(); 
                //     }
        
                 
                           
                //  });
                }
         }
    }//end of import
}
