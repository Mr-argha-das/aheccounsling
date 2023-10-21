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
                 <!--   <button type="button" formmethod="get" class="btn btn-sm btn-success">Export Excel</button> -->
                </span>
            </div>
        </div>
    </div>
</div>
<?=Design::$filterStart?>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_cus_id',$customArray,'GET_METHOD',['label'=>'Customer Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_family_id',$serviceArray,'GET_METHOD',['label'=>'Family Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_cus_email','GET_METHOD',['label'=>'Email']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_cus_mobile','GET_METHOD',['label'=>'Mobile']) }}
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
            <th >Customer Name</th>
            <th>Family</th>
            <th >Mobile No.</th>
            <th >Email Id</th>
            <th>No of Visits</th>
            <th>Category</th>
            <th>Date Of Birth</th>
            <th>Date of ANNIVERSARY</th>
            <th>Team Member</th>
            <th>Action</th>
      
    </thead>
    <tbody>
      <?php
      $sr= 1;

       foreach($record as $row):
       $encoded = urlencode(base64_encode($row->cus_id)); ?>
       <tr>
        <td>{{ $sr++ }}</td>
        <td>{{ $row->cus_name }}</td>
        <td>{{ $row->family_name }}</td>
        <td>{{ $row->cus_mobile }}</td>
        <td>{{ $row->cus_email }}</td>
        <td> {{ !empty($row->v_id)?$row->v_id:0 }}</td>
        <td>{{ $categorylist[$row->cus_category] }}</td>
        <td>{{ $timedate->dateFormat($row->cus_dob,'out') }}</td>
        <td>{{ $timedate->dateFormat($row->cus_doa,'out') }}</td>
        <td>{{ $row->team_name }}</td>
        <td><a href="<?=$viewpPath.'getDetials/'.$encoded?>" class="btn btn-info btn-sm">Detials</a></td>
        <?php
      endforeach; ?></tr>
    </tbody>
  </table>
  {{ $pagination->render() }}
<?=Design::tableSectionClose()?>



@endsection