@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Insert</div>

                <div class="panel-body">
                    <h4>Please update in the necessary information to insert into <b>production data</b> and <b>financial Data</b></h4>
                    <h5 style="color:red">Please <b>uncheck</b> the box you would like to insert into</h5>
                    
                    @if ( Session::has('fin_success') )
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('fin_success') }}</strong>
                    </div>
                    {{Session::forget('fin_success')}}
                    @endif

                    @if ( Session::has('prod_success') )
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('prod_success') }}</strong>
                    </div>
                    {{Session::forget('prod_success')}}
                    @endif
                    
                    @if ( Session::has('fin_error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('fin_error') }}</strong>
                    {{Session::forget('fin_error')}} 
                    </div>
                    @endif
                    @if ( Session::has('prod_error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('prod_error') }}</strong>
                    {{Session::forget('prod_error')}} 
                    </div>
                    @endif
                    


                    @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('error') }}</strong>
                    {{Session::forget('error')}} 
                    </div>
                    @endif
                    <table style="width:100%; margin-top:5%; "  cellspacing="10">
                    <form method="POST" action="{{ route('massiveInsert') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    @for($j=0; $j<$data['rowcount']; $j++)
                    <tr>
                        <td><h5 style="color:green"> <b>Record: {{$j+1}}</b></h5></td>
                    </tr>
                    <tr>
                       <td>PO DATE</td>
                       <td><input type="date" name="podate{{$j}}" value="{{date("Y-m-d")}}" /></td> 
                    </tr>
                    <tr>
                        <td>PBO Num*</td>
                        <td><input type="number" maxlength="11" size="11" name="pbonum{{$j}}" value="{{$data['pbonum'.$j]}}" required /></td>
                    </tr>
                    <tr>
                        <td>Com Num</td>
                        <td><input type="number" maxlength="11" size="11" name="comnum{{$j}}" value="{{$data['comnum'.$j]}}" /></td>
                    </tr>
                    <tr>
                        <td>Commitment Type</td>
                        <td><input type="text" maxlength="1" size="1" name="commitmenttype{{$j}}" style="padding-right:133px;" value="{{$data['commitmenttype'.$j]}}" /></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><input type="text"  name="title{{$j}}" value="{{$data['title'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td><input type="text" name="isbn{{$j}}" value="{{$data['isbn'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>New Book Flag</td>
                        <td><input type="text" name="newbookflag{{$j}}" value="{{$data['newbookflag'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Printer Code</td>
                        <td><input type="number" name="printercode{{$j}}" size="11" value="{{$data['printercode'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Printer Name</td>
                        <td><input type="text" name="printername{{$j}}" value="{{$data['printername'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Title Serial</td>
                        <td><input type="text" name="titleserial{{$j}}" value="{{$data['titleserial'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Product Category</td> 
                        <td><input type="text" name="productcategory{{$j}}" value="{{$data['productcategory'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Extent (4PP+COVER)</td>
                        <td><input type="text" name="extentcover{{$j}}" value="{{$data['extentcover'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Height</td>
                        <td><input type="number" maxlength="11" size="11" name="height{{$j}}" value="{{$data['height'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Width</td>
                        <td><input type="number"  maxlength="11" size="11" name="width{{$j}}" value="{{$data['width'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Usage </td>
                        <td><input type="text" name="usage1{{$j}}" value="{{$data['usage1'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Paper Type</td>
                        <td><input type="text" name="papertype1{{$j}}" value="{{$data['papertype1'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Finishing</td>
                        <td><input type="text" name="finishing1{{$j}}" value="{{$data['finishing1'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Num of colour</td>
                        <td><input type="text" name="numofcolour1{{$j}}" value="{{$data['numofcolour1'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Extent</td>
                        <td><input type="number"  maxlength="11" size="11" name="extent{{$j}}" value="{{$data['extent'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Usage </td>
                        <td><input type="text" name="usage2{{$j}}" value="{{$data['usage2'.$j]}}"/td>
                    </tr>
                    <tr>
                        <td>Paper Type</td>
                        <td><input type="text" name="papertype2{{$j}}" value="{{$data['papertype2'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Finishing</td>
                        <td><input type="text" name="finishing2{{$j}}" value="{{$data['finishing2'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Num of Colour</td>
                        <td><input type="text"  name="numofcolour2{{$j}}" value="{{$data['numofcolour2'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Binding</td>
                        <td><input type="text" name="binding{{$j}}" value="{{$data['binding'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>PO Qty</td>
                        <td><input type="text" name="poqty{{$j}}" value="{{$data['poqty'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Total Unit</td>
                        <td><input type="text" name="totalunit{{$j}}" value="{{$data['unit'.$j]}}"/></td>
                    </tr>
                    <tr>
                        <td>Total Cost</td>
                        <td><input type="text" name="totalcost{{$j}}" value="{{$data['totalprice'.$j]}}"/></td>
                    </tr>
                    <tr>
                            <td>Add to financial Data?</td>
                            <td><input type="checkbox" id="agree" name="fin{{$j}}" value="fin" checked="checked">add</td>
                    </tr>
                    <tr>
                            <td>Add into production Data?</td>
                            <td><input type="checkbox" id="agree" name="prod{{$j}}" value="prod" checked="checked">add</td>
                    </tr>

                    <tr>
                        <td><br/></td>
                        
                    </tr>
                    @endfor
                    <tr>
                      <input type="hidden" value="{{$data['rowcount']}}" name="rowcount"/>
                    <td><input type="submit" value="Submit" style=" margin-top:30px">    </td>
                    <tr>
                    
                    </form>
                    </table>

                    
                </div>

                 
            </div>
        </div>
    </div>
</div>
@endsection
