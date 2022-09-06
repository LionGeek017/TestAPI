<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function getProducer(Request $request)
    {
        $p = 20;
        $sort = ($request->sort == 'asc' || $request->sort == 'desc') ? $request->sort : 'asc'; // asc or desc

        $producers = Producer::select('name');

        if(!$request->has('is_active') || $request->is_active == 'active')
        {
            $producers->active();
        }

        if($request->has('is_active') && $request->is_active == 'not_active')
        {
            $producers->notActive();
        }

        $producers = $producers->orderBy('name', $sort)->paginate($p);

        return response()->json($producers, 200);
    }
}
