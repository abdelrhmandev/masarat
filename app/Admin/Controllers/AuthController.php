<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseAuthController
{
    public function postLogin(Request $request)
    {
        //Error messages
        $messages = [
            "email.required" => "email is required",
            "email.exists" => trans('auth.email'),
            "password.required" => trans('auth.password'),
            // "password.min" => "Password must be at least 6 characters"
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:admin_users,email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user = DB::table('admin_users')->where($this->email(), $request->{$this->email()})->first();
            if ($user && ! \Hash::check($request->password, $user->password)) {
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'password' => trans('auth.password'),
                ]);
            }
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'active' => '1',
            ];
            $remember = $request->get('remember', false);
            if ($this->guard()->attempt($credentials, $remember)) {
                return $this->sendLoginResponse($request);
            }

            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'active' => trans('auth.active'),
            ]);
        }
    }

    protected function email()
    {
        return 'email';
    }
}