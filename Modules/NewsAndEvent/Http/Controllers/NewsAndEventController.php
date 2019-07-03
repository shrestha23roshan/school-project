<?php

namespace Modules\NewsAndEvent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\NewsAndEvent\Repositories\NewsAndEvent\NewsAndEventRepository;
use Modules\NewsAndEvent\Http\Requests\StoreRequest;
use Modules\NewsAndEvent\Http\Requests\UpdateRequest;

class NewsAndEventController extends Controller
{
    private $newsandevent;

    public function __construct(NewsAndEventRepository $newsandevent)
    {
        $this->newsandevent = $newsandevent;
        $this->destinationpath = 'uploads/newsandevent/';
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('newsandevent::NewsAndEvent.index')
        ->withNewsandevents($this->newsandevent->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('newsandevent::NewsAndEvent.create');
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
            $new_file_name = "newsandevent_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $newsandevent = $this->newsandevent->create($data);

        if($newsandevent){
            return redirect()->route('admin.newsandevent.index')
                        ->withSuccessMessage('NewsAndEvent is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('NewsAndEvent can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('newsandevent::NewsAndEvent.edit')
        ->withNewsandevent($this->newsandevent->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $newsandevent = $this->newsandevent->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $newsandevent->attachment) &&  $newsandevent->attachment != '') {
                unlink($this->destinationpath . $newsandevent->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "newsandevent_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $newsandevent = $this->newsandevent->update($id, $data);

        if($newsandevent){
            return redirect()->route('admin.newsandevent.index')
                        ->withSuccessMessage('NewsAndEvent is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('NewsAndEvent can not be update.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $newsandevent = $this->newsandevent->find($id);
        $previousAttachment = $newsandevent->attachment;

        $flag = $this->newsandevent->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'NewsAndEvent is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'NewsAndEvent can not be deleted.',
        ], 422);
    }
}
