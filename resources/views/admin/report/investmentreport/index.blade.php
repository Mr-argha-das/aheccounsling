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
    {{ Form::bsSelect('filter_inv_customer',$customArray,'GET_METHOD',['label'=>'Customer Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_inv_service',$serviceArray,'GET_METHOD',['label'=>'Service Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_inv_date_from','GET_METHOD',['label'=>'Investment From','class'=>'dt_from']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_inv_date_to','GET_METHOD',['label'=>'Investment To','class'=>'dt_to']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_inv_date_renewablee_from','GET_METHOD',['label'=>'Renewal From','class'=>'dt_from']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_inv_date_renewablee_to','GET_METHOD',['label'=>'Renewal To','class'=>'dt_to']) }}
</div>
<div class="col-md-12">
                <input class="btn btn-info" type="submit" value="Submit">
                <a class="btn btn-secondary ml-2" href="{{ url()->current()}} ">Reset</a>
                <input class="btn btn-primary" type="submit" formaction="{{ url()->current().'/getExcelDownload' }}"  value="export Excel">
            </div>
        </div>
        </form></div></div></div>



<?=Design::tableSectionStart($title.' List')?>
 <table class="table table-vcenter table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> Customer Name</th>
                    <th scope="col"> Service</th>
                    <th scope="col">Date of Investment</th>
                    <th scope="col">Date of Renewal </th>
                    <th scope="col">Date of Maturity</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Renewal Applicable </th>
                    <th scope="col">Team</th>
                    <th scope="col">Document No.</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($record as $ob)
   {
       $rowId= $ob->inv_id;
       $encode = urlencode(base64_encode($ob->inv_id));
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=$customArray[$ob->inv_customer]?></td>
                    <td><?=$serviceArray[$ob->inv_service]?></td>
                    <td><?=$timedate->dateFormat($ob->inv_doi,'out')?></td>
                    <td><?=$timedate->dateFormat($ob->inv_date_renewable,'out')?></td>
                    <td><?=$timedate->dateFormat($ob->inv_date_maturity,'out')?></td>
                    <td><?=$ob->inv_amount?></td>
                    <td><?=$renewable[$ob->inv_renewable]?></td>
                     <td><?=$ob->team_name?></td>
                     <td><?=$ob->inv_docs_no?></td>
                 
                    <td>
                        <?=Design::$dmStart?>
                        <a class="fancyboxajax" href="{{url($viewinv.$rowId)}}">view</a>
                       
                        <?=Design::$dmClose?>
                    </td>
                </tr>
                <?php
   }
                ?>
            </tbody>
        </table>

        <hr>
        {{ $pagination->render() }}

<?=Design::tableSectionClose()?>



@endsection