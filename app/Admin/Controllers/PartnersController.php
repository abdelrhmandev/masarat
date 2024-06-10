<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Models\Provider;

class PartnersController extends Controller
{
    protected $CASES_SERVICE;
    protected $COMMON_SERVICE;

    public function __construct()
    {
        $this->CASES_SERVICE = app('App\Admin\Services\CasesService');
        $this->COMMON_SERVICE = app('App\Admin\Services\CommonService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
    }

    public function index()
    {
        $partIntsCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([4, 5])->count();
        $partApprovedCount = $this->NAVIGATION_SERVICE->getApproveCases()->sum('count');
        $partRejectedCount = $this->NAVIGATION_SERVICE->getApproveRejectCases([11])->count();
        $workedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([5])->count();
        $approvedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([13])->count();
        $rejectCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([11])->count();
        $awaitExecuteCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([4])->count();

        $approvedCaseCount_ratio = 0;
        $rejectCaseCount_ratio = 0;
        $workedCaseCount_ratio = 0;
        $waitExecuteCaseCount_ratio = 0;
        $totalCases = $approvedCaseCount + $rejectCaseCount;
        if ($totalCases == 0) {
            $totalCases = 1;
        }
        if ($approvedCaseCount > 0) {
            $approvedCaseCount_ratio = round($approvedCaseCount / $totalCases, 2) * 100;
        }
        if ($rejectCaseCount > 0) {
            $rejectCaseCount_ratio = round($rejectCaseCount / $totalCases, 2) * 100;
        }
        if ($workedCaseCount > 0) {
            $workedCaseCount_ratio = round($workedCaseCount / $totalCases, 2) * 100;
        }
        if ($awaitExecuteCaseCount > 0) {

            $waitExecuteCaseCount_ratio = round($awaitExecuteCaseCount / $totalCases, 2) * 100;
        }

        $compact = [
            'partIntsCaseCount' => $partIntsCaseCount,
            'partApprovedCount' => $partApprovedCount,
            'partRejectedCount' => $partRejectedCount,
            'approvedCaseCount_ratio' => $approvedCaseCount_ratio,
            'rejectCaseCount_ratio' => $rejectCaseCount_ratio,
            'workedCaseCount_ratio' => $workedCaseCount_ratio,
            'waitExecuteCaseCount_ratio' => $waitExecuteCaseCount_ratio,
        ];

        return view('tailAdmin.pages.partners.dashboard', $compact);
    }

    public function providers(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/providers');
        $providers = Provider::paginate($request->input('count') ?? '10');
        $compact = ['current_url' => $current_url, 'providers' => $providers];
        return view('tailAdmin.pages.partners.providers', $compact);
    }

    public function interventions()
    {
        $compact = [];
        $current_ints_array = [5, 6, 7];
        $all_intervention_details = DB::table('interventions_details')->whereIn('id', $current_ints_array)->get();
        $compact['all_intervention_details'] = $all_intervention_details;

        $already_transfered_ids_raw = DB::table('form_role')->select(DB::raw("CONCAT(`form_id`,'-',`details_id`) AS concat_rule"))
            ->where('form_role.role_id', '=', '4')
            ->get();
        $already_transfered_ids = [];
        $marks = [];
        foreach ($already_transfered_ids_raw as $one) {
            $already_transfered_ids[] = $one->concat_rule;
            $marks[] = "?";
        }
        $admin_roles_raw = Admin::user()->roles;
        $admin_roles_array = [];
        foreach ($admin_roles_raw as $one_role) {
            $admin_roles_array[] = $one_role->id;
        }

        $marks = implode(',', $marks);
        $data = DB::table('answers')
            ->select(
                DB::raw('SUM(answers.answer)'),
                'answers.intervention_details_id',
                'questions_block.text_ar AS name',
                'form_role.role_id'
            )
            ->leftJoin('questions_block', 'answers.question_id', 'questions_block.id')
            ->join('form_role', 'answers.form_id', 'form_role.form_id')
            ->rightJoin('form_role AS form_role2', 'answers.intervention_details_id', 'form_role2.details_id')
            ->rightJoin('interventions_details', 'answers.intervention_details_id', 'interventions_details.id')
            ->where('questions_block.summable', '=', '1')
            ->where('form_role.role_id', '=', '3')
            ->where('form_role2.role_id', '3')
            ->groupBy('form_role.details_id')
            ->get();

        $data = $this->COMMON_SERVICE->extractIntsData($data);
        $compact['data'] = $data;
        return view('tailAdmin.pages.intervention.interventions', $compact);
    }
}