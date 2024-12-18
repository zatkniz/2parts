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
                    <div class="col-md-12">
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
                                    <label class="col-md-2 control-label" for="form_control_1">Username
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="email" v-model="employee.username">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Email
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" name="url" v-model="employee.email">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Ρόλος
                                    </label>
                                    <div class="col-md-10">
                                        <select v-model="employee.role" class="form-control" id="sel1">
                                            <option value=""></option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Editor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Κωδικός
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <input type="password" class="form-control" name="digits" v-model="employee.password">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6 pull-right">
                                        <button type="button" class="btn green" @click="updateUser(employee)">Αποθήκευση</button>
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
@endsection
