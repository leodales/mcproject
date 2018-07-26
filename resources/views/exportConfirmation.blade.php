@extends('layouts.app')

@section('content')
<style>
    th{
        align:"center";
    }
    </style>
  <div class="row">

  
        <div class="col-md-10 col-md-offset-0" style="margin-left:60px">
            <div class="panel panel-default" style="width:110%;">
                <div class="panel-heading"><a href="{{ route('singleSearch') }}">&nbsp;&nbsp;Single Search</a>&nbsp;&nbsp;|<a href="{{ route('titleSearch') }}">&nbsp;&nbsp;Title Search</a>&nbsp;&nbsp;|<a href = "{{route('isbnSearch')}}">&nbsp;&nbsp;ISBN Search</a></div>

                <div class="panel-body"  >
                    <h4 class="text-center">Please edit the PO Qty(Forecast Qty), unit cost and total amount </h4>
                    <form method="POST" action="{{ route('export') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    <table border="1"  font-size="0.5em" cellpadding="15" ><thead>
                    <tr>
                                    <th scope="col" >S/No</th>
                                    <th scope="col" >Title</th>
                                    <th scope="col" >ISBN</th>
                                    <th scope="col" >Material Number</th>
                                    <th scope="col" >Extent (+4pp cvr) </th>
                                    <th scope="col" >Height(mm)</th>
                                    <th scope="col" >Width(mm)</th>
                                    <th scope="col" >Binding</th>
                                    <th scope="col"> Paper (Cover) </th>
                                    <th scope="col"> Paper (text) </th>
                                    <th scope="col"> Cover Finishing</th>
                                    <th scope="col" >Cover Printing</th>
                                    <th scope="col" >Text Printing</th>
                                    <th  scope="col" >&nbsp;&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Qty &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col"  >Unit Cost&nbsp;&nbsp;</th>
                                    <th scope="col"  >Total&nbsp;&nbsp; Amount&nbsp; &nbsp;</th>
                    </tr></thead> <tbody>
                    <?php  $i=0; ?>
                       @foreach($products_results as $b)
                       
                                <tr>
                                    <input type="hidden" value="{{$b->PODATE}}" name="podate{{$i}}"/>
                                    <input type="hidden" value="{{$b->PBONUM}}" name="pbonum{{$i}}"/>
                                    <input type="hidden" value="{{$b->COMMITMENTTYPE}}" name="commitmenttype{{$i}}"/>
                                    <input type="hidden" value="{{$b->NEWBOOKFLAG}}" name="newbookflag{{$i}}"/>
                                    <input type="hidden" value="{{$b->PRINTERCODE}}" name="printercode{{$i}}"/>
                                    <input type="hidden" value="{{$b->PRINTERNAME}}" name="printername{{$i}}"/>
                                    <input type="hidden" value="{{$b->PRODUCTCATEGORY}}" name="productcategory{{$i}}"/>
                                    <input type="hidden" value="{{$b->USAGE1}}" name="usage1{{$i}}"/>
                                    <input type="hidden" value="{{$b->FINISHING2}}" name="finishing2{{$i}}"/>
                                    <input type="hidden" value="{{$b->NEWBOOKFLAG}}" name="newbookflag{{$i}}"/>
                                    <input type="hidden" value="{{$b->EXTENT}}" name="extent{{$i}}"/>
                                    <input type="hidden" value="{{$b->USAGE2}}" name="usage2{{$i}}"/>
                                    <td>{{$b->TITLESERIAL}}</td>
                                    <input type="hidden" value="{{$b->TITLESERIAL}}" name="titleserial{{$i}}"/>
                                    <td>{{$b->TITLE}}</td>
                                    <input type="hidden" value="{{$b->TITLE}}" name="title{{$i}}"/>
                                    <td>{{$b->ISBN}}</td>
                                    <input type="hidden" value="{{$b->ISBN}}" name="isbn{{$i}}"/>
                                    <td>{{$b->COMNUM}}</td>
                                    <input type="hidden" value="{{$b->COMNUM}}" name="comnum{{$i}}"/>
                                    <td>{{$b->EXTENT_COVER}}</td>
                                    <input type="hidden" value="{{$b->EXTENT_COVER}}" name="extentcover{{$i}}"/>
                                    <td>{{$b->HEIGHT}}</td>
                                    <input type="hidden" value="{{$b->HEIGHT}}" name="height{{$i}}"/>
                                    <td>{{$b->WIDTH}}</td>
                                    <input type="hidden" value="{{$b->WIDTH}}" name="width{{$i}}"/>
                                    <td>{{$b->BINDING}}</td>
                                    <input type="hidden" value="{{$b->BINDING}}" name="binding{{$i}}"/>
                                    <td>{{$b->PAPERTYPE1}}</td>
                                    <input type="hidden" value="{{$b->PAPERTYPE1}}" name="papertype1{{$i}}"/>
                                    <td>{{$b->PAPERTYPE2}}</td>
                                    <input type="hidden" value="{{$b->PAPERTYPE2}}" name="papertype2{{$i}}"/>
                                    <td>{{$b->FINISHING1}}</td>
                                    <input type="hidden" value="{{$b->FINISHING1}}" name="finishing1{{$i}}"/>
                                    <td>{{$b->NUMOFCOLOUR1}}</td>
                                    <input type="hidden" value="{{$b->NUMOFCOLOUR1}}" name="numofcolour1{{$i}}"/>
                                    <td>{{$b->NUMOFCOLOUR2}}</td>
                                    <input type="hidden" value="{{$b->NUMOFCOLOUR2}}" name="numofcolour2{{$i}}"/>
                                    <td ><input type="number" step="any" value="{{$b->POQTY}}" name="poqty{{$i}}"/></td>
                                    <td><input type="number" step="any" value="{{number_format($b->TOTALUNIT,2)}}" name="unit{{$i}}"/></td>
                                    <td><input type="number"  step="any" value="{{$b->TOTALCOST}}" name="totalprice{{$i}}"/></td>
                                    <?php $i++; ?>
                                </tr>
                        @endforeach
                        </tbody></table>
                        <br/>

                        <input type="hidden" value="{{$i}}" name="rowcount"/><input type="submit" class="sub2" value="Export" name="export"/>&nbsp;&nbsp;<input type="submit" value="Insert" name="export"/></form>
                    
                    <br/>
                    <br/>
                   
                    
                </div>

               

                 
            
        </div>
    </div>
</div>
@endsection
