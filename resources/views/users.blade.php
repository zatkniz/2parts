@extends('layouts.app')

@section('page-title')
    Χρήστες
@endsection

@section('breadcrumb')
    Χρήστες
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Λίστα Χρηστών</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <users></users>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
