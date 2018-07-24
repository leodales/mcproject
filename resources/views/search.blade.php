@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Search</div>

                <div class="panel-body">
                    <h4 class="text-center">Please select the search mode</h4>
                    <table style="width:100%; margin-top:5%;">
                        <tr>
                            <td style="padding-left: 120px"><a href="{{ route('singleSearch') }}"><img src="single.png" width="50px" height="50px"></a></td>
                            <td style="padding-left: 30px "><a href="{{ route('titleSearch') }}"><img src="title.png" width="50px" height="50px"></a></td>
                            <td style="padding-left: 70px"><a href="{{ route('isbnSearch') }}"><img src="isbn.png" width="50px" height="50px"></a></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 100px">Single Search</td>
                            <td>Title Serial Search</td>
                            <td style="padding-left: 52px">ISBN Search</td>
                        </tr>
                    </table>

                    
                </div>

                 
            </div>
        </div>
    </div>
</div>
@endsection
