<?php

namespace App\Http\Controllers;

use App\Events\OrderShippedEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function fireOrderShipEvent(Request $req) {
        $orderId = $req->input('order_id');
        $result = event(new OrderShippedEvent($orderId));
        return response()->json(['result'=>$result]);
    }
}
