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
                        <span class="caption-subject bold uppercase font-dark">ΣΤΑΤΙΣΤΙΚΑ ΠΩΛΗΣΕΩΝ</span>
                    </div>
                </div>
                <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <employers-statistics></employers-statistics>
                        <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">ΣΤΑΤΙΣΤΙΚΑ ΜΗΝΙΑΙΩΝ ΠΩΛΗΣΕΩΝ</span>
                    </div>
                    <input id="dateFromBar" type="text" class="form-control col-md-4" v-model="dateFrom" style="width:100px;float:right;">                    
                </div>
                <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <employers-statistics-bars></employers-statistics-bars>
                        <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    {{--  <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">ΣΤΑΤΙΣΤΙΚΑ ΗΜΕΡΗΣΙΩΝ ΠΩΛΗΣΕΩΝ</span>
                    </div>
                    <input id="dateFromBar" type="text" class="form-control col-md-4" v-model="dateFrom" style="width:100px;float:right;">                    
                </div>
                <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <employers-statistics-bars-monthly></employers-statistics-bars-monthly>
                        <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>  --}}
@endsection
