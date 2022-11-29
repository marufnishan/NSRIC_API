@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="my-5 text-center"> <b>Settings</b></h2>
            <div class="table-bordered">
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>logo</td>
                            <td>Email</td>
                            <td>Alternate Email</td>
                            <td>Phone</td>
                            <td>Alternate Phone</td>
                            <td>Location</td>
                            <td>About Us</td>
                            <td>Facebook link</td>
                            <td>Twiter link</td>
                            <td>Youtube link</td>
                            <td>Linkedin link</td>
                            <td>Instagram link</td>
                            <td>Teligram link</td>
                            <td>Updated_At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $key=>$setting)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td><img src="{{asset('assets')}}/{{$setting->logo }}" style="height: 100px; width:200px;" /></td>
                            <td>{{$setting->email}}</td>
                            <td>{{$setting->alternate_email }}</td>
                            <td>{{$setting->phone}}</td>
                            <td>{{$setting->alternate_phone }}</td>
                            <td>{{$setting->location}}</td>
                            <td>{{$setting->about_us}}</td>
                            <td>{{$setting->fb_link}}</td>
                            <td>{{$setting->twitter_link}}</td>
                            <td>{{$setting->youtube_link}}</td>
                            <td>{{$setting->linkedin_link}}</td>
                            <td>{{$setting->insta_link}}</td>
                            <td>{{$setting->telegram_link}}</td>
                            <td>{{$setting->updated_at}}</td>
                            <td>
                                <a  href="#"
                                    class="btn btn-primary update_setting_form my-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateModal" 
                                    data-id="{{ $setting->id }}"
                                {{-- data-name="{{ $role->name }}" --}}
                                ><i class="las la-edit"></i>
                                </a>

                                <a  href="#"
                                    class="btn btn-danger delete_setting my-1" 
                                    data-id="{{ $setting->id }}"
                                ><i class="las la-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {!! $settings->links() !!}
            </div>
        </div>
    </div>
</div>
{{-- @include('admin.contucts.contucts_js') --}}
@endsection