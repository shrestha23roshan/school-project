<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Repositories\Page\PageRepository;
use Modules\ContentManagement\Http\Requests\Page\StoreRequest;
use Modules\ContentManagement\Http\Requests\Page\UpdateRequest;

class PageController extends Controller
{
    private $page;

    public function __construct(PageRepository $page)
    {
        $this->page = $page;
        $this->destinationpath = 'uploads/content-management/page/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contentmanagement::Page.index')
        ->withParentpages($this->page->where('parent_id', 0)->latest()->get())
        ->withChildpages($this->page->whereNotIn( 'parent_id', [0])->orderBy('order_position', 'asc')->get());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contentmanagement::Page.create')
        ->withParents($this->page->where('parent_id', 0)->get());

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('attachment','breadcrumb_attachment');

        $imageFile = $request->attachment;
        if ($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "page_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name . $extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }

        $breadcrumbFile = $request->breadcrumb_attachment;
        if($breadcrumbFile) {
            $extension = strrchr($breadcrumbFile->getClientOriginalName(), '.');
            $new_file_name = "breadcrumb_" . time();
            $attachment = $breadcrumbFile->move($this->destinationpath, $new_file_name.$extension);
            $data['breadcrumb_attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }

        $page = $this->page->create($data);

        if ($page) {
            return redirect()->route('admin.content-management.page.index')
                ->withSuccessMessage('Page is added successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Page can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('contentmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('contentmanagement::Page.edit')
        ->withPage($this->page->find($id))
        ->withParents($this->page->where('parent_id', 0)->get());
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('attachment','breadcrumb_attachment');
        $page = $this->page->find($id);

        $imageFile = $request->attachment;
        if ($imageFile) {
            if (file_exists($this->destinationpath . $page->attachment) && $page->attachment != '') {
                unlink($this->destinationpath . $page->attachment);
            }
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "page_" . time();
            $attachment = $imageFile->move($this->destinationpath, $new_file_name . $extension);
            $data['attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }

        $breadcrumbFile = $request->breadcrumb_attachment;
        if($breadcrumbFile) {
            if (file_exists($this->destinationpath . $page->breadcrumb_attachment) && $page->breadcrumb_attachment != '') {
                unlink($this->destinationpath . $page->breadcrumb_attachment);
            }
            $extension = strrchr($breadcrumbFile->getClientOriginalName(), '.');
            $new_file_name = "breadcrumb_" . time();
            $attachment = $breadcrumbFile->move($this->destinationpath, $new_file_name.$extension);
            $data['breadcrumb_attachment'] = isset($attachment) ? $new_file_name . $extension : NULL;
        }

        $page = $this->page->update($id, $data);

        if ($page) {
            return redirect()->route('admin.content-management.page.index')
                ->withSuccessMessage('Page is updated successfully');
        }

        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Page can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $page = $this->page->find($id);
        $previousAttachment = $page->attachment;
        $previousBreadcrumb_attachment = $page->breadcrumb_attachment;

        $flag = $this->page->destroy($id);
        if ($flag) {
            if (file_exists($this->destinationpath . $previousAttachment) && $previousAttachment != '') {
                unlink($this->destinationpath . $previousAttachment);
                unlink($this->destinationpath . $previousBreadcrumb_attachment);
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Page is deleted successfully.'
            ], 200);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Page can not be deleted.',
        ], 422);
    }
}
