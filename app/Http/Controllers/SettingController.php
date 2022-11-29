<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\SettingMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::with('metafild')->get();
        return $this->sendResponse($settings, 'Settings fetched.');
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
            'logo' => 'required',
            'email' => 'required',
            'alternate_email' => 'required',
            'phone' => 'required',
            'alternate_phone' => 'required',
            'location' => 'required',
            'about_us' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'youtube_link' => 'required',
            'linkedin_link' => 'required',
            'insta_link' => 'required',
            'telegram_link' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if($request->logo){
             
             /* $imageName = "FTL"."-".Str::random(10).'.webp';
             $upload_path = 'settings/';
 
             Storage::disk('local')->put($upload_path.$imageName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$request->logo))); */
             $image_url = $request->file('logo')->store('settings', 'local');
             
 
         }
 
         $input['logo']=$image_url;
        $settings = Setting::create($input);
        if($request->meta_id){
            $metafild = new SettingMeta();
            $metafild->meta_id = $input['meta_id'];
            $metafild->meta_key = $input['meta_key'];
            $metafild->meta_value = $input['meta_value'];
            $metafild->save();
        }
        return $this->sendResponse($settings, 'Settings created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        if (is_null($setting)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse($setting, 'Setting fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'logo' => 'required',
            'email' => 'required',
            'alternate_email' => 'required',
            'phone' => 'required',
            'alternate_phone' => 'required',
            'location' => 'required',
            'about_us' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'youtube_link' => 'required',
            'linkedin_link' => 'required',
            'insta_link' => 'required',
            'telegram_link' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $image = $request->newlogo;

        if ($image) {
           /*  $imageName = "FTL"."-".Str::random(10).'.webp';
            $upload_path = 'settings/';
            $success = Storage::disk('local')->put($upload_path.$imageName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$image))); */ 
            $image_url = $request->file('newlogo')->store('settings', 'local');   
         if ($image_url) {
            unlink('assets/'.$request->logo);
            $setting->logo = $image_url;
            $setting->email = $input['email'];
            $setting->alternate_email = $input['alternate_email'];
            $setting->phone = $input['phone'];
            $setting->alternate_phone = $input['alternate_phone'];
            $setting->location = $input['location'];
            $setting->about_us = $input['about_us'];
            $setting->fb_link = $input['fb_link'];
            $setting->twitter_link = $input['twitter_link'];
            $setting->youtube_link = $input['youtube_link'];
            $setting->linkedin_link = $input['linkedin_link'];
            $setting->insta_link = $input['insta_link'];
            $setting->telegram_link = $input['telegram_link'];
            if($input['meta_id']){
                $metafild = SettingMeta::where('meta_id',$input['meta_id'])->find($input['id']);
                $metafild->meta_id = $input['meta_id'];
                $metafild->meta_key = $input['meta_key'];
                $metafild->meta_value = $input['meta_value'];
                $metafild->save();
            }
            $setting->save();
         }
        }else{
            $setting->logo = $input['logo'];
            $setting->email = $input['email'];
            $setting->alternate_email = $input['alternate_email'];
            $setting->phone = $input['phone'];
            $setting->alternate_phone = $input['alternate_phone'];
            $setting->location = $input['location'];
            $setting->about_us = $input['about_us'];
            $setting->fb_link = $input['fb_link'];
            $setting->twitter_link = $input['twitter_link'];
            $setting->youtube_link = $input['youtube_link'];
            $setting->linkedin_link = $input['linkedin_link'];
            $setting->insta_link = $input['insta_link'];
            $setting->telegram_link = $input['telegram_link'];
            if($input['meta_id']){
                $metafild = SettingMeta::where('meta_id',$input['meta_id'])->find($input['id']);
                $metafild->meta_id = $input['meta_id'];
                $metafild->meta_key = $input['meta_key'];
                $metafild->meta_value = $input['meta_value'];
                $metafild->save();
            }
            $setting->save();
        }

        
        return $this->sendResponse($setting, 'Setting updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        if ($setting->logo) {
            unlink('assets/'.$setting->logo);
            $setting->delete();
          }else{
            $setting->delete();
          }
        
        return $this->sendResponse($setting, 'Setting deleted successfully.');
    }
}
