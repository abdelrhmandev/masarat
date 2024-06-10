<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;

class CaptureTransactionHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $insertions                 = [];

        // case of development logged in account
        if (Admin::user()->inRoles(['development'])) {
            if (empty($request->role_id) && $request->reject_form == 1) {
                $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $request->form_id, 'status_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            }

            if ($request->role == 7) { 
                if (!empty($request->input('ids'))) {
                    $ids                                    = explode(',', $request->post('ids'));
                    foreach ($ids as $form_id) {
                        $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => 7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
                    }
                }
            } elseif ($request->role == 4 || $request->role == 3) { 
                if (!empty($request->input('ids'))) {
                    $ids                                    = explode(',', $request->post('ids'));
                    foreach ($ids as $form_id) {
                        $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
                    }
                }
            } elseif ($request->role == 13) { 
                if (!empty($request->input('ids'))) {
                    $ids                                    = explode(',', $request->post('ids'));
                    foreach ($ids as $form_id) {
                        $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => 13, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
                    }
                }
            }
        }
        // case of partners logged in account transaction history
        else if (Admin::user()->inRoles(['partners']) && $request->post('form_id') && $request->post('status')) {
            $form_id = $request->post('form_id');
            $status_id = $request->post('status');
            $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => $status_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
        // case of operations logged in account transaction history
        else if ((Admin::user()->inRoles(['director']) || Admin::user()->inRoles(['operation'])) && $request->post('form_id') && $request->post('to_role')) {
            $form_id = $request->post('form_id');
            $status_id = $request->post('to_role');

            if (is_array($request->post('form_id'))) {
                foreach ($request->post('form_id') as $form_id) {
                    $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => $status_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
                }
            } else {
                $insertions[]  = ['user_id' => Admin::user()->id, 'form_id' => $form_id, 'status_id' => $status_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            }
        }
        
        DB::table('transactions_history')->insert($insertions);
        return $next($request);
    }
}
