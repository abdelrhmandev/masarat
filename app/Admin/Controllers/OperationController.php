<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->CASES_SERVICE = app('App\Admin\Services\CasesService');
        $this->COMMON_SERVICE = app('App\Admin\Services\CommonService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
    }

    public function index()
    {
        $getApproveRejectCasesCount = $this->NAVIGATION_SERVICE->getApproveRejectCases([14, 15])->count();
        $getHanggedCasesCount = $this->NAVIGATION_SERVICE->getHanggedCases([10])->get()->sum('count');
        $awaitExecuteCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([14])->count();
        $executedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([8])->count();
        $workedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([8, 9, 10])->count();

        $executedCases_ratio = 0;
        $waitExecuteCaseCount_ratio = 0;
        $wordkedCases_ratio = 0;
        $totalTransfered = $executedCaseCount + $awaitExecuteCaseCount;
        if ($totalTransfered > 0) {
            $executedCases_ratio = round($executedCaseCount / $totalTransfered, 2) * 100;
            $waitExecuteCaseCount_ratio = round($awaitExecuteCaseCount / $totalTransfered, 2) * 100;
        }

        $totalWorked = $workedCaseCount + $awaitExecuteCaseCount;
        if ($totalWorked > 0) {
            $wordkedCases_ratio = round($workedCaseCount / $totalWorked, 2) * 100;
        }

        $compact = [
            'partTransferApprovedCount' => $getApproveRejectCasesCount,
            'hanggedIntsCaseCount' => $getHanggedCasesCount,
            'executedCases_ratio' => $executedCases_ratio,
            'waitExecuteCaseCount_ratio' => $waitExecuteCaseCount_ratio,
            'wordkedCases_ratio' => $wordkedCases_ratio,
        ];

        return view('tailAdmin.pages.operation.dashboard', $compact);
    }

    public function operationDoExecution(Request $request)
    {
        if ($request->post('to_role') == 8) {
            if (! DB::table('forms')
                ->leftJoin('forms_parent', 'forms_parent.id', 'forms.forms_parent_id')
                ->where('forms.id', '=', $request->post('form_id'))
                ->update(['forms.status' => 8])
            ) {
                return back()->with('error', __(trans('providers.status_update_error')));
            }
        } else if ($request->post('to_role') == 9) {
            if (DB::table('forms')
                ->leftJoin('forms_parent', 'forms_parent.id', 'forms.forms_parent_id')
                ->where('forms.id', '=', $request->post('form_id'))
                ->update(['forms.status' => 9, 'forms.updated_at' => date('Y-m-d H:i:s')])
            ) {
                $close_forms_insertions = [];
                $close_forms_insertions[] = [
                    'form_id' => $request->post('form_id'),
                    'status_id' => $request->post('to_role'),
                    'reason' => $request->post('close_notes'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                DB::table('form_current_status')->insert($close_forms_insertions);
            } else {
                return back()->with('error', __(trans('providers.status_update_error')));
            }
        }
        return back()->with('success', __(trans('interventions.cases.updated')));
    }

    public function operationDoHang(Request $request)
    {
        $form_id = $request->form_id;
        $notes = $request->hang_notes;
        $reason = $request->reason;
        $insertion = [
            [
                'form_id' => $form_id,
                'reason' => $reason,
                'notes' => $notes,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        if (DB::table('form_hang')->insert($insertion)) {
            if ($reason == 'Approval') {
                DB::table('forms')->where('id', '=', $form_id)->update(['status' => '12']);
                return back()->with('success', trans('interventions.cases.updated'));
            } else if ($reason == 'Execution' || $reason == 'Customer') {
                DB::table('forms')->where('id', '=', $form_id)->update(['status' => '10']);
                return back()->with('success', trans('interventions.cases.updated'));
            }
        }
        return back()->with('error', trans('providers.status_update_error'));
    }
}