<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

/*
    login khusus admin
 */
class LoginController extends Controller
{
    //use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        return $this->showLoginForm();
        //return view('index');
    }

    public function prosesLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }


    // public function checkValidUser(Privileges $priv, Request $request)
    public function checkValidUser(Request $request)
    {
        $validUser = User::userValid($request->userid, $request->pwd);
        if(!$validUser)
        {
            return back()->withErrors(['error'=>'User atau Password anda salah !'])->withInput();
        }
        else
        {
            $idgroup = session()->get('ses_idgroup');
            //$menus = $priv->setHakAksesMenu($idgroup);

            return redirect('/backend/dashboard');
        }
    }

    public function prosesLoginRegular(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->withinput($validator->errors());
        }

        $users = User::where('email',$request->email)->get();

    }


    public function showRegisterForm()
    {
        return view('admin.pages.login.register');
    }

    public function showLoginForm()
    {
        return view('admin.pages.login.login');
    }
    /*
        halaman harus verify
     */
    public function verify()
    {
        return view('auth.verify');
    }
    public function verifyRegister()
    {
        return view('admin.pages.login.verify');
    }

    public function confirm($code)
    {
        if ($code != "") {
            $user = User::where('confirm_code', $code)->get();
            if (count($user) > 0 && $user[0]['is_verified'] == 0) {
                $passport = User::find($user[0]['id']);
                $passport->is_verified = 1;
                $passport->email_confirm_at = date('Y-m-d h:i:s');
                if ($passport->save()) {
                    return view('admin.pages.login.sukses_verify');
                }
            } else if ($user[0]['is_verified'] == 1) {
                return view('admin.pages.login.already_verify');
            } else {
                return view('admin.pages.login.error_verify');
            }


        } else {
            return view('admin.pages.login.error_verify');
        }

    }

    public function destroy($id)
    {
        $passport = User::find($id);
        $passport->delete();
        return redirect('/backend')->with('success', 'Information has been  deleted');
    }


}
