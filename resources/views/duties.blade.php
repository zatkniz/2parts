@extends('layouts.app')

@section('page-title')
    Εκκρεμότητες
@endsection

@section('breadcrumb')
    Εκκρεμότητες
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Λίστα Εκκρεμότητων</span>
                    </div>
                    <div class="actions">
                        <a style="font-size: 25px;" @click="newDutyModal">
                            <i class="icon-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <duties ref="duties"></duties>
                </div>
            </div>
        </div>
    </div>
@endsection
