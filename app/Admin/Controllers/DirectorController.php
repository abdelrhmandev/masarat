<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->CASES_SERVICE            = app('App\Admin\Services\CasesService');
        $this->COMMON_SERVICE     = app('App\Admin\Services\CommonService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
    }

    public function index()
    {
        $directorTransferCount              = $this->NAVIGATION_SERVICE->getApproveRejectCases([7, 13])->count();
        $directorUsersCount                 = DB::table('admin_users')->where('id', '>', '5')->count();
        $directorActiveUsersCount            = DB::table('admin_users')->where('id', '>', '5')->where('active', '1')->count();
        $directorNotActiveUsersCount         = DB::table('admin_users')->where('id', '>', '5')->where('active', '0')->count();

        $compact                            = [
            'directorTransferCount'      => $directorTransferCount,
            'usersCount'           => $directorUsersCount,
            'ActiveUsersCount'           => $directorActiveUsersCount,
            'NotActiveUsersCount'           => $directorNotActiveUsersCount
        ];
        
        return view('tailAdmin.pages.director.dashboard', $compact);
    }

    public function directorDoExecution(Request $request)
    {
        if (DB::table('forms')
            ->leftJoin('forms_parent', 'forms_parent.id', 'forms.forms_parent_id')
            ->where('forms.id', '=', $request->post('form_id'))
            ->update(['forms.status' => $request->post('to_role')])
        ) {
            return Session::flash('success', __(trans('interventions.cases.updated')));
        } else {
            return Session::flash('error', __(trans('providers.status_update_error')));
        }
    }
}
