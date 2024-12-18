@extends('layouts.app')

@section('page-title')
    Υπάλληλοι
@endsection

@section('breadcrumb')
    Υπάλληλοι
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Προσθήκη Νέου Υπαλλήλου</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-6">
                        <!-- BEGIN FORM-->
                        <form action="#" class="form-horizontal" id="form_sample_1">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Κωδικός
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="name" v-model="employee.id" disabled>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter your full name</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Επώνυμο
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="email" v-model="employee.surname">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Τηλέφ. 2
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="url" v-model="employee.telephone2">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Email
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="number" v-model="employee.email">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">AMKA
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="" name="digits" v-model="employee.amka">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Θέση Υπαλλήλου
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" name="creditcard" placeholder="" v-model="employee.position">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Ημερομηνία Αποχώρησης</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            </span>
                                            <input id="firing-date" type="text" class="form-control" name="email2" placeholder="" v-model="employee.firing_date">
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
                                            <input type="checkbox" name="checkboxes1[]" value="1" id="checkbox1_1" class="md-check" v-model="employee.active">
                                            <label for="checkbox1_1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span></label>
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
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Όνομα
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="name" v-model="employee.name">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter your full name</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Τηλέφ. 1
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="email" v-model="employee.telephone">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Διεύθυνση
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="url" v-model="employee.address">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">ΑΦΜ
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="number" v-model="employee.afm">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Αριθμός Λογαριασμού
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" name="digits" v-model="employee.bank_account">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Ημερομηνία Πρόσληψης
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon right">
                                            <input id="hiring-date" type="email2" class="form-control" name="creditcard" placeholder="" v-model="employee.hiring_date">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Μισθός
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon right">
                                            <input id="hiring-date" type="email2" class="form-control" name="creditcard" placeholder="" v-model="employee.salary">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Ημέρες Αδείας
                                    </label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                            <input id="hiring-date" type="number" class="form-control" name="creditcard" placeholder="" v-model="employee.absent_days">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <label class="col-md-2 control-label" for="form_control_1">Ποσοστό
                                    </label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                            <input id="hiring-date" type="number" class="form-control" name="creditcard" placeholder="" v-model="employee.percentage">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6 pull-right">
                                        <button type="button" class="btn green" @click="saveNewEmployee(employee)">Αποθήκευση</button>
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
                        <span class="caption-subject bold uppercase font-dark">ΛΙΣΤΑ ΑΔΕΙΩΝ</span>
                    </div>
                    <div class="actions">
                        <a style="font-size: 25px;" @click="newAllowanceModal(employee)">
                            <i class="icon-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <!-- BEGIN FORM-->
                        <allowance :employee="employee" ref="allowance"></allowance>
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
                        <span class="caption-subject bold uppercase font-dark">ΛΙΣΤΑ ΠΛΗΡΩΜΩΝ</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <!-- BEGIN FORM-->
                        <payrollsingle :employee="employee"></payrollsingle>
                        <!-- END FORM-->
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                                <strong>Σύνολο Ποσών: @{{countPayroll}}€</strong>
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
