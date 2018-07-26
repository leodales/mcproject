@extends('layouts.app')

@section('content')
<style>
    #form1{
        margin-left:76px;
    }
    </style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="{{asset('js/multipleform.js')}}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1   ">
            <div class="panel panel-default" style="width: 120%; ">
                <div class="panel-heading"><a href="{{ route('singleSearch') }}">&nbsp;&nbsp;Single Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<b>Title Search<b>&nbsp;&nbsp;|<a href = "{{route('isbnSearch')}}">&nbsp;&nbsp;ISBN Search</a></div>

                <div class="panel-body">
                    <h4 class="text-center">Select number of <b>Title Serial</b> to be searched </h4>
                    <div id="selected_form_code">
                        Title Serial: 
                        <select id="select_btn">
                            <option value="0">--Select No of Title to be searched--</option>
                            @for($i=1; $i<=15; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <br/>
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
                    <div id="form1">
                        <form action="{{ route('ttSearch') }}" id="form_submit" method="GET" name="form_submit">
                        {{csrf_field()}}
                        
                        </form>
                    </div>
                    @if(!empty($result))
                        @if(count($production_results)<1)
                            <h4 style="color:red;">No results found in production Data</h4>
                        @else
                            @if(!empty($titleArr))
                            <br/>
                                <h4 style="color:red;">List of unfound Title Serial: </h4>
                                @foreach($titleArr as $b)
                                    {{$b}},
                                @endforeach
                            @endif
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
                            @foreach($productionSpec_results as $a)
                            <tr>
                                <td>{{$a->TITLE}}</td>
                                <td>{{$a->ISBN}}</td>
                                <td>{{$a->TITLESERIAL}}</td>
                                <td>{{$a->EXTENT_COVER}}</td>
                                <td>{{$a->HEIGHT}}x{{$a->WIDTH}}</td>
                                <td>{{$a->USAGE1}}</td>
                                <td>{{$a->PAPERTYPE1}}</td>
                                <td>{{$a->FINISHING1}}</td>
                                <td>{{$a->NUMOFCOLOUR1}}</td>
                                <td>{{$a->USAGE2}}</td>
                                <td>{{$a->PAPERTYPE2}}</td>
                                <td>{{$a->FINISHING2}}</td>
                                <td>{{$a->NUMOFCOLOUR2}}</td>
                                <td>{{$a->BINDING}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                    </table>
                    <br/>
                    <br/>
                    @if(count($fin_results)<1)
                            <h4 style="color:red;"> No results found in Financial Data</h4>
                        @else
                        <h2>Results from financial data: </h2>
                            @if(!empty($finTitle_arr))
                                <br/>
                                <h4 style="color:red;">List of unfound Title Serial: </h4>
                                @foreach($finTitleArr as $b)
                                    {{$b}},
                                @endforeach
                            @endif
                            <div id="table"><table border="1" font-size="0.5em" cellpadding="10" ><thead>
                                <tr>
                                    <th scope="col" >PO Number</th>
                                    <th scope="col" padding-left="5em">Title Name  </th>
                                    <th scope="col" >ISBN</th>
                                    <th  scope="col">Order Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Total Price </th>
                            <tr></thead> <tbody>
                            @foreach($fin_results as $c)
                                <tr>
                                     <td>{{$c->PONUM}}</td>
                                    <td>{{$c->TITLENAME}}</td>
                                    <td>{{$c->ISBN}}</td>
                                    <td>{{$c->ORDERQTY}}</td>
                                    <td>{{$c->UNITPRICE}}</td>
                                    <td>{{$c->TOTALPRICE}}</td>
                                </tr>   
                            @endforeach
                            </tbody></table>
                            <br/>
                            <br/>
                            </div>
                        @endif
                        <!-- end of fin display-->

                         <h2>Results from production data: </h2>
                        <h4>Please select the rows required to be edited and export. </h4>
                        <form method="POST" action="{{ route('pbosearch') }}" enctype="multipart/form-data">
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
                                    <th scope="col"  width="10%">Total Unit Cost($)</th>
                                    <th scope="col" width="10%" >Total Cost($)</th>
                                <tr></thead> <tbody>
                        <?php $i=0; ?>
                        @foreach($production_results as $d)
                        
                        @if($i%2==0)
                        <tr bgcolor="#D3EAFF">
                            
                            <td><input type="checkbox" name="PBONUM[]" value="{{$d->PBONUM}}" ></td>
                            <td>{{$d->PODATE}}</td>
                            <td>{{$d->PBONUM}}</td>
                            <td>{{$d->TITLE}}</td>
                            <td>{{$d->ISBN}}</td>
                            <td>{{$d->TITLESERIAL}}</td>
                            <td>{{$d->POQTY}}</td>
                            <td>{{bcadd($d->TOTALUNIT,'0',2)}}</td>
                            <td>{{bcadd($d->TOTALCOST,'0',2)}}</td>
                        </tr>
                        @else
                        <tr>
                            
                            <td><input type="checkbox" name="PBONUM[]" value="{{$d->PBONUM}}" ></td>
                            <td>{{$d->PODATE}}</td>
                            <td>{{$d->PBONUM}}</td>
                            <td>{{$d->TITLE}}</td>
                            <td>{{$d->ISBN}}</td>
                            <td>{{$d->TITLESERIAL}}</td>
                            <td>{{$d->POQTY}}</td>
                            <td>{{bcadd($d->TOTALUNIT,'0',2)}}</td>
                            <td>{{bcadd($d->TOTALCOST,'0',2)}}</td>
                        </tr>
                        @endif
                        <?php $i++; ?>
                        @endforeach
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
