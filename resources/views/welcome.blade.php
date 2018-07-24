@extends('layouts.app')
@section('content')

    <!-- DT CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
   <!-- DT Jscript -->
    
        <div class="container-fluid " style="width:90%;  ">

                <h1>WELCOME {{ Auth::user()->name }} </h1>
                <h5 style="color:red; margin-bottom: 20px;">You may search production data by input the neccesary search value. For other features, please use other search features. </h5>
                <table border="0" id="example" class="display nowrap table-bordered" style="width:50%; ">
                    <thead>
                        <tr>
                            <th>PODATE</th>
                            <th>PBONUM</th>
                            <th>COMNUM</th>
							<th>COMMITMENTTYPE</th>
							<th>TITLE</th>
							<th>ISBN</th>
							<th>NEWBOOKFLAG</th>
							<th>PRINTERCODE</th>
							<th>PRINTERNAME</th>
							<th>TITLESERIAL</th>
							<th>PRODUCTCATEGORY</th>
							<th>EXTENT_COVER</th>
							<th>HEIGHT</th>
							<th>WIDTH</th>
							<th>USAGE1</th>
							<th>PAPERTYPE1</th>
							<th>FINISHING1</th>
							<th>NUMOFCOLOUR1</th>
							<th>EXTENT</th>
							<th>USAGE2</th>
							<th>PAPERTYPE2</th>
							<th>FINISHING2</th>
							<th>NUMOFCOLOUR2</th>
							<th>BINDING</th>
							<th>POQTY</th>
							<th>TOTALUNIT</th>
							<th>TOTALCOST</th>	
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
@endsection
