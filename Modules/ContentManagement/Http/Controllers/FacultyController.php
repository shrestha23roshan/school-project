<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\ContentManagement\Repositories\Faculty\FacultyRepository;
use Modules\ContentManagement\Http\Requests\Faculty\StoreRequest;
use Modules\ContentManagement\Http\Requests\Faculty\UpdateRequest;

class FacultyController extends Controller
{
    private $faculty;

    public function __construct(FacultyRepository $faculty)
    {
        $this->faculty = $faculty;
        $this->destinationpath = 'uploads/content-management/faculty/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::Faculty.index')
        ->withFaculty($this->faculty->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::Faculty.create');
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
            $new_file_name = "faculty_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $faculty = $this->faculty->create($data);

        if($faculty){
            return redirect()->route('admin.content-management.faculty.index')
                        ->withSuccessMessage('Faculty is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Faculty can not be added.');
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
        return view('contentmanagement::Faculty.edit')
        ->withFaculty($this->faculty->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $faculty = $this->faculty->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $faculty->attachment) &&  $faculty->attachment != '') {
                unlink($this->destinationpath . $faculty->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "faculty_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $faculty = $this->faculty->update($id, $data);

        if($faculty){
            return redirect()->route('admin.content-management.faculty.index')
                        ->withSuccessMessage('Faculty is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Faculty can not be update.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $faculty = $this->faculty->find($id);
        $previousAttachment = $faculty->attachment;

        $flag = $this->faculty->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Faculty is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Faculty can not be deleted.',
        ], 422);
    }
}
