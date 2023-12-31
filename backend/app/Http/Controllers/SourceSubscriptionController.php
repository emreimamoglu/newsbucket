<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSourceSubscriptionRequest;
use App\Http\Requests\UpdateSourceSubscriptionRequest;
use App\Models\SourceSubscription;
use App\Traits\HttpResponses;

class SourceSubscriptionController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(SourceSubscription::all()->where('user_id', auth()->user()->id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSourceSubscriptionRequest $request)
    {
        \Log::info('User subscribing to source: ' . $request->source_id . ' for user: ' . $request->user_id);

        $request->validated($request->all());
        $sourceSubscription = SourceSubscription::create($request->all());
        return $this->success($sourceSubscription, 'Successfully subscribed to source');
    }

    /**
     * Display the specified resource.
     */
    public function show(SourceSubscription $sourceSubscription)
    {
        return $this->success($sourceSubscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSourceSubscriptionRequest $request, SourceSubscription $sourceSubscription)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SourceSubscription $sourceSubscription)
    {
        \Log::info('User unsubscribing from source: ' . $sourceSubscription->id . ' for user: ' . $sourceSubscription->user_id);
        $sourceSubscription->delete();
        return $this->success(null, 'Successfully unsubscribed from source');
    }
}
