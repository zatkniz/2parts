<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasAnyPayedSubscriptions = Subscription::whereCompanyId($request->id)->where('subscription_type_id' , 2)->count();
        $months = $hasAnyPayedSubscriptions > 0 ? 12 : 15;
        $subscription = new Subscription;
        $subscription->company_id = $request->id;
        $subscription->active = true;
        $subscription->subscription_type_id = $request->showPdf ? 1 : 2;
        $subscription->start_date = Carbon::now();
        $subscription->end_date = $request->showPdf ? null : Carbon::now()->addMonth($months);
        $subscription->save();

        return $subscription;
    }

    public function updateSubscription(Request $request)
    {
        $hasAnyPayedSubscriptions = Subscription::whereCompanyId($request->id)->where('subscription_type_id' , 2)->count();
        $months = $hasAnyPayedSubscriptions > 0 ? 12 : 15;
        $subscription = new Subscription;
        $subscription->company_id = $request->id;
        $subscription->active = false;
        $subscription->subscription_type_id = $request->showPdf ? 1 : 2;
        $subscription->start_date = Carbon::now();
        $subscription->end_date = $request->showPdf ? null : Carbon::now()->addMonth($months);
        $subscription->save();

        return $subscription;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
