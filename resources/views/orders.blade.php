@extends('layouts.app')

@section('page-title')
    Παραγγελίες
@endsection

@section('breadcrumb')
    Παραγγελίες
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Λίστα Παραγγελιών</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <orders></orders>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
