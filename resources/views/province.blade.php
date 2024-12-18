@extends('layouts.app')

@section('page-title')
    Αποστολές Επαρχίας
@endsection

@section('breadcrumb')
    Αποστολές Επαρχίας
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Αποστολές Επαρχίας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <province ref="incomes"></province>
                </div>
            </div>
        </div>
    </div>
@endsection
