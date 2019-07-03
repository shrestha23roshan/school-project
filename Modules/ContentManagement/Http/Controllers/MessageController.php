<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Repositories\Message\MessageRepository;
use Modules\ContentManagement\Http\Requests\Message\StoreRequest;
use Modules\ContentManagement\Http\Requests\Message\UpdateRequest;

class MessageController extends Controller
{
    private $message;

    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
        $this->destinationpath = 'uploads/content-management/message/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::Message.index')
        ->withMessages($this->message->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::Message.create');
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
            $new_file_name = "message_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $message = $this->message->create($data);

        if($message){
            return redirect()->route('admin.content-management.message.index')
                        ->withSuccessMessage('Message is added successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Message can not be added.');

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
        return view('contentmanagement::Message.edit')
        ->withMessage($this->message->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment');
        $message = $this->message->find($id);

        $imageFile = $request->attachment;
        if($imageFile) {
            if (file_exists($this->destinationpath . $message->attachment) &&  $message->attachment != '') {
                unlink($this->destinationpath . $message->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "message_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name.$extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }
        $message = $this->message->update($id, $data);

        if($message){
            return redirect()->route('admin.content-management.message.index')
                        ->withSuccessMessage('Message is update successfully.');
        }
    
        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Message can not be update.');

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->message->find($id);
        $previousAttachment = $message->attachment;

        $flag = $this->message->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'message is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'message can not be deleted.',
        ], 422);
    }
}
