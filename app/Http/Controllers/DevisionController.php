<?php

namespace App\Http\Controllers;

use App\Models\Devision;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DevisionMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DevisionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devisions = Devision::with('metafild')->get();
        return $this->sendResponse($devisions, 'Devisions fetched.');
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
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $devisions = Devision::create($input);
        if($request->meta_id){
            $metafild = new DevisionMeta();
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        return $this->sendResponse($devisions, 'New devision created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function show(Devision $devision)
    {
        $devision_withmeta = Devision::with('metafild')->find($devision->id);
        if (is_null($devision_withmeta)) {
            return $this->sendError('Devisions does not exist.');
        }
        return $this->sendResponse($devision_withmeta, 'Devisions fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function edit(Devision $devision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devision $devision)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $devision->name =$input['name'];
        $devision->slug = $input['slug'];
        $devision->short_description = $input['short_description'];
        $devision->description = $input['description'];
        $devision->is_active = $input['is_active'];
        if($input['meta_id']){
            $metafild = DevisionMeta::where('meta_id',$input['meta_id'])->find($input['id']);
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        $devision->save();
        
        return $this->sendResponse($devision, 'Devision updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devision $devision)
    {
        $devision->delete();
        return $this->sendResponse($devision, 'Devision deleted successfully.');
    }
}
