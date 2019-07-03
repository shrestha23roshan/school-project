<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Repositories\Album\AlbumRepository;
use Modules\Media\Http\Requests\Album\StoreRequest;
use Modules\Media\Http\Requests\Album\UpdateRequest;
use Modules\Media\Repositories\AlbumPhoto\AlbumPhotoRepository;

class AlbumController extends Controller
{
    private $album;
    private $photo;

    public function __construct(AlbumRepository $album, AlbumPhotoRepository $photo)
    {
        $this->album = $album;
        $this->photo = $photo;
        $this->destinationpath = 'uploads/media/album/';
        $this->photodestinationpath = 'uploads/media/album/photos/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('media::Album.index')
        ->withAlbums($this->album->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('media::Album.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('attachment');

        $imageFile = $request->attachment;
        if($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "album_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : null;
        }

        $album = $this->album->create($data);

        if($album){
            return redirect()->route('admin.media.album.index')
                        ->withSuccessMessage('Album is added successfully.');
        }

        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Album can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('media::Album.edit')
        ->withAlbum($this->album->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $album = $this->album->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if(file_exists($this->destinationpath . $album->attachment) &&  $album->attachment != '') {
                unlink($this->destinationpath . $album->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "album_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : null;
        }

        $album = $this->album->update($id, $data);

        if($album){
            return redirect()->route('admin.media.album.index')
                        ->withSuccessMessage('Album is updated successfully.');
        }

        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Album can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $album = $this->album->find($id);
        $previousAttachment = $album->attachment;

        $albumPhotos = $this->photo->findByAlbumId($id); // album photos retrieved to delete

        $flag = $this->album->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            foreach ($albumPhotos as $key => $photo) {
                if (file_exists($this->photodestinationpath . $photo->attachment) && $photo->attachment != '') {
                    unlink($this->photodestinationpath . $photo->attachment);
                }
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Album is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Album can not be deleted.',
        ], 422);
    }
}
