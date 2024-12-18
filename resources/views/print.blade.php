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
                    <div class="input-append date col-md-offset-2 col-md-2">            
                        <input id="printDate" type="text" class="form-control col-md-4" v-model="dateFrom"> 
                    </div>  
                    <div class="col-md-4">
                            <span class="input-group-addon no-pad">
                                <select id="prints-select" class="form-control pull-left">
                                    <option></option>
                                    <option value="1">Εκτύπωση εβδομαδιαίου προγράμματος</option>
                                    <option value="2">Εκτύπωση λίστας πελατών</option>
                                    <option value="3">Εκτύπωση λίστας πελατών με τζίρο</option>
                                    <option value="4">Εξαγωγη εβδομαδιαίου προγράμματος σε excel</option>
                                </select>
                                <button class="btn default date-reset" type="button" style="padding: 15px;" @click="printReport()">
                                    Εκτύπωση
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-if="showWeeklySchedule">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">εβδομαδιαίο Πρόγραμμα</span>
                    </div>
                </div>
                <div class="portlet-body">  
                    <weeklycustomers></weeklycustomers>
                </div>
            </div>
        </div>
    </div>
@endsection
