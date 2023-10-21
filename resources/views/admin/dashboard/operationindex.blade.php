@extends('layouts.'.config('backendLayout'))

@section('content')
<div class="block">
    <div class="block-content p-3">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center  text-center text-sm-left">
            <div class="flex-sm-fill">
                <h3 class="font-w500 mb-0 text-primary text-black-70 js-appear-enabled animated fadeIn" data-toggle="appear">Dashboard</h3>
                <h6 class="h6 text-primary font-w400 text-black-50 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">Dashboard</h6>
            </div>
        </div>
    </div>
</div>
<div class="block">
    <div class="block-content p-3">
        <table class="table table-bordered table-striped">
            <tr>
                <td colspan="2">Month</td>
                <td>Task</td>
                <td>Frequency</td>
                <td>1 Frequency</td>
                <td>2 Frequency</td>
                <td>3 Frequency</td>
                <td>4 Frequency</td>
            </tr>
            <?php
            foreach ($record as $ks) {
                foreach ($ks as $sk) {
                    if (strlen($sk['key']->op_month) > 1) {
                        $str = $sk['key']->op_month;
                    } else {
                        $str = '0' . $sk['key']->op_month;
                    }
            ?>
                    <tr>
                        <td colspan="2"><span class="badge badge-alert badge-info p-2"><?= $getMonth[$str] ?> / <?= $sk['key']->op_year ?></span></td>
                        <td>{{$sk['key']->task_name}} </td>
                        <td><span class="badge badge-secondary p-2">{{ $sk['key']->task_frequency  }}</span></td>
                        <?php $cols = count($sk['rows']);
                        $subs = 4 - $cols;

                        foreach ($sk['rows'] as $rk) {
                        ?><td>{{ $rk->op_desc }}</td><?php
                                                    }

                               if (!empty($subs)) {
                                $std = range(1, $subs);
                                foreach ($std as $dd) {
                                ?><td></td><?php
                                }    } ?>
                       </tr>
                  <?php  }  }   ?>
           </table>
      </div>
  </div>
@endsection