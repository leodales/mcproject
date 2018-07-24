@extends('layouts.app')
@section('content')

    <div class="container">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
       function check(){

        $("#checking").show();

        }
  </script>
        <h2 class="text-center">
            Finance Import
        </h2>

        @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    {{Session::forget('success')}}
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

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>

</div>
@endif



<form action="{{ route('import2') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Choose your xls/csv File : <input type="file" name="file" class="form-control">

    <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%" onClick="check();">
</form>
<div id="checking" style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #f4f4f4;z-index: 99;">
    <div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
    <center><img src="ajax-loader.gif" alt="Loading"></center>
    Checking and Uploading. Please Wait! <Br>Meanwhile Please <b style="color: red;">BE PATIENT :)</b>
    </div>
  </div>
@if(!empty($successfulRec))
   @foreach($successfulRec as $c)
        <h2>Number of Successful Records :{{$c}}</h2>
    @endforeach
 
@endif

@if(!empty($duplicationRec))
    <h2>List of Duplication Recrods: {{sizeof($duplicationRec)}}</h2>
@foreach($duplicationRec as $b)
    <p>{{$b}}</p>

@endforeach
@endif
</div>
@endsection