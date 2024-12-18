@extends('layouts.app')

@section('page-title')
    Εκτύπωση Πωλητή
@endsection

@section('breadcrumb')
Εκτύπωση Πωλητή
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">ΛΙΣΤΑ ΕΙΣΦΟΡΩΝ</span>
                    </div>
                    <input id="dateFrom" type="text" class="form-control col-md-4" v-model="dateFrom" style="width:100px;float:right;">                    
                </div>
                <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <employee-customers :employee="employee"></employee-customers>
                        <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
@endsection
