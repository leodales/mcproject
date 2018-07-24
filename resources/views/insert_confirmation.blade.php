@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Insert</div>

                <div class="panel-body">
                    <h4>Verify <b>production data</b></h4>
                    <h5 style="color:red"> Financial Data can be added by checking the checkbox</h5>
                     
                    <table style="width:100%; margin-top:5%; "  cellspacing="10">
                    <form method="POST" action="{{ route('insertDatabase') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                   
                        <tr>
                           <td>PO DATE</td>
                           <td><input type="date" name="podate" value="{{$data['podate']}}" /></td> 
                        </tr>
                        <tr>
                            <td>PBO Num*</td>
                            <td><input type="number" maxlength="11" size="11"  name="pbonum" value="{{$data['pbonum']}}" required /></td>
                        </tr>
                        <tr>
                            <td>Com Num</td>
                            <td><input type="number" maxlength="11" size="11"  name="comnum"  value="{{$data['comnum']}}"/></td>
                        </tr>
                        <tr>
                            <td>Commitment Type</td>
                            <td><input type="text" maxlength="1" size="1"  name="commitmenttype" style="padding-right:133px;" value="{{$data['commitmenttype']}}" /></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td><input type="text"  name="title" value="{{$data['title']}}" /></td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td><input type="text" name="isbn" value="{{$data['isbn']}}"/></td>
                        </tr>
                        <tr>
                            <td>New Book Flag</td>
                            <td><input type="text" name="newbookflag" value="{{$data['newbookflag']}}"/></td>
                        </tr>
                        <tr>
                            <td>Printer Code</td>
                            <td><input type="number" name="printercode" size="11" value="{{$data['printercode']}}"/></td>
                        </tr>
                        <tr>
                            <td>Printer Name</td>
                            <td><input type="text" name="printername" value="{{$data['printername']}}"/></td>
                        </tr>
                        <tr>
                            <td>Title Serial</td>
                            <td><input type="text" name="titleserial" value="{{$data['titleserial']}}"/></td>
                        </tr>
                        <tr>
                            <td>Product Category</td>
                            <td><input type="text" name="productcategory" value="{{$data['productcategory']}}"/></td>
                        </tr>
                        <tr>
                            <td>Extent (4PP+COVER)</td>
                            <td><input type="text" name="extent_cover" value="{{$data['extent_cover']}}"/></td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td><input type="number" maxlength="11" size="11" name="height" value="{{$data['height']}}"/></td>
                        </tr>
                        <tr>
                            <td>Width</td>
                            <td><input type="number" maxlength="11" size="11"  name="width" value="{{$data['width']}}"/></td>
                        </tr>
                        <tr>
                            <td>Usage </td>
                            <td><input type="text" name="usage1" value="{{$data['usage1']}}"/></td>
                        </tr>
                        <tr>
                            <td>Paper Type</td>
                            <td><input type="text" name="papertype1" value="{{$data['papertype1']}}"/></td>
                        </tr>
                        <tr>
                            <td>Finishing</td>
                            <td><input type="text" name="finishing1" value="{{$data['finishing1']}}"/></td>
                        </tr>
                        <tr>
                            <td>Num of colour</td>
                            <td><input type="text" name="numofcolour1" value="{{$data['numofcolour1']}}"/></td>
                        </tr>
                        <tr>
                            <td>Extent</td>
                            <td><input type="number"  maxlength="11" size="11"  name="extent" value="{{$data['extent']}}"/></td>
                        </tr>
                        <tr>
                            <td>Usage </td>
                            <td><input type="text" name="usage2" value="{{$data['usage2']}}"/></td>
                        </tr>
                        <tr>
                            <td>Paper Type</td>
                            <td><input type="text" name="papertype2" value="{{$data['papertype2']}}"/></td>
                        </tr>
                        <tr>
                            <td>Finishing</td>
                            <td><input type="text" name="finishing2" value="{{$data['finishing2']}}"/></td>
                        </tr>
                        <tr>
                            <td>Num of colour</td>
                            <td><input type="text" name="numofcolour2" value="{{$data['numofcolour2']}}"/></td>
                        </tr>
                        <tr>
                            <td>Binding</td>
                            <td><input type="text" name="binding" value="{{$data['binding']}}"/></td>
                        </tr>
                        <tr>
                            <td>PO Qty</td>
                            <td><input type="text" name="poqty" value="{{$data['poqty']}}"/></td>
                        </tr>
                        <tr>
                            <td>Total Unit</td>
                            <td><input type="text" name="totalunit" value="{{$data['totalunit']}}" /></td>
                        </tr>
                        <tr>
                            <td>Total Cost</td>
                            <td><input type="text" name="totalcost" value="{{$data['totalcost']}}"/></td>
                        </tr>
                        <tr>
                            <td>Add to financial Data?</td>
                            <td><input type="checkbox" id="agree" name="fin" value="fin">add</td>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Submit" style=" margin-top:30px" >    </td>
                        <tr>
                    </form>

                    </table>

                    
                </div>

                 
            </div>
        </div>
    </div>
</div>
@endsection
