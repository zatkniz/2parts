@extends('layouts.app')

@section('page-title')
    Ταμείο Ημέρας
@endsection

@section('breadcrumb')
    Ταμείο Ημέρας
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Κωδικος Παραγγελιας: {{isset($result->fund_code) ? $result->fund_code : 'Δεν υπάρχει ταμείο με τον συγκεκριμένο κωδικό'}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <incomes :single="true"></incomes>
                </div>
            </div>
        </div>
    </div>
@endsection
