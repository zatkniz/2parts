@extends('layouts.app')

@section('page-title')
Πελατολόγιο
@endsection

@section('breadcrumb')
Πελατολόγιο
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Καρτέλα Πελάτη : @{{result.name}}</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-6">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="form_sample_1">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please
                                check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful!
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Κωδικός
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="name"
                                        v-model="result.id" disabled>
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter your full name</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Α.Φ.Μ.
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="email"
                                        v-model="result.afm">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Τηλέφ. 1
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="url"
                                        v-model="result.tel">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Τηλέφ. 2
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="number"
                                        v-model="result.tel2">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Κινητό
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="" name="digits"
                                            v-model="result.mobile">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">FAX
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon right">
                                        <input type="text" class="form-control" name="creditcard" placeholder=""
                                            v-model="result.fax">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Δ.Ο.Υ.</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        </span>
                                        <input type="text" class="form-control" name="email2" placeholder=""
                                            v-model="result.doy">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-2 control-label" for="form_control_1">Ενεργός</label>
                            <div class="col-md-10">
                                <div class="md-checkbox-list">
                                    <div class="md-checkbox">
                                        <input type="checkbox" name="checkboxes1[]" value="1" id="checkbox1_1"
                                            class="md-check" v-model="result.active">
                                        <label for="checkbox1_1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-2 control-label" for="form_control_1">Υπάλληλος</label>
                            <div class="col-md-10">
                                <div class="md-checkbox-list">
                                    <select id="delivery-select-customer" class="form-control"
                                        v-model="result.employee_id">
                                        <option></option>
                                        <option v-for="employee in employees" :value="employee.id">@{{employee.name}}
                                            @{{employee.surname}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="form_sample_1">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please
                                check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful!
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Επωνυμία
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="name"
                                        v-model="result.brand">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter your full name</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Υπεύθυνος
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="email"
                                        v-model="result.incharge">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Διεύθυνση
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="url"
                                        v-model="result.address">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Πόλη
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="number"
                                        v-model="result.state">
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Διακριτικό Όνομα
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Enter digits" name="digits"
                                            v-model="result.name">
                                        <div class="form-control-focus"> </div>
                                        <i class="fa fa-bell-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Email
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon right">
                                        <input type="email2" class="form-control" name="creditcard" placeholder=""
                                            v-model="result.email">
                                        <i class="fa fa-envelope"></i>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Επάγγελμα</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email2" placeholder=""
                                            v-model="result.job">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Πιστωτικό Όριο</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email2" placeholder=""
                                            v-model="result.limit">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-6 pull-right">
                                    <button type="reset" class="btn red" @click="deactivateSingleCustomer(result)"
                                        v-if="result.active == 1">Απενεργοποίηση</button>
                                    <button type="reset" class="btn red" @click="deactivateSingleCustomer(result)"
                                        v-if="result.active == 0">Ενεργοποίηση</button>
                                    <button type="button" class="btn green"
                                        @click="saveSingleCustomer(result)">Αποθήκευση</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
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
                    <span class="caption-subject bold uppercase font-dark">Ποσά</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-6">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="form_sample_1">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please
                                check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful!
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Παραγγελίες
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="name"
                                        :value="stats[0] ? stats[0].funds_count.count : 0" disabled>
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter your full name</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Ημερήσιες Παραγγελίες
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="email"
                                        :value="checkIfnull(stats[0].funds_daily_count)" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Εβδομαδιαίες Παραγγελίες
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="url"
                                        :value="checkIfnull(stats[0].funds_weekly_count)" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Μηνιαίες Παραγγελίες
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="number"
                                        :value="checkIfnull(stats[0].funds_monthly_count)" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Ετήσιες Παραγγελίες
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Enter digits" name="digits"
                                            :value="checkIfnull(stats[0].funds_year_count)" disabled>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Υπόλοιπο Πελάτη
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon right">
                                        <input type="text" class="form-control" name="creditcard"
                                            placeholder="Enter your card" :value="stats[0].balance.balance + '€'"
                                            disabled>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="form_sample_1">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please
                                check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful!
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Ποσό
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="name"
                                        :value="checkIfnullPrice(stats[0].funds_count) + '€'">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter your full name</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Ημερήσιο Ποσό
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="email"
                                        :value="checkIfnullPrice(stats[0].funds_daily_count) + '€'" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Εβδομαδιαίο Ποσό
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="url"
                                        :value="checkIfnullPrice(stats[0].funds_weekly_count) + '€'" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Μηνιαίο Ποσό
                                </label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="" name="number"
                                        :value="checkIfnullPrice(stats[0].funds_monthly_count) + '€'" disabled>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Ετήσιο Ποσό
                                </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Enter digits" name="digits"
                                            :value="checkIfnullPrice(stats[0].funds_year_count) + '€'" disabled>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
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
                            <button class="btn default date-reset" type="button" style="padding: 15px;"
                                @click="findRangedCustomer(result.id)">
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
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Ταμεια πελατη</span>
                </div>
            </div>
            <div class="portlet-body">
                <incomes :isfromquery="true" :isranged="true" :serverdata="funds" :iscustomer="true"></incomes>
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
                <chartjs-bar :data="[summaries[0] , summaries[1] , stats[0].balance.balance]" :bind="true"
                    :datalabel="'Παραγγελίες, Έσοδα, Έξοδα'" :backgroundcolor="['#3a4656','#000','#E73D4A']"
                    :labels="['Παραγγελίες', 'Έσοδα', 'Υπόλοιπο']"></chartjs-bar>
            </div>
        </div>
    </div>
</div>
@endsection