@extends('layouts.app')
@section('content')
<style>
#example{ 
    margin-bottom: 2000px;
}
</style>
    <!-- DT CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
   <!-- DT Jscript -->
    
        <div class="container-fluid " style="width:90%;  ">
            @if(Auth::user()->role!='staff')
                <h1>WELCOME {{ Auth::user()->name }} </h1>
                <h5 style="color:red; margin-bottom: 20px;">You may search production data by input the neccesary search value. For other features, please use other search features. </h5>
                <table border="0" id="example" class="display nowrap table-bordered"  style="width:50%; ">
                    <thead>
                        <tr>
                            <th><br/>PODATE</th>
                            <th><br/>PBONUM</th>
                            <th><br/>COMNUM</th>
							<th><br/>COMMITMENTTYPE</th>
							<th><br/>TITLE</th>
							<th><br/>ISBN</th>
							<th><br/>NEWBOOKFLAG</th>
							<th><br/>PRINTERCODE</th>
							<th><br/>PRINTERNAME</th>
							<th><br/>TITLESERIAL</th>
							<th><br/>PRODUCTCATEGORY</th>
							<th><br/>EXTENT_COVER</th>
							<th><br/>HEIGHT</th>
							<th><br/>WIDTH</th>
							<th><br/>USAGE1</th>
							<th><br/>PAPERTYPE1</th>
							<th><br/>FINISHING1</th>
							<th><br/>NUMOFCOLOUR1</th>
							<th><br/>EXTENT</th>
							<th><br/>USAGE2</th>
							<th><br/>PAPERTYPE2</th>
							<th><br/>FINISHING2</th>
							<th><br/>NUMOFCOLOUR2</th>
							<th><br/>BINDING</th>
							<th><br/>POQTY</th>
							<th><br/>TOTALUNIT</th>
							<th><br/>TOTALCOST</th>	
                        </tr>
                    </thead>

                </table>
                </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>     
    
    <script>
        $(document).ready(function() {
            
            var data = {!! $productions !!};
            //alert(data);
            
            $('#example').DataTable( {
            data:           data,
            deferRender:    true,
            scrollY:        400,
            scrollCollapse: true,
            scroller:       true,
            "sScrollX": "100%",
            "scrollX": true
            
        } );
        } );
    </script>
    @endif
    
@endsection
