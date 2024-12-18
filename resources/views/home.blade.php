@extends('layouts.app')

@section('page-title')
    Αρχική
@endsection

@section('breadcrumb')
    Καλημέρα {{Auth::user()->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800">{{$fund}}</span>
                        </h3>
                        <small>ΣΥΝΟΛΟ φετινων ΠΑΡΑΓΓΕΛΙΩΝ</small>
                    </div>
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800">{{$fundMonth}}</span>
                        </h3>
                        <small>ΣΥΝΟΛΟ μηνιαων ΠΑΡΑΓΓΕΛΙΩΝ</small>
                    </div>
                    <div class="icon">
                        <i class="icon-pie-chart"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-red-haze">
                            <span data-counter="counterup" data-value="1349">{{$fundPrice}}</span>
                            <small class="font-green-sharp">€</small>
                        </h3>
                        <small>φΕΤΙΝΟΣ ΤΖΙΡΟΣ<br/></small>
                    </div>
                    <div class="number">
                        <h3 class="font-red-haze">
                        <h3 class="font-red-haze">
                            <span data-counter="counterup" data-value="1349">{{$fundPriceMonth}}</span>
                            <small class="font-green-sharp">€</small>
                        </h3>
                        <small>ΜΗΝΙΑΙΟΣ ΤΖΙΡΟΣ<br/></small>
                    </div>
                    <div class="icon">
                        <i class="icon-like"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-blue-sharp">
                            <span data-counter="counterup" data-value="567">{{$balance}}</span>
                            <small class="font-green-sharp">€</small>
                        </h3>
                        <small>Υπολοιπα πελατων</small>
                    </div>
                    <div class="icon">
                        <i class="icon-basket"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-purple-soft">
                            <span data-counter="counterup" data-value="276">{{$outfund}}</span>
                            <small class="font-green-sharp">€</small>
                        </h3>
                        <small>σΥΝΟΛΟ ΕΞΟΔΩΝ</small>
                    </div>
                    <div class="number">
                        <h3 class="font-purple-soft">
                            <span data-counter="counterup" data-value="276">{{$outfundMonth}}</span>
                            <small class="font-green-sharp">€</small>
                        </h3>
                        <small>σΥΝΟΛΟ μηνιαιων ΕΞΟΔΩΝ</small>
                    </div>
                    <div class="icon">
                        <i class="icon-user"></i>
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
                        <span class="caption-subject bold uppercase font-dark">ΤOP 20 ΠΕΛΑΤΕΣ</span>
                        <span class="caption-helper">με μεγαλύτερο τζίρο</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Όνομα </th>
                                <th> Αρ.Παραγγελιών </th>
                                <th> Ποσό </th>
                                <th> Υπόλοιπο </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topCustomers as $user)
                            <tr>
                                <td> {{$loop->index + 1}} </td>    
                                <td> <a href="http://administration.2-parts.gr/single-customer/{{$user->customer->id}}">{{$user->customer->name}}</a> </td>
                                <td> {{ $user->count }} </td>
                                <td> {{ $user->price }}€ </td>
                                <td>
                                    {{$user->customer->balance->balance}}€
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">ΤΟΠ 20 ΕΞΟΔΑ</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Έξοδο </th>
                                <th> Ποσό </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topOutfunds as $outfund)
                            <tr>
                                <td> {{$loop->index + 1}} </td>    
                                <td> {{$outfund->outcome->name}}</td>
                                <td>{{$outfund->price}}€ </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
