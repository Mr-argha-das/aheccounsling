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
<div class="row">
    <div class="col-md-6">
        <div class="block" style="border-left: 4px solid #5d81d1;">

            <div class="block-content">
                <caption><strong class="ml-3 mt-3">Pending & Open Tickets</strong></caption>
                <a href="<?= $pendingTikcetsCreate ?>" class="btn btn-primary btn-sm float-right">View All</a>

                <table class="table table-vcenter table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ticket</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php $sr = 1; ?>
                        @foreach($record['pendingtickets'] as $rowkey)
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td><span class="badge badge-danger">{{ $rowkey->tk_token }}</span></td>
                            <td> {{ $timedate->dateFormat($rowkey->tk_date,'out') }} </td>
                            <td> {{ $TicketStatus[$rowkey->tk_status] }} </td>
                            <td>
                                <a class="fancyboxajax" href="<?= $pendingTikcetsCreate . 'create?token=' . $rowkey->tk_id ?>"><i class="far fa-edit btn"></i></a>
                                <a class="btn btn-sm btn-outline-secondary" href="<?= $pendingTikcetsCreate . '?id=' . $rowkey->tk_id ?>">View Details</a>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <hr>




            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block" style="border-left: 4px solid #5d81d1;">
             <div class="block-content">
                <caption><strong class="ml-3 mt-3">Renewal Pending</strong></caption> <a href="<?= $investment ?>" class="btn btn-primary btn-sm float-right">View All</a>
                  <table class="table table-vcenter table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Service</th>
                            <th scope="col">Renewal Date</th>
                            <th scope="col">Date of Investment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $sr = 1; ?>
                        @foreach($record['pendingRenewal'] as $rowkey)
                        <?php $encode = urlencode(base64_encode($rowkey->inv_id)); ?>
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td>{{ $rowkey->cus_name }}</td>
                            <td>{{ $rowkey->service_name }}</td>
                            <td> {{ $timedate->dateFormat($rowkey->inv_date_renewable,'out') }} </td>
                            <td>{{ $timedate->dateFormat($rowkey->inv_doi,'out') }}</td>

                            <td><a class="fancyboxajax" href="<?= $renewalPath . $encode ?>"><i class="far fa-edit btn"></i></a></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <hr>




            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block" style="border-left: 4px solid #5d81d1;">

            <div class="block-content">
                <caption><strong class="ml-3 mt-3">Upcoming Birthday's</strong></caption>

                <table class="table table-vcenter table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>BirthDay's Date</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>

                    </thead>


                    <tbody>
                        <?php $sr = 1; ?>
                        @foreach($record['birthdays'] as $rowkey)
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td> {{ $timedate->dateFormat($rowkey->cus_dob,'out') }} </td>
                            <td>{{ $rowkey->cus_name }}</td>
                            <td> {{ $rowkey->cus_mobile }} </td>
                            <td> {{ $rowkey->cus_email }} </td>

                            <td><a class="fancyboxajax" href="<?= $customer . $rowkey->cus_id ?>"><i class="far fa-eye  btn btn-danger"></i></a></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <hr>




            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="block" style="border-left: 4px solid #5d81d1;">

            <div class="block-content">
                <caption><strong class="ml-3 mt-3">Upcoming Anniversary</strong></caption>
                <table class="table table-vcenter table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Anniversary</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php $sr = 1; ?>
                        @foreach($record['anniversary'] as $rowkey)
                        <?php $encode = urlencode(base64_encode($rowkey->cus_id)); ?>
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td> {{ $timedate->dateFormat($rowkey->cus_doa,'out') }} </td>
                            <td>{{ $rowkey->cus_name }}</td>
                            <td> {{ $rowkey->cus_mobile }} </td>
                            <td> {{ $rowkey->cus_email }} </td>
                            <td><a class="fancyboxajax" href="<?= $customer . $rowkey->cus_id ?>"><i class="far fa-eye btn btn-danger"></i></a></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <hr>




            </div>
        </div>

    </div>
    <div class="col-md-12">
        <div class="block" style="border-left: 4px solid #5d81d1;">

            <div class="block-content">
                <caption><strong class="ml-3 mt-3">Customer List</strong></caption> <a href="<?= $customer ?>" class="btn btn-primary btn-sm float-right">View All</a>

                <table class="table table-vcenter table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Customer Name</th>
                            <th scope="col">Family</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Addhaar number</th>
                            <th scope="col">PAN Number</th>
                            <th scope="col">Customer Category</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Date of Anniversary</th>

                            <th scope="col">Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php $sr = 1; ?>
                        @foreach($record['listcustomer'] as $rowkey)
                        <?php $encode = urlencode(base64_encode($rowkey->cus_id)); ?>
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td>{{ $rowkey->cus_name }}</td>
                            <td>{{ $rowkey->family_name }}</td>

                            <td> {{ $rowkey->cus_mobile }} </td>
                            <td> {{ $rowkey->cus_email }} </td>

                            <td> {{ $rowkey->cus_addhar }} </td>
                            <td> {{ $rowkey->cus_pan}} </td>
                            <td> {{ $categorylist[$rowkey->cus_category] }} </td>
                            <td> {{ $timedate->dateFormat($rowkey->cus_dob,'out') }} </td>
                            <td> {{ $timedate->dateFormat($rowkey->cus_doa,'out') }} </td>

                            <td><a class="fancyboxajax" href="<?= $customer . $rowkey->cus_id . '/edit' ?>"><i class="far fa-edit btn btn-info"></i></a><a class="fancyboxajax" href="<?= $customer . $rowkey->cus_id ?>"><i class="far fa-eye btn btn-danger"></i></a></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <hr>




            </div>
        </div>

    </div>
</div>
@endsection