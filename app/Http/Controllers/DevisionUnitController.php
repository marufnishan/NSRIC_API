<?php

namespace App\Http\Controllers;

use App\Models\DevisionUnit;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DevisionUnitMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DevisionUnitController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devisionunits = DevisionUnit::with('metafild')->get();
        return $this->sendResponse($devisionunits, 'Devision Units fetched.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'devision_id' => 'required',
            'title' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $devisionunits = DevisionUnit::create($input);
        if($request->meta_id){
            $metafild = new DevisionUnitMeta();
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        return $this->sendResponse($devisionunits, 'New devisionunits created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DevisionUnit  $devisionUnit
     * @return \Illuminate\Http\Response
     */
    public function show(DevisionUnit $devisionUnit)
    {
        $devision_unit_withmeta = DevisionUnit::with('metafild')->find($devisionUnit->id);
        if (is_null($devision_unit_withmeta)) {
            return $this->sendError('Devision Unit does not exist.');
        }
        return $this->sendResponse($devision_unit_withmeta, 'Devision units fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DevisionUnit  $devisionUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(DevisionUnit $devisionUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DevisionUnit  $devisionUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DevisionUnit $devisionUnit)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'devision_id' => 'required',
            'title' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $devisionUnit->devision_id =$input['devision_id'];
        $devisionUnit->title = $input['title'];
        $devisionUnit->is_active = $input['is_active'];
        if($input['meta_id']){
            $metafild = DevisionUnitMeta::where('meta_id',$input['meta_id'])->find($input['id']);
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        $devisionUnit->save();
        
        return $this->sendResponse($devisionUnit, 'Devision Unit updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DevisionUnit  $devisionUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(DevisionUnit $devisionUnit)
    {
        $devisionUnit->delete();
        return $this->sendResponse($devisionUnit, 'Devision unit deleted successfully.');
    }
}
