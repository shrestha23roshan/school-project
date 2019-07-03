<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Repositories\AboutUs\AboutUsRepository;
use Modules\ContentManagement\Http\Requests\AboutUs\StoreRequest;
use Modules\ContentManagement\Http\Requests\AboutUs\UpdateRequest;

class AboutUsController extends Controller
{
    private $aboutus;

    public function __construct(AboutUsRepository $aboutus)
    {
        $this->aboutus = $aboutus;
        $this->destinationpath = 'uploads/content-management/aboutus/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::AboutUs.index')
        ->withAboutUs($this->aboutus->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::AboutUs.create');
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
            $new_file_name = "aboutus_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $aboutus = $this->aboutus->create($data);

        if($aboutus){
            return redirect()->route('admin.content-management.aboutus.index')
                        ->withSuccessMessage('AboutUs is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('AboutUs can not be added.');
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
        return view('contentmanagement::AboutUs.edit')
        ->withAboutUs($this->aboutus->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
         $data = $request->except('attachment');
        $aboutus = $this->aboutus->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $aboutus->attachment) &&  $aboutus->attachment != '') {
                unlink($this->destinationpath . $aboutus->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "aboutus_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $aboutus = $this->aboutus->update($id, $data);

        if($aboutus){
            return redirect()->route('admin.content-management.aboutus.index')
                        ->withSuccessMessage('AboutUs is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('AboutUs can not be update.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $aboutus = $this->aboutus->find($id);
        $previousAttachment = $aboutus->attachment;

        $flag = $this->aboutus->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'AboutUs is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'AboutUs can not be deleted.',
        ], 422);
    }
}
