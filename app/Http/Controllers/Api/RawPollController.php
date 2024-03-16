<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRawPollRequest;
use App\Http\Resources\RawPollResource;
use App\Models\RawPoll;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class RawPollController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendSuccess("Raw Poll Collection",RawPollResource::collection(RawPoll::all()),StatusCodeEnum::OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRawPollRequest $request)
    {
        try {
            //code...
            $data = [
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'created_by' => auth()->user()->getAuthIdentifier()
            ];

            if($request->hasFile('img')) {
                $data['pole_img'] =$request->file('img')->store('polls', 'public');
            }
            
            RawPoll::create($data);

            return $this->sendSuccess('utility resource create successfully',[],StatusCodeEnum::OK);

        } catch (\Exception $e) {

            return $this->sendError('error', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RawPoll $raw_poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawPoll $raw_poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RawPoll $raw_poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawPoll $raw_poll)
    {
        //
    }
}
