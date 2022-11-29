<?php

namespace App\Http\Controllers\API;

// use Laravel\Passport\Bridge\User;
use App\Models\User;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\RefreshToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['user'] =  $user;
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function login(Request $request)
    {
        // $gmail = "md.rabby.mahmud@gmail.com";
        // $name = "sofen";
        // $phone = "01719272223";
        $word = $request->email;
        $qry = User::select('email')->where('email', $word)->orWhere('name', $word)->orWhere('phone', $word)->first();
        if($qry != null){
            if(Auth::attempt(['email' => $qry->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $user_meta = UserMeta::where('meta_id',$user->id);
                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                $success['user'] =  $user;
                $success['user_meta'] =  $user_meta;
                $success['role'] =  $user->getRoleNames();
                $success['permissions'] =  $user->getAllPermissions()->pluck('name');
                return $this->sendResponse($success, 'User login successfully.');
            }else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')
            ->whereUserId($request->user()->id)
            ->delete();
        $success['user'] =  $request->user();
        return $this->sendResponse($success, 'User logged out successfully.');
    }
}
