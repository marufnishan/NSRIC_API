<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\SliderMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;


class SliderController extends BaseController
{
    /* protected $file;

    public function __construct(FileUpload $fileUpload)
    {
        $this->file= $fileUpload;
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('metafild')->get();
        return $this->sendResponse($sliders, 'Sliders fetched.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function create(Request $request)
    {
        
    } */

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
            'photo' => 'required',
            'long_title' => 'required',
            'short_title' => 'required',
            'link' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($request->photo);
            $upload_path = 'assets/sliders/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
        }
        
        $input['photo']=$image_url;
        $slider = Slider::create($input);
        if($request->meta_id){
            $metafild = new SliderMeta();
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        return $this->sendResponse($slider, 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        $slider_withmeta = Slider::with('metafild')->find($slider->id);
        if (is_null($slider_withmeta)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse($slider_withmeta, 'Slider fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    /* public function edit(Slider $slider)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'photo' => 'required',
            'long_title' => 'required',
            'short_title' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $image = $request->newphoto;

        if ($image) { 
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($image);
            $upload_path = 'assets/sliders/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);  
         if ($success) {
            unlink('assets/'.$request->photo);
            $slider->photo = $image_url;
            $slider->long_title = $input['long_title'];
            $slider->short_title = $input['short_title'];
            $slider->is_active = $input['is_active'];
            if($input['meta_id']){
                $metafild = SliderMeta::where('meta_id',$input['meta_id'])->find($input['id']);
                $metafild->meta_id = $input['meta_id'];
                $metafild->meta_key = $input['meta_key'];
                $metafild->meta_value = $input['meta_value'];
                $metafild->save();
            }
            $slider->save();
         }
        }else{
            $slider->photo = $request->photo;
            $slider->long_title = $input['long_title'];
            $slider->short_title = $input['short_title'];
            $slider->is_active = $input['is_active'];
            if($input['meta_id']){
                $metafild = SliderMeta::where('meta_id',$input['meta_id'])->find($input['id']);
                $metafild->meta_id = $input['meta_id'];
                $metafild->meta_key = $input['meta_key'];
                $metafild->meta_value = $input['meta_value'];
                $metafild->save();
            }
            $slider->save();
        }
       
        
        return $this->sendResponse($slider, 'Slider updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if ($slider->photo) {
            unlink('assets/'.$slider->photo);
            $slider->delete();
          }else{
            $slider->delete();
          }
        
        return $this->sendResponse([], 'Slider deleted successfully.');
    }
}
