@extends('layouts.app')

@section('page-title')
    Υπόλοιπα
@endsection

@section('breadcrumb')
    Υπόλοιπα
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Λίστα Υπολοίπων</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <balances :serverdata="result"></balances>
                </div>
            </div>
        </div>
    </div>
@endsection
