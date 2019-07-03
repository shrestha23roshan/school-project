<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Repositories\Download\DownloadRepository;
use Modules\ContentManagement\Http\Requests\Download\StoreRequest;
use Modules\ContentManagement\Http\Requests\Download\UpdateRequest;

class DownloadController extends Controller
{
    private $download;

    public function __construct(DownloadRepository $download)
    {
        $this->download = $download;
        $this->destinationpath = 'uploads/content-management/download/';
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::Download.index')
        ->withDownloads($this->download->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::Download.create');
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
            $new_file_name = "download_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $download = $this->download->create($data);

        if($download){
            return redirect()->route('admin.content-management.download.index')
                        ->withSuccessMessage('Download is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Download can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('contentmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('contentmanagement::Download.edit')
        ->withDownload($this->download->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $download = $this->download->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $download->attachment) &&  $download->attachment != '') {
                unlink($this->destinationpath . $download->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "download_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $download = $this->download->update($id, $data);

        if($download){
            return redirect()->route('admin.content-management.download.index')
                        ->withSuccessMessage('Download is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Download can not be update.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $download = $this->download->find($id);
        $previousAttachment = $download->attachment;

        $flag = $this->download->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Download is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Download can not be deleted.',
        ], 422);
    }
}
