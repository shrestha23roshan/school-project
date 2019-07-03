<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Repositories\Notice\NoticeRepository;
use Modules\ContentManagement\Http\Requests\Notice\StoreRequest;
use Modules\ContentManagement\Http\Requests\Notice\UpdateRequest;

class NoticeController extends Controller
{
    private $notice;

    public function __construct(NoticeRepository $notice)
    {
        $this->notice = $notice;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::Notice.index')
        ->withNotices($this->notice->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::Notice.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        $notice = $this->notice->create($data);
        if($notice){
            return redirect()->route('admin.content-management.notice.index')
                ->withSuccessMessage('Notice is added successfully.');
        }
            return redirect()->back()->withInput()
                ->withWarningMessage('Notice can not be added.');
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
        return view('contentmanagement::Notice.edit')
        ->withNotice($this->notice->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();

        $notice = $this->notice->update($id, $data);
        if($notice){
            return redirect()->route('admin.content-management.notice.index')
                        ->withSuccessMessage('Notice is updated successfully.');
        }

        return redirect()->back()
                ->withInput()
                ->withWarningMessage('Notice can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->notice->destroy($id);
        if($flag){
            return response()->json([
                'type' => 'success',
                'message' => 'Notice is successfully deleted.',
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Notice can not deleted.',
        ], 422);
    }
}
