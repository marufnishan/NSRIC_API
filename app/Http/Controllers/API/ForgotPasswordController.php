<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function submitForgetPasswordForm(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if($validator->fails()){   
            return response()->json(['error'=>$validator->errors()]);   
        }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
            ]);
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json([
            'message' => 'Please Check Your Email To Reset Password'
         ]);
    }
    public function submitResetPasswordForm(Request $request)
      {

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validator->fails()){   
            return response()->json(['error'=>$validator->errors()]);   
        }
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return response()->json([
            'message' => 'Password Successfully Updated.'
         ]);
      }
}
