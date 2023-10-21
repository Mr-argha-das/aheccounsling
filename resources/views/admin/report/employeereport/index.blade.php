@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">{{ $title }}</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard / Report / {{ $title }} </h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                   <!--  <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a> -->
                </span>
            </div>
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_team_id',$getTeamList,'GET_METHOD',['label'=>'Team Member']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_team_type',$teamType,'GET_METHOD',['label'=>'Team Type']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_team_email','GET_METHOD',['label'=>'Email']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_team_mob','GET_METHOD',['label'=>'Mobile']) }}
</div>
<div class="col-md-12">
                <input class="btn btn-info" type="submit" value="Submit">
                <a class="btn btn-secondary ml-2" href="{{ url()->current()}} ">Reset</a>
                <input class="btn btn-primary" type="submit" formaction="{{ url()->current().'/getExcelDownload' }}"  value="export Excel">
            </div>
        </div>
        </form></div></div></div>



<?=Design::tableSectionStart($title.' List')?>
<table class="table table-vcenter ">
    <thead>
       
            <th >#</th>
            <th >Team Member</th>
            <th>Type</th>
            <th >Email</th>
            <th >Mobile No.</th>
            <th>No of Visits</th>
           
            <th>Open Ticket</th>
            <th>Date of Birth</th>
            <th>Action</th>
      
    </thead>
    <tbody>
      <?php
      $sr= 1;

       foreach($record as $row):
       $encoded = urlencode(base64_encode($row->team_id));
      // print_r($row);die; ?>
       <tr>
        <td>{{ $sr++ }}</td>
        <td>{{ $row->team_name }}</td>
        <td>{{ $teamType[$row->team_type] }}</td>
        <td>{{ $row->team_email }}</td>
        <td>{{ $row->team_mob }}</td>
        <td> {{ !empty($row->vsc)?$row->vsc:0 }}</td>
        <td>{{  !empty($row->ids)?$row->ids:0 }}</td>


        <td>{{ $timedate->dateFormat($row->team_dob,'out') }}</td>
        
        <td><a href="<?=$viewpPath.'getfullDetials/'.$encoded?>" class="btn btn-info btn-sm">Detials</a></td>
        <?php
      endforeach; ?></tr>
    </tbody>
  </table>
<?=Design::tableSectionClose()?>



@endsection