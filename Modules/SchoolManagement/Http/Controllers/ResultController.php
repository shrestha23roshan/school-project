<?php

namespace Modules\SchoolManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SchoolManagement\Repositories\Result\ResultRepository;
use Modules\SchoolManagement\Http\Requests\Result\StoreRequest;
use Modules\SchoolManagement\Http\Requests\Result\UpdateRequest;
//  use DB;
// use File;
use Session;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\SchoolManagement\Http\Requests\Result\ImportStoreRequest;

class ResultController extends Controller
{
    private $result;

    public function __construct(ResultRepository $result)
    {
        $this->result = $result;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('schoolmanagement::Result.index')
        ->withResults($this->result->all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('schoolmanagement::Result.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only('full_name','registration_no','class','remark','is_active');

        $result = $this->result->create($data);
        if($result){
            return redirect()->route('admin.school-management.result.index')
                            ->withSuccessMessage('Result is Created successfully');
        }
            return redirect()->back()
                    ->withInput()
                    ->withWarningMessage('Result can not be created.');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('schoolmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return view('schoolmanagement::Result.edit')
        ->withResult($this->result->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->only('full_name','registration_no','class','remark','is_active');
        $result = $this->result->find($id);

        $result = $this->result->update($id, $data);
        if($result){
            return redirect()->route('admin.school-management.result.index')
                            ->withSuccessMessage('Result is updated successfully');
        }
            return redirect()->back()
                    ->withInput()
                    ->withWarningMessage('Result can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $flag = $this->result->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'result is successfully deleted.',
                ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'result can not deleted.',
        ], 422);
    }

    public function deleteAll()
    {   $result = $this->result->all();
        if($result->isEmpty()){
            return redirect()->back()->withWarningMessage('There are no data to delete.');
        }
        $result = $this->result->truncate();
        if($result){
            return redirect()->route('admin.school-management.result.index')
                            ->withSuccessMessage('All data deleted successfully.');
        }
            return redirect()->back()->withWarningMessage('Data can not be deleted.');
        
    }

    public function publishResult()
    {
        $result = DB::table('results')->update(array('is_active' => '1'));
        if($result){
            return redirect()->route('admin.school-management.result.index')
                            ->withSuccessMessage('Result published successfully.');
        }
            return redirect()->back()->withWarningMessage('Result can not be published');
    }

    public function unpublishResult()
    {
        $result = DB::table('results')->update(array('is_active' => '0'));
        if($result){
            return redirect()->route('admin.school-management.result.index')
                            ->withSuccessMessage('Result unpublished successfully.');
        }
            return redirect()->back()->withWarningMessage('Result can not be unpublished');
    }

    public function getImport()
    {
        return view('schoolmanagement::Result.import');
    }

    public function postImport(ImportStoreRequest $request){
       
        if($request->hasFile('file')){

            $extension = File::extension($request->file->getClientOriginalName());
            
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
     
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {})->toArray();
                if(!empty($data) && count($data) > 0){
                    
                   if(!$this->checkKeysInArray($data)) {
                        return redirect()->back()
                            ->withWarningMessage('File is not in right format, please check.');
                   }
                   
                    foreach ($data as $key => $value) {
                        $insert[] = ['registration_no' => $value['registration_no'], 'full_name' => $value['full_name'], 'class' => $value['class'], 'remark' => $value['remark']];
                    }
     
                    if(!empty($insert)){
     
                        $insertData = DB::table('results')->insert($insert);
                        if ($insertData) {
                            return redirect()->route('admin.school-management.result.index')->withSuccessMessage('Your Data has successfully imported');
                        }else { 
                            return redirect()->route('admin.school-management.result.index')->withWarningMessage('Error inserting the data..');
                        }
                    }
                }
     
     
            }else {
                return redirect()->back()->withWarningMessage('File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
            }
        }
    }

    /**
     * Check keys in array 
     * Created at:Thursday, January 10, 2019
     * Updated at:Thursday, January 10, 2019
     * 
     * @param array $arr 
     * @return boolean
     */
    private function checkKeysInArray($arr)
    {
        foreach ($arr as $key => $item) {
            if(array_key_exists('registration_no', $item) && array_key_exists('full_name', $item)
                && array_key_exists('class', $item) && array_key_exists('remark', $item)) {
                return true;
            }

            return false;
        }
    }
}
