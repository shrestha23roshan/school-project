<?php

namespace Modules\SchoolManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SchoolManagement\Repositories\Alumni\AlumniRepository;

class AlumniController extends Controller
{
    private $alumni;

    public function __construct(AlumniRepository $alumni)
    {
        $this->alumni = $alumni;
        $this->destinationpath = 'uploads/school-management/alumni/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('schoolmanagement::Alumni.index')
        ->withAlumnis($this->alumni->all());
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        return view('schoolmanagement::Alumni.show')
        ->withAlumni($this->alumni->find($id));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->alumni->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'Alumni is successfully deleted.',
                ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Alumni can not deleted.',
        ], 422);
    }
}
