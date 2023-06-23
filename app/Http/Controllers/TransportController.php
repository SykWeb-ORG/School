<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transports = Transport::all();
        return response()->json(
            [
                'transports' => $transports,
            ]
        );
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
        $transport = new Transport($request->except([
            'driver',
        ]));
        $result = null;
        $status = null;
        $msg = null;
        $request->whenFilled('driver', function ($input) use ($transport, &$result, &$status, &$msg) {
            $driver = Driver::find($input);
            if ($driver) {
                if ($driver->transports()->save($transport)) {
                    $result = $transport;
                    $status = 200;
                    $msg = __('success');
                } else {
                    $result = null;
                    $status = 500;
                    $msg = __('failure');
                }
            } else {
                $result = null;
                $status = 404;
                $msg = __('not found');
            }
        }, function () use ($transport, &$result, &$status, &$msg) {
            if ($transport->save()) {
                $result = $transport;
                $status = 200;
                $msg = __('success');
            } else {
                $result = null;
                $status = 500;
                $msg = __('failure');
            }
        });
        return response()->json(
            [
                'result' => $result,
                'status' => $status,
                'msg' => $msg,
            ],
            $status
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        $result = null;
        $status = null;
        $msg = null;
        if ($transport->update($request->except([
            'driver',
        ]))) {
            $result = $transport;
            $status = 200;
            $msg = __('success');
        } else {
            $result = null;
            $status = 500;
            $msg = __('failure');
        }
        $request->whenFilled('driver', function ($input) use ($transport, &$result, &$status, &$msg) {
            $driver = Driver::find($input);
            if ($driver) {
                if ($driver->transports()->save($transport)) {
                    $result = $transport;
                    $status = 200;
                    $msg = __('success');
                } else {
                    $result = null;
                    $status = 500;
                    $msg = __('failure');
                }
            } else {
                $result = null;
                $status = 404;
                $msg = __('not found');
            }
        }, function () use ($transport, &$result, &$status, &$msg) {
            $transport->driver()->dissociate();
            if ($transport->save()) {
                $result = $transport;
                $status = 200;
                $msg = __('success');
            } else {
                $result = null;
                $status = 500;
                $msg = __('failure');
            }
        });
        $transport->refresh();
        return response()->json(
            [
                'result' => $result,
                'status' => $status,
                'msg' => $msg,
            ],
            $status
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        if ($transport->delete()) {
            $result = $transport;
            $status = 200;
            $msg = __('success');
        } else {
            $result = null;
            $status = 500;
            $msg = __('failure');
        }
        return response()->json(
            [
                'result' => $result,
                'status' => $status,
                'msg' => $msg,
            ],
            $status
        );
    }
}
