<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/backend';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return $this->showLoginForm();
    }

    public function showLoginForm()
    {
        return view('admin.pages.login.login');
    }

    public function showSupportDialog()
    {
        return view('admin.pages.login.support');
    }

    public function showRegisterForm()
    {
        return view('admin.pages.login.register');
    }
    public function showForgetForm()
    {
        return view('admin.pages.login.forget');
    }

    public function postLogin(Request $request)
    {

            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);

        $users = User::where('email', $request->email)->get();
        if (isset($users)) {
            $request->session()->push('session_admin_name', $users->nama);
            $request->session()->push('session_admin_role', $users->role);
            return redirect()->route('backend');
        }

    }

    public function validateLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(
                $request, $validator
            );

        }
    }

    protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

    }
}
