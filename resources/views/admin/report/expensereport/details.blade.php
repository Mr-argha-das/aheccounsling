@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w600 mb-0 text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Employee Name : {{ $row->team_name }} </h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250"><span class="badge badge-primary pl-2 font-weight-normal p-2"> {{ $teamType[$row->team_type] }}</span></h6>
            </div>
            <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                   <!--  <a class="btn btn-primary fancyboxajax" href="<?=$viewpPath?>create"><i class="fa fa-plus mr-1"></i> Create New</a> -->
                </span>
            </div>
        </div>
    </div>
</div>

<div class="block">
    <div class="block-content p-3">
        <div class="block-content">
                            <div class="font-size-h4 mb-1">Employee Detials</div>
                            <div class="row table table-bordered">
                                <div class="col-md-3 table-bordered font-weight-bold">Employee Name</div><div class="col-md-3 table-bordered">{{ $row->team_name }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Login Type</div><div class="col-md-3 table-bordered">{{ $teamType[$row->team_type] }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Email Address</div><div class="col-md-3 table-bordered">{{ $row->team_email }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Mobile No.</div><div class="col-md-3 table-bordered">{{ $row->team_mob }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Office Mobile No.</div><div class="col-md-3 table-bordered">{{ $row->team_office_mob }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Address</div><div class="col-md-3 table-bordered">{{ $row->team_address }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">PAN No.</div><div class="col-md-3 table-bordered">{{ $row->team_pan }}</div>
                                <div class="col-md-3 table-bordered font-weight-bold">Addhar No.</div><div class="col-md-3 table-bordered">{{ $row->team_addhar }}</div>
                            </div>
                        <hr>
    </div></div>
</div>
<?=Design::tableSectionStart('Customer '.' List')?>
    
    <table class="table table-sm table-striped">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Family</th>
            <th>DOB</th>
            <th>Date of Anniversary</th>
            <th>Category</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
       
            <?php  
            $sr = 1;
            foreach($customerList as $obj)
            {
                ?> <tr>
                <td>{{$sr++ }}</td>
                <td><img src="<?=asset('assets/uploads/team/'.$obj->cus_upload_pic)?>" class="img img-thumbnail" width="100"></td>
                <td>{{ $obj->cus_name }}</td>
                <td>{{ $obj->cus_email }}</td>
                <td>{{ $obj->cus_mobile }}</td>
                <td>{{ $obj->cus_family }}</td>
                <td>{{ $timedate->dateFormat($obj->cus_dob,'out') }}</td>
                <td>{{ $timedate->dateFormat($obj->cus_doa,'out') }}</td>
                <td>{{ $obj->cus_category }}</td>
                <td>{{ $obj->cus_address }}</td>
                <td>{{ $timedate->dateFormat($obj->cus_create_date,'timestampOut') }}</td>
                <td> <a class="fancyboxajax " href="{{url($customer.$obj->cus_id)}}"><i class="fa fa-eye btn btn-info"><i> </a></td>
                <?php
            }
            ?>
        </tr>
    </table>

<?=Design::tableSectionClose()?>
<?=Design::tableSectionStart('All Visists '.' List')?>
     <div class="row">
            <div class="col-md-1">
                <span class="badge badge-danger p-2">Company</span>
               
            </div>
            <div class="col-md-1">  <span class="badge badge-info p-2">Customer</span></div>
        </div>
    <table class="table table-sm table-striped">
        <tr>
            <th width="10%">#</th>
            <th width="10%">Visist</th>
            <th width="10%">Customer / Company</th>
            <th width="10%">Visit Date</th>
            <th width="10%">NEXT MEETING DUE</th>
            <th width="50%">Discussions</th>
        
        </tr>


             <tbody>
                <?php
    $sr = 1;
   foreach($visitAll as $ob)
   {
       $rowId= $ob->visits_id;
       //dd($ob->student_dob);
       $type = ($ob->visits_to == 1)?'<span class="badge badge-danger p-2">'.$ob->com_name.'</span>':'<span class="badge badge-info p-2">'.$ob->cus_name.'</span>';
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=$visitType[$ob->visits_to]?></td>
                    <td><?=$type?></td>
                    <td><?=$timedate->dateFormat($ob->visits_date,'out')?></td>
                    <td><?=$ob->visits_next_due?></td>
                    <td>{{$ob->visits_desc}}</td>
                </tr>
                <?php
   }
                ?>
            </tbody>
        </tr>
    </table>

<?=Design::tableSectionClose()?>

<?=Design::tableSectionStart('All Tickets '.' List')?>
    
    <table class="table table-sm table-striped">
        <tr>
            <th>#</th>
            <th>Ticket </th>
            <th>Date</th>
            <th>Work</th>
            <th>Status</th>
            <th>Create At</th>
          
        </tr>
         <?php
    $sr = 1;
   foreach($ticketSystem as $ob)
   {
       $rowId= $ob->tk_id;
    
       //dd($ob->student_dob);
      // $type = ($ob->visits_to == 1)?$ob->com_name:$ob->cus_name;
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=($ob->tk_status == 1)?'<span class="badge badge-info p-1">'.$ob->tk_token.'</span>':'<span class="badge badge-success p-1">'.$ob->tk_token.'</span>';?></span></td>
                 
                    <td><?=$timedate->dateFormat($ob->tk_date,'out')?></td>
                    <td><?=$ob->tk_work?></td>
                    <td><?=($ob->tk_status == 1)?'<span class="badge badge-info p-1">'.$TicketStatus[$ob->tk_status].'</span>':'<span class="badge badge-success p-1">'.$TicketStatus[$ob->tk_status].'</span>';?></td>
                         <td><?=$timedate->dateFormat($ob->tk_creation_date,'timestampOut')?></td>
                   
                </tr>
                <?php
   }
                ?>
        </tr>
    </table>

<?=Design::tableSectionClose()?>
    </div>
</div>
@endsection