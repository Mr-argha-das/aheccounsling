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

    {{ Form::bsSelect('filter_visits_to',$customArray,'GET_METHOD',['label'=>'Visit To']) }}
</div>

<div class="col-md-4 ">
    {{ Form::bsText('filter_visits_date_from','GET_METHOD',['label'=>'From','class'=>'dt_from']) }}
</div>
<div class="col-md-4 ">
    {{ Form::bsText('filter_visits_date_to','GET_METHOD',['label'=>'To','class'=>'dt_to']) }}
</div>
</div>
<div class="col-md-12">
                <input class="btn btn-info" type="submit" value="Submit">
                <a class="btn btn-secondary ml-2" href="{{ url()->current()}} ">Reset</a>
                <input class="btn btn-primary" type="submit" formaction="{{ url()->current().'/getExcelDownload' }}"  value="export Excel">
            </div>
        </div>
        </form></div></div></div>


<div class="block">
    <div class="block-content">
        <!--  <div class="row">
            <div class="col-md-1">
                <span class="badge badge-primary p-2">Company</span>

            </div>
            <div class="col-md-1"> <span class="badge badge-secondary p-2">Customer</span></div>
        </div> -->
        <table class="table table-vcenter table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Visits </th>
                    <th scope="col">Visits To</th>
                    <th scope="col">Date</th>
                    <th scope="col">Next Meeting Due</th>
                    <th scope="col">Remark</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($record as $ob) {
                    $rowId = $ob->visits_id;
                    //dd($ob->student_dob);
                ?>
                    <tr>
                        <tD><?= $sr++ ?></tD>
                        <td><span class="badge badge-<?= ($ob->visits_to == 1) ? 'primary' : 'secondary' ?> p-2"><?= $visitType[$ob->visits_to] ?></span></td>
                        <td><?= ($ob->visits_to == 1) ? $ob->com_name : $ob->cus_name ?></td>
                        <td><?= $timedate->dateFormat($ob->visits_date, 'out') ?></td>
                        <td><?= $timedate->dateFormat($ob->visits_next_due, 'out') ?></td>
                        <td>{{  $ob->visits_remark }}</td>



                      
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <hr>
        {{ $pagination->render() }}



    </div>
</div>
@endsection