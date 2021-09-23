<?php
/*MM*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tzsk\Otp\Facades\Otp;
use App\Models\User;


class AccountController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function getpassword(Request $req)
    {
        $username = self::get_fixed_phone($req->input('username'));
        log::info("fixed phone is: " . $username);
                
        $haveAccount = false;
        $haveAccount = User::where('phone' , $username) -> first();

        if($haveAccount){
            return view('enterpassword', compact('username'));
        }
        else
            {
                // genarate otp
                $otp = Otp::generate($username);

                $user = new \App\Models\User();
                $user->phone = $username;
                $user->api_token = $otp;
                $user->save();

                // for test otp without sms
                // return response()->json(['phone'=>$req->phone,'otp' => $otp]);
                log::info("otp for new user is: ".$otp);

                // pls config config/sms-api.php for your sms api provider.
                // smsapi($request->phone, $otp);

                $msg = 'رمز عبور یکبار مصرف برای تلفن همراه شما پیامک گردید';
                $req->session()->flash('success', $msg);
                return view('smsverify')->with('username',$username);

            }
    }

    public function checkpassword(Request $req)
    {
        $username = self::get_fixed_phone(request()->input('username'));
        Log::debug('in checkpassword func username is '.$username);

        $password = $req->input('password');

        $user = User::where('phone', '=', $username)->first();

        // return 'pass is : '.$password;
        $truePassword = false;
        $truePassword = Hash::check($password , $user->password);

        if(!$truePassword){
            // wrong password
            $req->session()->flash('error', 'رمز عبور اشتباه است');
            return view('enterpassword')->with('username',$username);

        }
        else{
            $req->session()->forget('error');
            
            // login user
            Auth::login($user);
            
            return view('home');
        }

    }

    public function getpasswordform(Request $req)
    {
        $username = self::get_fixed_phone(request()->input('username'));
        Log::debug('in getpasswordform func username is '.$username);

        return view('enterpassword' , compact('req','username'));
    }

    public function sendOtp(Request $req){

        $username = self::get_fixed_phone(request()->input('username'));
        // genarate otp
        $otp = Otp::generate($req->phone);

        // save otp for user
        $user = User::where('phone', '=', $username)->first();
        $user->api_token = $otp;
        $user->save();

        // for test otp without sms
        log::info("otp is: ".$otp);

        // pls config config/sms-api.php for your sms api provider.
        // smsapi($request->phone, $otp);

        $msg = 'رمز عبور یکبار مصرف برای تلفن همراه شما پیامک گردید';
        $req->session()->flash('success', $msg);
        return view('smsverify')->with('username',$username);
    }

    public function smsverify(Request $req){

        $phone = $req->input('username');
        $otp = $req->input('otp');

        Log::debug('in smsverify func, phone is: '.$phone);
        Log::debug('in smsverify func, otp entered is: '.$otp);

        $user = User::where('phone', '=', $phone)->where('api_token' , '=' , $otp)->first();
        if ($user === null) {
            // wrong otp
            $msg = 'رمز یکبار مصرف اشتباه است!';
            $req->session()->flash('error', $msg);
            return view('smsverify')->with('username',$phone);
        }else{
            // true otp

            // login user
            Auth::login($user);

            $msg = 'لطفا رمز عبور خود را تعیین نمایید';
            $req->session()->flash('success', $msg);
            return view('resetpassword');
        }
    }

    public function resetpassword(Request $req){
            // check user logged in
            if (Auth::check()) {
                $request_data = $req->All();
                $validator = $this->reset_password_rules($request_data);
                if($validator->fails())
                {
                    return view('resetpassword');
                }
                else
                {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);
                    $obj_user->save();

                    $req->session()->forget('error');
                    
                    return view('home');
                }
            }
            else
            {
                return redirect()->to('/');
            }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function reset_password_rules(array $data)
    {
        $messages = [
            'password.required' => 'لطفا رمز عبور را وارد فرمایید',
        ];

        $validator = Validator::make($data, [
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }

    public static function get_fixed_phone($phone){
        $cut = substr($phone, -10);
        return "0098" . $cut;
    }
}
