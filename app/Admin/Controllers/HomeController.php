<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use DB;
use Hash;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    public function login()
    {
        return view('auth.login');
    }

    public function changePassword()
    {
        return view('auth.passwords.change');
    }

    public function changePasswordSubmit(Request $request)
    {
        // validate the form data
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user_id = auth()->id();
            DB::table('admin_users')->where('id', '=', $user_id)->update([
                'password'         => Hash::make($request->post('password')),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);

            return back()->with('success', trans('users.user.updated'));
        }
    }
}
