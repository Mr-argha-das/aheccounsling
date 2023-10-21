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
<div class="col-md-4 ">
    {{ Form::bsSelect('filter_expense_type',$expenseType,'GET_METHOD',['label'=>'Expense Name']) }}
</div>

<div class="col-md-4 ">
    {{ Form::bsText('filter_expense_date_from','GET_METHOD',['label'=>'From','class'=>'dt_from']) }}
</div>
<div class="col-md-4 ">
    {{ Form::bsText('filter_expense_date_to','GET_METHOD',['label'=>'To','class'=>'dt_to']) }}
</div>
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
            <th >Date</th>
            <th>Expense Name</th>
            <th >Amount</th>
            <th>Created By</th>
            <th>Role</th>
      
    </thead>
    <tbody>
      <?php
      $sr= 1;
      $amt = 0;
       foreach($record as $row):
       
      // print_r($row);die; ?>
       <tr>
        <td>{{ $sr++ }}</td>
         <td>{{ $timedate->dateFormat($row->expense_date,'out') }}</td>
      
        <td>{{ $row->exp_name }}</td>
        <td>{{ number_format($row->expense_amount,2) }}</td>
         <td>{{ $row->team_name }}</td>
         <td><span class="badge badge-secondary p-1">{{ $loginUsers[$row->team_type] }}</span></td>
       

       
        
   
        <?php
        $amt += $row->expense_amount;
      endforeach; ?></tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><span class="h4 badge badge-primary p-1">{{ number_format($amt,2) }}</span></td>
          <td></td>
      </tr>
    </tbody>
  </table>
<?=Design::tableSectionClose()?>



@endsection