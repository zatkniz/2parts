@extends('layouts.app')

@section('page-title')
    Ταμείο Ημέρας
@endsection

@section('breadcrumb')
    Ταμείο Ημέρας
@endsection

@section('content')
    <div class="row" id="incomes-portlet">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Έσοδα Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <incomes ref="incomes"></incomes>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Παραγγελιών: @{{sumaries[0]}}€</strong>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12">
                                <strong v-bind:class="{ active: isActive }">Σύνολο Εσόδων: @{{sumaries[1]}}€</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Μετρητών: @{{sumaries[4]}}€</strong>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12">
                                <strong v-bind:class="{ active: isActive }">Σύνολο Τραπεζών: @{{sumaries[5]}}€</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Αριθμός Παραγγελιών: @{{sumaries[6]}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Έξοδα Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <outcomes ref="outcomes"></outcomes>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Εξόδων: @{{sumaries[3]}}€</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Προσφορές Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <offers ref="offers"></offers>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Στατιστικά Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <chartjs-bar    :data="sumaries" 
                                    :bind="true"
                                    :datalabel="'Παραγγελίες, Έσοδα, Έξοδα'"
                                    :backgroundcolor="['#3a4656','#000','#E73D4A']"
                                    :labels="['Παραγγελίες', 'Έσοδα', 'Ημερήσια Υπόλοιπα' , 'Έξοδα']"></chartjs-bar>
                </div>
            </div>
        </div>
    </div>
@endsection
