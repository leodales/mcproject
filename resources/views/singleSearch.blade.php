@extends('layouts.app')

@section('content')
<style>
    th{
        align:"center";
    }
    </style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="width: 210%; margin-left:-55%;">
                <div class="panel-heading"><b>Single Search<b>&nbsp;&nbsp;|<a href="{{ route('titleSearch') }}">&nbsp;&nbsp;Title Search</a>&nbsp;&nbsp;|<a href = "{{route('isbnSearch')}}">&nbsp;&nbsp;ISBN Search</a></div>

                <div class="panel-body">
                    <h4 class="text-center">Fill in any specific field for a <b>single search</b></h4>
                    <form method="POST" action="{{ route('ssSearch') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                        <br/>
                        <label style="padding-right: 0.6%">Title Serial:</label>
                        <input type= "text" name="titleSerial"/>
                        <br />
                        <label style="padding-right: 3%">ISBN:</label>
                        <input type="text" name="ISBN"/>
                        <br/>       
                        <label>PO Number:</label>
                        <input type="number" name="PBONum" /> 
                       
    
        
                        <br />
                        <br/>   
                        <input type="submit" name="search" class="sub2" value="Search" />
                    </form>
                    @if(!empty($result))
                
                @if(count($production_results)<1)
                    <h4>No results found in production Data</h4>
                @else
                    <h2>Title Specification:</h2>
                    <table border="1"  font-size="0.5em" cellpadding="15" ><thead>
                    <tr>
                        <th scope="col">Title </th>
                        <th scope="col" >ISBN</th>
                        <th scope="col" >Title Serial</th>
                        <th scope="col" >Extent(+4pp Cover)</th>
                        <th scope="col" >size (Height x width)mm</th>
                        <th scope="col" >Usage 1</th>
                        <th scope="col" >Paper Type</th>
                        <th scope="col" >Finishing</th>
                        <th scope="col" >Num of Colour </th>
                        <th scope="col"  >Usage 2</th>
                        <th scope="col">Paper Type</th>
                        <th scope="col" >Finishing</th>
                        <th scope="col" >Num of Colour</th>
                        <th scope="col"  >Binding </th>
                    <tr></thead> <tbody>
                    @foreach($production_results as $b)
                        
                        <tr>
                        <td>{{$b->TITLE}}</td>
                        <td>{{$b->ISBN}}</td>
                        <td>{{$b->TITLESERIAL}}</td>
                        <td>{{$b->EXTENT_COVER}}</td>
                        <td>{{$b->HEIGHT}}x{{$b->WIDTH}}</td>
                        <td>{{$b->USAGE1}}</td>
                        <td>{{$b->PAPERTYPE1}}</td>
                        <td>{{$b->FINISHING1}}</td>
                        <td>{{$b->NUMOFCOLOUR1}}</td>
                        <td>{{$b->USAGE2}}</td>
                        <td>{{$b->PAPERTYPE2}}</td>
                        <td>{{$b->FINISHING2}}</td>
                        <td>{{$b->NUMOFCOLOUR2}}</td>
                        <td>{{$b->BINDING}}</td>
                        </tr>
                      
                    @endforeach
                    </tbody>
                    </table>
                    <br/>
                    <br/>
                    @if(count($fin_results)<1)
                    <h4 style="color:red;">No results found in financial Data</h4>
                    @else
                        <h2>Results from financial data: </h2>
                        <div id="table"><table border="1" font-size="0.5em" cellpadding="10" ><thead>
                            <tr>
                                <th scope="col" >PO Number</th>
                                <th scope="col" padding-left="5em">Title Name  </th>
                                <th scope="col" >ISBN</th>
                                <th  scope="col">Order Qty</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Total Price </th>
                            <tr></thead> <tbody>
                            @for($i=0; $i<count($fin_results);$i++)
                                <tr>
                                    <td>{{$fin_results[$i]->PONUM}}</td>
                                    <td>{{$fin_results[$i]->TITLENAME}}</td>
                                    <td>{{$fin_results[$i]->ORDERQTY}}</td>
                                    <td>{{$fin_results[$i]->UNITPRICE}}</td>
                                    <td>{{$fin_results[$i]->TOTALPRICE}}</td>
                                </tr>
                            @endfor
                            </tbody></table>
                            <br/>
                            <br/>
                    @endif
                    
                    <h2>Results from production data: </h2>
                    <h4>Please select the rows required to be edited and export. </h4>
                    <form method="POST"  action="{{ route('pbosearch') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div id="table">
                            <table border="1" font-size="0.5em" cellpadding="10" ><thead>
                                <tr>
                                    <th scope="col" width="10%">Required?</th>
                                    <th scope="col" width="15%">PO Date</th>
                                    <th scope="col" width="15%">PO Number</th>
                                    <th scope="col" width="20%">Title </th>
                                    <th scope="col" >ISBN</th>
                                    <th scope="col" >Title Serial</th>
                                    <th  scope="col"  >PO Qty</th>
                                    <th scope="col"  width="10%">Total Unit Cost</th>
                                    <th scope="col" width="10%" >Total Cost</th>
                                <tr></thead> <tbody>

                    @for($i=0; $i<count($production_results);$i++)
                        <tr>
                            
                            <td><input type="checkbox" name="PBONUM[]" value="{{$production_results[$i]->PBONUM}}" required ></td>
                            <td>{{$production_results[$i]->PODATE}}</td>
                            <td>{{$production_results[$i]->PBONUM}}</td>
                            <td>{{$production_results[$i]->TITLE}}</td>
                            <td>{{$production_results[$i]->ISBN}}</td>
                            <td>{{$production_results[$i]->TITLESERIAL}}</td>
                            <td>{{$production_results[$i]->POQTY}}</td>
                            <td>{{$production_results[$i]->TOTALUNIT}}</td>
                            <td>{{$production_results[$i]->TOTALCOST}}</td>
                        </tr>
                    @endfor
                    <tr>
                                
                        </tr>
                    </tbody>
                    </table>
                    <br/>
                    <input type="submit"  class="sub2" name="poForm" value="Export"/></form>

                @endif
                    

              
                @endif
                    
                </div>

               

                 
            </div>
        </div>
    </div>
</div>
@endsection
