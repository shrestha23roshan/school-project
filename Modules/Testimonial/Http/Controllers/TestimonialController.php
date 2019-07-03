<?php

namespace Modules\Testimonial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Testimonial\Http\Requests\StoreRequest;
use Modules\Testimonial\Repositories\Testimonial\TestimonialRepository;
use Modules\Testimonial\Http\Requests\UpdateRequest;

class TestimonialController extends Controller
{
    private $testimonial;

    public function __construct(TestimonialRepository $testimonial)
    {
        $this->testimonial = $testimonial;
        $this->destinationpath = 'uploads/testimonial/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('testimonial::Testimonial.index')
        ->withTestimonials($this->testimonial->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('testimonial::Testimonial.create');
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
            $new_file_name = "testimonial_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $testimonial = $this->testimonial->create($data);

        if($testimonial){
            return redirect()->route('admin.testimonial.index')
                        ->withSuccessMessage('Testimonial is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Testimonial can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('testimonial::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('testimonial::Testimonial.edit')
        ->withTestimonial($this->testimonial->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $testimonial = $this->testimonial->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $testimonial->attachment) &&  $testimonial->attachment != '') {
                unlink($this->destinationpath . $testimonial->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "testimonial_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $testimonial = $this->testimonial->update($id, $data);

        if($testimonial){
            return redirect()->route('admin.testimonial.index')
                        ->withSuccessMessage('Testimonial is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Testimonial can not be update.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $testimonial = $this->testimonial->find($id);
        $previousAttachment = $testimonial->attachment;

        $flag = $this->testimonial->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Testimonial is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Testimonial can not be deleted.',
        ], 422);
    }
}
