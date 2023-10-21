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
    {{ Form::bsSelect('filter_misc_customer',$customArray,'GET_METHOD',['label'=>'Customer Name']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_misc_service',$serviceArray,'GET_METHOD',['label'=>'Misccellaneous Type']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_misc_date_from','GET_METHOD',['label'=>'From','class'=>'dt_from']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsText('filter_misc_date_to','GET_METHOD',['label'=>' To','class'=>'dt_to']) }}
</div>
<div class="col-md-3 ">
    {{ Form::bsSelect('filter_misc_status',[''=>'select option']+$statusDropdown,'GET_METHOD',['label'=>'Status']) }}
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
                    <th scope="col"> Misccellaneous type</th>
                    <th scope="col">Date of Investment</th>
                  
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $sr = 1;
   foreach($record as $ob)
   {
       $rowId= $ob->misc_id;
       $encode = urlencode(base64_encode($ob->misc_id));
       //dd($ob->student_dob);
                ?>
                <tr>
                    <tD><?=$sr++?></tD>
                    <td><?=$ob->cus_name?></td>
                    <td><?=$ob->m_name?></td>
                    <td><?=$timedate->dateFormat($ob->misc_doi,'out')?></td>
                    <td><?=$ob->misc_amount?></td>
                     <td><?=$statusDropdown[$ob->misc_status]?></td><!-- 
                     <td><?=$ob->misc_docs_no?></td> -->
                 
                    <td>
                        <?=Design::$dmStart?>
                        <a class="fancyboxajax" href="{{url($viewSl.$rowId)}}">view</a>
                       
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