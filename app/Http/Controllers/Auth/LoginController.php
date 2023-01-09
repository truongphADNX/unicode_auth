<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fieldDb = null;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:6',
        ],[
            $this->username().'.required' =>'............1',
            $this->username().'.string' =>'............2',
            // $this->username().'.email' =>'............3',
            'password.required' => '..............4',
            'password.string' => '..............5',
            'password.min' => '........ :min ......6',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('Tên đăng nhập hoặc mật khẩu không hợp lệ!')],
        ]);
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $fieldDb = null;
        if (filter_var($request->username,FILTER_VALIDATE_EMAIL)) {
            $fieldDb  = 'email';
        }else {
            $fieldDb = 'username';
        }

        $dataArr = [
            $fieldDb => $request->username,
            'password' =>$request->password
        ];
        return $dataArr;
        // return $request->only($this->username(), 'password');
    }

}
