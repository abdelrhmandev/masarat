<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/users');
        $users = DB::table('admin_users')->where('id', '>', '5')->paginate($request->input('count') ?? '50');
        $compact = ['current_url' => $current_url, 'users' => $users];
        return view('tailAdmin.pages.director.users', $compact);
    }

    public function addUser(Request $request)
    {
        $name = explode('@', $request->post('email'));
        $department = $request->post('department');
        $role_id = 0;
        $dept_name = '';
        if ($department == 'development') {
            $role_id = 2;
            $dept_name = "الإدارة التنموية";
        } elseif ($department == 'partners') {
            $role_id = 3;
            $dept_name = "إدارة الشراكات";
        } elseif ($department == 'operation') {
            $role_id = 4;
            $dept_name = "إدارة العمليات";
        } elseif ($department == 'orphan') {
            $role_id = 5;
            $dept_name = "إدارة الأيتام";
        }

        $insertions = [
            'username' => $name[0],
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'department_ar' => $dept_name,
            'department' => $request->post('department'),
            'phone' => $request->post('phone'),
            'int_housing' => $request->post('int_housing') == null ? 1 : 0,
            'int_direct' => $request->post('int_direct') == null ? 1 : 0,
            'int_health' => $request->post('int_health') == null ? 1 : 0,
            'int_job' => $request->post('int_job') == null ? 1 : 0,
            'int_logistic' => $request->post('int_logistic') == null ? 1 : 0
        ];

        try {
            $user_id = DB::table('admin_users')->insertGetId($insertions);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('success', trans('users.user.error'));
        }

        $insertions = [
            'role_id' => $role_id,
            'user_id' => $user_id
        ];

        if (DB::table('admin_role_users')->insert($insertions)) {
            return back()->with('success', trans('users.user.added'));
        }
    }

    public function userDetails(Request $request)
    {
        return response(DB::table('admin_users')->where('id', '=', $request->get('id'))->first());
    }

    public function editUser(Request $request)
    {
        return DB::table('admin_users')->where('id', '=', $request->get('id'))->first();
    }
    public function changePassword(Request $request)
    {
        return DB::table('admin_users')->where('id', '=', $request->get('id'))->first();
    }

    public function updateUser(Request $request)
    {
        if (! empty($request->post('id'))) {
            DB::table('admin_users')->where('id', '=', $request->post('id'))->update([
                'department_ar' => $request->post('name'),
                'phone' => $request->post('phone'),
                'department' => $request->post('department'),
                'int_housing' => $request->post('ints_housing') == null ? 1 : 0,
                'int_direct' => $request->post('ints_direct') == null ? 1 : 0,
                'int_health' => $request->post('ints_health') == null ? 1 : 0,
                'int_job' => $request->post('ints_job') == null ? 1 : 0,
                'active' => $request->post('active'),
                'int_logistic' => $request->post('ints_logistic') == null ? 1 : 0
            ]);
            return back()->with('success', trans('users.user.updated'));
        }

        return back()->with('error', trans('users.user.error'));
    }

    public function updateUserPassword(Request $request)
    {
        if (! empty($request->post('id'))) {
            DB::table('admin_users')->where('id', '=', $request->post('id'))->update([
                'password' => Hash::make($request->post('password')),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return back()->with('success', trans('users.user.updated'));
        }

        return back()->with('error', trans('users.user.error'));
    }

    public function deleteUser(Request $request)
    {
        if (! empty($request->id) && $request->id > 0) {
            DB::table('admin_role_users')->where('user_id', '=', $request->id)->delete();
            DB::table('admin_users')->where('id', '=', $request->id)->delete();
            return back()->with('success', trans('users.user.deleted'));
        }

        return back()->with('error', trans('users.user.error'));
    }
}