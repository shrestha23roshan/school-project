<?php

namespace Modules\Seo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Seo\Repositories\Seo\SeoRepository;
use Modules\Seo\Http\Requests\Seo\StoreRequest;
use Modules\Seo\Http\Requests\Seo\UpdateRequest;

class SeoController extends Controller
{
    private $seo;

    public function __construct(SeoRepository $seo)
    {
        $this->seo = $seo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('seo::Seo.index')
        ->withSeos($this->seo->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // return view('seo::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $seo = $this->seo->create($data);

        if($seo){
            return redirect()->route('admin.seo.index')
                ->withSuccessMessage('Seo is added successfully.');
        }
        return redirect()->back()->withInput()
            ->withWarningMessage('Seo can not be added.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('seo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('seo::Seo.edit')
        ->withSeo($this->seo->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $seo = $this->seo->update($id, $data);

        if($seo){
            return redirect()->route('admin.seo.index')
                ->withSuccessMessage('Seo is updated successfully.');
        }
        return redirect()->back()->withInput()
            ->withWarningMessage('Seo can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
