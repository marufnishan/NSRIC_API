<?php

namespace App\Http\Controllers;

use App\Models\Contuct;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ContuctMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContuctController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contucts = Contuct::with('metafild')->get();
        return $this->sendResponse($contucts, 'Contucts fetched.');
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
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $contuctus = Contuct::create($input);
        if($request->meta_id){
            $metafild = new ContuctMeta();
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        return $this->sendResponse($contuctus, 'new contuctus created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contuct  $contuct
     * @return \Illuminate\Http\Response
     */
    public function show(Contuct $contuct)
    {
        $contuct_withmeta = Contuct::with('metafild')->find($contuct->id);
        if (is_null($contuct_withmeta)) {
            return $this->sendError('Contucts does not exist.');
        }
        return $this->sendResponse($contuct_withmeta, 'Contucts fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contuct  $contuct
     * @return \Illuminate\Http\Response
     */
    public function edit(Contuct $contuct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contuct  $contuct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contuct $contuct)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $contuct->name =$input['name'];
        $contuct->email = $input['email'];
        $contuct->phone = $input['phone'];
        $contuct->message = $input['message'];
        if($input['meta_id']){
            $metafild = ContuctMeta::where('meta_id',$input['meta_id'])->find($input['id']);
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        $contuct->save();
        
        return $this->sendResponse($contuct, 'Contuct updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contuct  $contuct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contuct $contuct)
    {
        $contuct->delete();
        return $this->sendResponse($contuct, 'Contuct deleted successfully.');
    }
}
