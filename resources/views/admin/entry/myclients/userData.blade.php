@extends('layouts.'.config('backendLayout'))
<?php 
$rmidlist  = \App\Model\Entry\RegisterMember_model::get();
 ?>
@section('content')


<div class="block" style="border-radius:15px">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / My Clients / {{ $title }} </h6>
            </div>
          
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary" href="<?= $viewpPath ?>userData/{{$client_id}}?download=download"><i class="fa fa-download mr-1"></i>DownloadCSV</a>
                    </span>
                </div>
                 
    
        </div>
    </div>
</div>

 

 
<div class="block p-3" style="border-radius:15px">
    <div class="table-vcenter table-responsive">
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Name</b></th>
                    <th><b>Mobile</b></th>
                   </tr>
            </thead>
            <tbody>
                 <?php  foreach ($records as $key => $obj) {  ?>
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $obj['name'] }}</td>
                        <td>{{ $obj['number'] }}</td>
                      </tr>
                        
                 <?php } ?>
            </tbody>
        </table>
   
    </div>
</div>
 
@endsection