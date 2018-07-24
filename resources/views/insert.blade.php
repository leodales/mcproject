@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Insert</div>

                <div class="panel-body">
                    <h4>Please fill in the necessary information to insert into <b>production data</b></h4>
                    <h5 style="color:red"> Financial Data can be added upon confirmation for production data</h5>
                    
                    
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
                    <form method="POST" action="{{ route('confirmInsert') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                        <tr>
                           <td>PO DATE</td>
                           <td><input type="date" name="podate" value="{{date("Y-m-d")}}" /></td> 
                        </tr>
                        <tr>
                            <td>PBO Num*</td>
                            <td><input type="number" maxlength="11" size="11" name="pbonum" required /></td>
                        </tr>
                        <tr>
                            <td>Com Num</td>
                            <td><input type="number" maxlength="11" size="11" name="comnum" /></td>
                        </tr>
                        <tr>
                            <td>Commitment Type</td>
                            <td><input type="text" maxlength="1" size="1" name="commitmenttype" style="padding-right:133px;" /></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td><input type="text"  name="title" /></td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td><input type="text" name="isbn"/></td>
                        </tr>
                        <tr>
                            <td>New Book Flag</td>
                            <td><input type="text" name="newbookflag"/></td>
                        </tr>
                        <tr>
                            <td>Printer Code</td>
                            <td><input type="number" name="printercode" size="11"/></td>
                        </tr>
                        <tr>
                            <td>Printer Name</td>
                            <td><input type="text" name="printername"/></td>
                        </tr>
                        <tr>
                            <td>Title Serial</td>
                            <td><input type="text" name="titleserial"/></td>
                        </tr>
                        <tr>
                            <td>Product Category</td>
                            <td><input type="text" name="productcategory"/></td>
                        </tr>
                        <tr>
                            <td>Extent (4PP+COVER)</td>
                            <td><input type="text" name="extent_cover"/></td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td><input type="number" maxlength="11" size="11" name="height"/></td>
                        </tr>
                        <tr>
                            <td>Width</td>
                            <td><input type="number"  maxlength="11" size="11" name="width"/></td>
                        </tr>
                        <tr>
                            <td>Usage </td>
                            <td><input type="text" name="usage1"/></td>
                        </tr>
                        <tr>
                            <td>Paper Type</td>
                            <td><input type="text" name="papertype1"/></td>
                        </tr>
                        <tr>
                            <td>Finishing</td>
                            <td><input type="text" name="finishing1"/></td>
                        </tr>
                        <tr>
                            <td>Num of colour</td>
                            <td><input type="text" name="numofcolour1"/></td>
                        </tr>
                        <tr>
                            <td>Extent</td>
                            <td><input type="number"  maxlength="11" size="11" name="extent"/></td>
                        </tr>
                        <tr>
                            <td>Usage </td>
                            <td><input type="text" name="usage2"/></td>
                        </tr>
                        <tr>
                            <td>Paper Type</td>
                            <td><input type="text" name="papertype2"/></td>
                        </tr>
                        <tr>
                            <td>Finishing</td>
                            <td><input type="text" name="finishing2"/></td>
                        </tr>
                        <tr>
                        <td>Num of Colour</td>
                        <td><input type="text"  name="numofcolour2" /></td>
                        </tr>
                        <tr>
                            <td>Binding</td>
                            <td><input type="text" name="binding"/></td>
                        </tr>
                        <tr>
                            <td>PO Qty</td>
                            <td><input type="text" name="poqty"/></td>
                        </tr>
                        <tr>
                            <td>Total Unit</td>
                            <td><input type="text" name="totalunit"/></td>
                        </tr>
                        <tr>
                            <td>Total Cost</td>
                            <td><input type="text" name="totalcost"/></td>
                        </tr>
                        <tr>
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
