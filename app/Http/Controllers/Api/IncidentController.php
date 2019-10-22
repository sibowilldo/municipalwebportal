<?php

namespace App\Http\Controllers\Api;

use Auth;
use File;
use EloquentBuilder;
use App\Attachment;
use App\Incident;
use App\Meta;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Incident as IncidentResource;
use Illuminate\Support\Facades\Storage;
use Image;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class IncidentController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\IncidentCollection
     */
    public function index(Request $request)
    {

        $incidents = EloquentBuilder::to(Incident::class, $request->all())->with('users')->get()->sortBy('created_at');

        if (!count($incidents)) {
            return response()->json(
                [
                    'data' => 'Nothing Found!',
                    'message' => 'OK'
                ],
                404
            );
        }
        return IncidentResource::collection($incidents);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Http\Resources\Incident
     */
    public function store(Request $request)
    {
        $user = User::whereUuid($request->user_id)->firstOrFail();
        $request->validate(
            [
                'name' => 'required|string',
                'description' => 'required|string',
                'location_description' => 'required|string',
                'latitude' => 'required',
                'longitude' => 'required',
                'suburb_id' => 'required',
                'is_public' => 'required',
            ]
        );

        $incident = new Incident([
                'reference' => Carbon::now()->timestamp, //ToDo: Auto-Generate
                'name' => app('profanityFilter')->filter($request->name),
                'description' => app('profanityFilter')->filter($request->description),
                'location_description' => $request->location_description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'suburb_id' => $request->suburb_id,
                'is_public' => $request->is_public,
                'type_id' => $request->type_id,
                'status_id' => $request->status_id
            ]);
        $incident->save();

        $has_attachments = false;
        if(count($request->images)){
            $has_attachments = true;
            //generate path based on user uuid and incident id
            $destinationPath = Auth::user()->uuid."/".$incident->id.'/';

            //Create the directory ToDo: Change this when we've moved to amazon s3
            Storage::makeDirectory('public/attachments/'.$destinationPath);
            $this->upload($request, $incident, $destinationPath);
        }

        $user->incidents()->attach(
            $incident,
            [
                'has_location' => true, 'has_attachment' => $has_attachments, 'source_id' => 0
            ]
        );

        return new IncidentResource($incident);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return IncidentResource
     */
    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        return new IncidentResource($incident);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return IncidentResource
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);

        return new IncidentResource($incident);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $incident = Incident::findOrFail($id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
        //
    }

    /**
     * Upload Incident Images and returns status code, image locations as array
     *
     * @param Request $request
     * @param Incident $incident
     * @param string $destinationPath
     */
    public function upload(Request $request, Incident $incident, $destinationPath)
    {
        //get images from request
        $images = $request->images;

        foreach($images as $image){
            //get image from json as base64
            $origimage = Image::make($image['data']);
            //generate random name, jpg because all images will be saved as jpg
            $imageName = time().str_random().".jpg";

            //resize the image if it's larger than 1920x1080 otherwise keep as is, set quality to about 75% and convert image to jpg
            $origimage->resize(1920, 1080, function($constr){
                $constr->aspectRatio();
                $constr->upsize();
            })->save(public_path('storage/attachments/'.$destinationPath).$imageName, 75, 'jpg');

            //Save & Get Metas (metadata)
            $meta = new Meta(['metadata' => $image['meta']]);
            $meta->save();

            //Save & GET Attachments (meta_id, path, filename, is_active)
            $attachment = new Attachment([
                'meta_id' => $meta->id,
                'path' => 'storage/attachments/'.$destinationPath,
                'filename' => $imageName,
                'is_active' => true
            ]);
            $attachment->save();

            //attach Attachment to Incident ([is_active])
            $incident->attachments()->attach($attachment, ['is_active' => true]);
        }
    }
}
