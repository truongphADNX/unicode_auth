<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('doctors.auth.login');
    }

    public function postLogin(Request $request){

        $dataLogin = $request->except(['_token']);
        if (isDoctorActive($request['email'])) {
            $checkLogin = Auth::guard('doctor')->attempt($dataLogin);
            if ($checkLogin) {
                return  redirect(RouteServiceProvider::DOCTOR);
            }else {
                return  back()->with('msg', 'Email or password is invalid');
            }
        }
        else {
            return  back()->with('msg','Account is active');
        }
    }
}
