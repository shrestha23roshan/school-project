<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Repositories\AlbumPhoto\AlbumPhotoRepository;
use Modules\Media\Repositories\Album\AlbumRepository;
use Session;

class AlbumPhotoController extends Controller
{
    private $photo;

    private $album;

    public function __construct( AlbumPhotoRepository $photo, AlbumRepository $album)
    {
        $this->photo = $photo;
        $this->album = $album;
        $this->destinationpath = 'uploads/media/album/photos/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id)
    {
        return view('media::AlbumPhoto.index')
        ->withPhotos($this->photo->findByAlbumId($id))
        ->withAlbum($this->album->find($id));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        return view('media::AlbumPhoto.create')
        ->withAlbum($this->album->find($id));

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, $id)
    {
        $photos = $request->file('file');
        if($photos) {
            $albumPhoto = null;
            foreach($photos as $photo){
                /** separate extension, move to directory and store name in database  */
                $extension = strrchr($photo->getClientOriginalName(), '.');
                $new_file_name = "album-photo_" . sha1(date('YmdHis') . str_random(30));;
                $attachment = $photo->move($this->destinationpath, $new_file_name.$extension);
                $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;

                /** work id */
                $data['album_id'] = $id;

                /** New work photo is created here */
                $albumPhoto = $this->photo->create($data);
            }

            if($albumPhoto){
                Session::flash('success_message', 'Photo is added successfully.');
                return response()->json([
                    'type' => 'success',
                    'message' => 'Photo is added successfully.',
                ], 200);
            }

            Session::flash('error_message', 'Photo can not added, please try again later.');
            return response()->json([
                'type' => 'error',
                'message' => 'Photo can not added, please try again later.'
            ], 200);
        }

        Session::flash('error_message', 'Photo can not added, please try again later.');
        return response()->json([
            'type' => 'error',
            'message' => 'Photo can not added, please try again later.'
        ], 200);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        // return view('media::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $photo = $this->photo->find($id);
        $previousAttachment = $photo->attachment;

        $flag = $this->photo->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Photo is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Photo can not be deleted.',
        ], 422);
    }
}
