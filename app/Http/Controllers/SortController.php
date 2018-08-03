<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SortController extends Controller
{
    //
    public function import(Request $request){
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
                
            }
        }
    }
}
