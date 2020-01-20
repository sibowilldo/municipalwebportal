<?php

namespace App\Http\Controllers\Api;

use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications;
        return response()->json(['notifications' => $notifications]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Auth::user()->notifications->where('id', $id)->first();
        $notification?$notification->markAsRead():abort(404, 'Notification not found!');//Mark notification as read
        return response()->json([$notification->data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
