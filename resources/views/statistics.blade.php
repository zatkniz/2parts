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
                    <div class="row">
                        <div class="input-append date col-md-offset-2 col-md-2"></div>  
                        <div class="col-md-4">
                                <span class="input-group-addon no-pad">
                                    <select id="statistics-select" class="form-control pull-left" v-model="statisticsSelect"  v-on:change="getYearStatistics()">
                                        <option value="1">Ημερήσια Σύνολα</option>
                                        <option value="2">Μηνιαία Σύνολα</option>
                                        <option value="3">Ετήσια Σύνολα</option>
                                        <option value="4">Ημερήσια Σύνολα Πελάτη</option>
                                        <option value="5">Μηνιαία Σύνολα Πελάτη</option>
                                        <option value="6">Ετήσια Σύνολα Πελάτη</option>
                                        <option value="7">Ημερήσια Σύνολα Εξόδων</option>
                                        <option value="8">Μηνιαία Σύνολα Εξόδων</option>
                                        <option value="9">Ετήσια Σύνολα Εξόδων</option>
                                    </select>
                                </span>
                                <span v-if="isWithCustomer">
                                    <statisticscustomers ref="statisticscustomers"></statisticscustomers>
                                </span>
                                <span v-if="isWithOutcome">
                                    <statisticsoutcome ref="statisticsoutcome"></statisticsoutcome>
                                </span>
                            </div>
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
                        <span class="caption-subject bold uppercase font-dark">Μηνιαία Ποσά</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <dailystatistics ref="dailystats"></dailystatistics>
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                                <strong v-bind:class="{ active: isActive }">Σύνολο Παραγγελιών: <span class="redspan">@{{sumaries[1]}}</span></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Συνολικά Ποσά: <span class="redspan">@{{sumaries[0]}}</span>€</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Πληρωμών: <span class="redspan">@{{sumaries[2]}}</span>€</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Εξόδων: <span class="redspan">@{{sumaries[3]}}</span>€</strong>
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
                        <span class="caption-subject bold uppercase font-dark">Γράφημα πίτας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <chartspie ref="chartspie"></chartspie>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Γράφημα Μπάρας</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <chartsbar ref="chartbar"></chartsbar>                
                </div>
            </div>
        </div>
    </div>
@endsection
