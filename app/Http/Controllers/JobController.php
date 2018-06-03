<?php

namespace App\Http\Controllers;

use App\Jobs\CalcJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JobController extends Controller
{

    public function pub(Request $req)
    {
        $a = $req->input('a');
        $b = $req->input('b');

        $delay = $req->input('delay',false);
        $queue = $req->input('queue','default');

        $job = new CalcJob($a, $b);
        $job->onQueue($queue);
        if ($delay) {
            $seconds = rand(10,30);
            $job->delay(Carbon::now()->addSeconds($seconds));
            $result = $this->dispatch($job);
        } else {
            $seconds = 0;
            $result = $this->dispatch($job);
        }

        if ($result) {
            return response()->json(['id'=>$result,'delay'=>$seconds,'now'=>Carbon::now()],200);
        } else {
            return response()->json([],500);
        }
    }
}
