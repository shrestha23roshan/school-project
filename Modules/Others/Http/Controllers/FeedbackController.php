<?php

namespace Modules\Others\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Others\Repositories\Feedback\FeedbackRepository;

class FeedbackController extends Controller
{
    private $feedback;

    public function __construct(FeedbackRepository $feedback)
    {
        $this->feedback = $feedback;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('others::Feedback.index')
        ->withFeedbacks($this->feedback->all());
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        return view('others::Feedback.show')
        ->withFeedback($this->feedback->find($id));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->feedback->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'Feedback is deleted successfully.',
                ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Feedback can not deleted.',
        ], 422);
    }
}
