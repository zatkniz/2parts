@extends('layouts.app')

@section('page-title')
    Παλαιότερα Ταμεία
@endsection

@section('breadcrumb')
    Παλαιότερα Ταμεία
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Επιλογή Ημερομηνίας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="input-group input-daterange">
                            <input id="dateFrom" type="text" class="form-control col-md-4" v-model="dateFrom">
                            <span class="input-group-addon no-pad" style="background-color: #32c5d2;">
                                <button id="dateFromBtn" class="btn default date-reset green" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                            <div class="input-group-addon">έως</div>
                            <input id="dateTo" type="text" class="form-control col-md-4" v-model="dateFrom">
                            <span class="input-group-addon no-pad" style="background-color: #32c5d2;">
                                <button id="dateToBtn" class="btn default date-reset green" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                            <span class="input-group-addon no-pad">
                                <button class="btn default date-reset" type="button" style="padding: 15px;" @click="findPastFund()">
                                    Αναζήτηση
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Έσοδα Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <incomes :isfromquery="true" :isranged="true" :serverdata="result"></incomes>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Παραγγελιών: @{{summaries[0]}}€</strong>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12">
                                <strong>Σύνολο Εσόδων: @{{summaries[1]}}€</strong>
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
                    <outcomes :isfromquery="true" :isranged="true" :serverdata="outfund"></outcomes>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Εξόδων: @{{summaries[3]}}€</strong>
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
                        <span class="caption-subject bold uppercase font-dark">Στατιστικά Ημέρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <chartjs-bar    :data="summaries" 
                                    :bind="true"
                                    :datalabel="'Παραγγελίες, Έσοδα, Έξοδα'"
                                    :backgroundcolor="['#3a4656','#000','#E73D4A']"
                                    :labels="['Παραγγελίες', 'Έσοδα', 'Ημερήσια Υπόλοιπα' , 'Έξοδα']"></chartjs-bar>
                </div>
            </div>
        </div>
    </div>
@endsection
