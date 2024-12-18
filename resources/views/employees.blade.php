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
                        <span class="caption-subject bold uppercase font-dark">Λίστα Υπαλλήλων</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12">
                        <employees></employees>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
