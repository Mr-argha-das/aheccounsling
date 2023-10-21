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
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Team Members</div>
                    <div class="font-size-h2 font-w400 text-dark">120,580</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Customers</div>
                    <div class="font-size-h2 font-w400 text-dark">150</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                    <div class="font-size-h2 font-w400 text-dark">$3,200</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Avg Sale</div>
                    <div class="font-size-h2 font-w400 text-dark">$21</div>
                </div>
            </a>
        </div>
    </div>
@endsection
