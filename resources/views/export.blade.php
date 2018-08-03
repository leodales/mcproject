@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Export</div>

                <div class="panel-body">
                    <h4 class="text-center">Please select <b>Export </b>type</h4>
                    <table style="width:100%; margin-top:5%;">
                        <tr>
                            <td style="padding-left: 230px"><a href="{{route('prod_export')}}"><img src="warehouse.png" width="50px" height="50px"></a></td>
                            <td style="padding-right: 120px"><a href="{{ route('fin_export') }}"><img src="stats.png" width="50px" height="50px"></a></td>
                            
                        </tr>
                        <tr>
                            <td style="padding-left: 230px;">Production Data </td>
                            <td style="padding-right: 190px">Financial Data</td>
                            
                        </tr>
                    </table>

                    
                </div>

                 
            </div>
        </div>
    </div>
</div>
@endsection
