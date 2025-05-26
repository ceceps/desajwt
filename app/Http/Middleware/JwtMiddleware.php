<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                //auto refresh expires
                auth('api')->refresh($token);
                //$newToken = $this->auth->setRequest($request)->parseToken()->refresh();

                if ($request->ajax()) {
                    $response->headers->set('Authorization', 'Bearer '.$newToken);
                }
                return redirect('backend');
                //return response()->json(['status' => 'Token is Expired']);
            }else{
                if ($request->ajax()){
                    return response()->json(['status' => 'Authorization Token not found']);
                }else{
                    if($request->input('source')=='admin_login')
                        return redirect('backend/login');
                    else{

                         return redirect('login');
                    }
                }
            }
        }
        return $next($request);
    }
}
