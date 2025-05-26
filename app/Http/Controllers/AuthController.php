<?php
namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');

        $this->request = $request;
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User  $user, Request $request
     * @return json
     */
    public function authenticate(User $user, Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules =  [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        // $valid = $this->validate($this->request,$rules);
        $validator =  Validator::make($request->all(), $rules);
        if ($validator->failed()) {
            // return response()->json(['error' =>$validator->errors()], 200);
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token'));
            // Find the user by email
            /*
            $user = User::where('email', $this->request->input('email'))->first();
            if (!$user) {
                // You wil probably have some sort of helpers or whatever
                // to make sure that you have the same response format for
                // differents kind of responses. But let's return the
                // below respose for now.
                return response()->json([
                    'error' => 'Akun tidak ditemukan.'
                ], 200);
            }
            // Verify the password and generate the token
            if (Hash::check($this->request->input('password'), $user->password)) {

                //cek role

                //cek permission

                //set redirect


                return response()->json([
                    'token' => $this->jwt($user)
                ], 200);
            }
            // Bad Request response
            return response()->json([
                'error' => 'Email atau Password salah.'
            ], 200);
            */
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telp' => 'required|string|max:20',
                'password' => 'required|string|min:6|confirmed',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'telp' => $request->telp,
                'password' => Hash::make($request->password),
            ]
        );

        if($requst->input('source')=='admin_login' && empty($requst->input('role'))) {
            $user->assignRole('admin_dinas');
        }else if($requst->input('source')=='user_cms_register' && empty($requst->input('role'))) {
            $user->assignRole($requst->input('role'));
        }else{
            $user->assignRole($requst->input('member_user'));
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function logout(){
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function token(){
        $token = JWTAuth::getToken();
        if(!$token){
            throw new BadRequestHtttpException('Token not provided');
        }
        try{
            $token = JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            throw new AccessDeniedHttpException('The token is invalid');
        }
        return $this->response->withArray(['token'=>$token]);
    }
}
