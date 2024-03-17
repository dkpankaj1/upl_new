<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRawPollRequest;
use App\Http\Resources\RawPollResource;
use App\Models\RawPoll;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Intervention\Image\Collection;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RawPollController extends Controller
{
    use HttpResponses;
    protected $imageManager;

    function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendSuccess("Raw Poll Collection", RawPollResource::collection(RawPoll::all()), StatusCodeEnum::OK);
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

            foreach ($request->file('img') as $file) {

                // $imageMeta = $this->imageManager->read($file)->setExif(new Collection(['Location'=> ['Latitude' => "80.124578","Longitude" => "81.031619"]]))->save();

                $imageMeta = $this->imageManager->read($file);

                $path = 'images/'.md5($file->hashName()). ".jpg";

                $data = [
                    'pole_img' => $path,
                    'latitude' => $imageMeta->exif('Location')['Latitude'] ?? "00.0000",
                    'longitude' => $imageMeta->exif('Location')['Longitude'] ?? "00.0000",
                    'created_by' => auth()->user()->getAuthIdentifier()
                ];

                $imageMeta->toJpeg()->save(public_path($path));

                RawPoll::create($data);
            }

            return $this->sendSuccess('utility resource create successfully', [], StatusCodeEnum::OK);

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
