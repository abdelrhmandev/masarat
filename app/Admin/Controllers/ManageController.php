<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PartnersExportCasesReport;

class ManageController extends Controller
{
    protected $CASES_SERVICE;
    protected $NAVIGATION_SERVICE;
    protected $COMMON_SERVICE;
    protected $VIEWS_INTERVENTION = 'tailAdmin.pages.intervention.interventions';
    protected $VIEWS_INTERVENTION_DETAILS = 'tailAdmin.pages.intervention.interventionDetails';

    public function __construct()
    {
        $this->CASES_SERVICE = app('App\Admin\Services\CasesService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
        $this->COMMON_SERVICE = app('App\Admin\Services\CommonService');
    }

    public function interventions(Request $request)
    {
        $get_status = $this->COMMON_SERVICE->extractUrlStatus($request);
        $compact = [];
        $all_intervention_details = DB::table('ints')->whereIn('parent', [1, 2, 3, 4, 5])->where('active', '=', '1')->orderBy('id')->get();
        $compact['all_intervention_details'] = $all_intervention_details;
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/transferCase');
        $cases = $this->CASES_SERVICE->getCasesByStatus($get_status)->get();
        $compact = ['ints_status_url' => 'ints', 'cases' => $cases, 'all_intervention_details' => $all_intervention_details, 'current_url' => $current_url, 'page_title' => trans('title.interventions'), 'header_title' => trans('title.interventions')];

        return view($this->VIEWS_INTERVENTION, $compact);
    }

    public function PartnersExportInterventions(Request $request)
    {
        $mytime = \Carbon\Carbon::now();
        $Exported_File = trans('PartnersExportInterventions') . $mytime->toDateString() . '.xlsx';
        return Excel::download(new PartnersExportCasesReport($request), $Exported_File);
    }

    public function ints(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/ints/' . $request->details_id);
        $cases = $this->CASES_SERVICE->getFilteredCasesWithAnswersByIntId($request, $request->details_id)->paginate($request->input('count') ?? '10');
        $answers = $this->CASES_SERVICE->getCasesAnswersFromObject($cases);
        $columnsAnswers = $this->CASES_SERVICE->getColumnsAnswers($request);
        $viewTitles = $this->COMMON_SERVICE->getViewsTitles($request);
        $compact = [
            'cases' => $cases,
            'answers' => $answers,
            'current_url' => $current_url,
            'details_id' => $request->details_id,
            'columns' => $columnsAnswers['columns'],
            'colum_type_by_id' => $columnsAnswers['colum_type_by_id'],
            'providers' => $columnsAnswers['providers'],
            'page_title' => trans($viewTitles['page_title']),
            'header_title' => trans($viewTitles['header_title']),
            'ints_status_url' => 'ints',
        ];

        return view($this->VIEWS_INTERVENTION_DETAILS, $compact);
    }

    public function imagesCases(Request $request)
    {
        $response = $this->CASES_SERVICE->getImgesCases($request->post('form_id'));
        return response((array) $response);
    }

    public function supportedInts(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/supported_ints/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfInts($request, [6], $current_url, 'supported_ints'));
    }

    public function executedInts(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/executed_ints/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfInts($request, [8], $current_url, 'executed_ints'));
    }

    public function returnedInts(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/returned_ints/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfInts($request, [12], $current_url, 'returned_ints'));
    }

    public function hanggedInts(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/hanggedInts/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfInts($request, [10], $current_url, 'hanggedInts'));
    }

    public function supported()
    {
        $compact = [];
        $all_intervention_details = DB::table('ints')->whereIn('parent', [1, 2, 3, 4, 5])->where('active', '=', '1')->orderBy('id')->get();
        $compact['all_intervention_details'] = $all_intervention_details;
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/transferCase');
        $cases = $this->CASES_SERVICE->getSupportedCases([6])->groupBy('int_questions.int_id')->get();

        $compact = [
            'ints_status_url' => 'supported_ints',
            'cases' => $cases,
            'all_intervention_details' => $all_intervention_details,
            'current_url' => $current_url,
            'page_title' => trans('title.supported'),
            'header_title' => trans('title.supported')
        ];

        return view($this->VIEWS_INTERVENTION, $compact);
    }

    public function getOperationAnswer($getStatus, $ints_status_url, $title)
    {
        $compact = [];
        $all_intervention_details = DB::table('ints')->whereIn('parent', [1, 2, 3, 4, 5])->where('active', '=', '1')->orderBy('id')->get();
        $compact['all_intervention_details'] = $all_intervention_details;
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/transferCase');
        $cases = $this->CASES_SERVICE->getUncompletedCasesByStatus($getStatus)->groupBy('ints.name_ar')->get();

        return [
            'ints_status_url' => $ints_status_url,
            'cases' => $cases,
            'all_intervention_details' => $all_intervention_details,
            'current_url' => $current_url,
            'page_title' => $title,
            'header_title' => $title
        ];
    }

    public function executed()
    {
        return view('tailAdmin.pages.intervention.interventions', $this->getOperationAnswer([8], 'executed_ints', trans('title.executed')));
    }

    public function returned()
    {
        return view('tailAdmin.pages.intervention.interventions', $this->getOperationAnswer([12], 'returned_ints', trans('title.returned')));
    }

    public function hangged()
    {
        return view('tailAdmin.pages.intervention.interventions', $this->getOperationAnswer([10], 'hanggedInts', trans('title.hangged')));
    }

    public function approvedSupports(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/approvedSupports/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfIntsApprovedRejected($request, [13], $current_url, 'approvedSupports'));
    }

    public function rejectedSupports(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/rejectedSupports/' . $request->details_id);
        return view($this->VIEWS_INTERVENTION_DETAILS, $this->COMMON_SERVICE->statusOfIntsApprovedRejected($request, [11], $current_url, 'rejectedSupports'));
    }

    public function approvedSupport(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/approvedSupport');
        return view($this->VIEWS_INTERVENTION, $this->COMMON_SERVICE->statusOfSupport($request, [13], $current_url, 'approvedSupports', trans('title.approvedSupport'), trans('title.approvedSupport')));
    }

    public function rejectedSupport(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/rejectedSupport');
        return view($this->VIEWS_INTERVENTION, $this->COMMON_SERVICE->statusOfSupport($request, [11], $current_url, 'rejectedSupports', trans('title.rejectedSupport'), trans('title.rejectedSupport')));
    }

    public function supportDetails(Request $request)
    {
        $response = DB::table('form_providers')
            ->select('fcs.reason', 'providers.name', 'providers.person_name', 'providers.phone', 'providers.email', 'providers.full_address')
            ->leftJoin('providers', 'providers.id', 'form_providers.provider_id')
            ->leftJoin('form_current_status AS fcs', 'fcs.form_id', 'form_providers.form_id')
            ->where('form_providers.form_id', '=', $request->id)
            ->first();
        return response((array) $response);
    }

    public function approveDetails(Request $request)
    {
        $response = DB::table('form_approved')
            ->select('reference_number', 'created_at')
            ->where('form_id', '=', $request->id)
            ->first();
        return response((array) $response);
    }

    public function reasonDetails(Request $request)
    {
        $response = DB::table('form_rejected')
            ->select('reason', 'created_at')
            ->where('form_id', '=', $request->id)
            ->first();
        return response((array) $response);
    }

    public function moveFormToWaiting(Request $request)
    {
        if (DB::table('forms')
            ->leftJoin('forms_parent', 'forms_parent.id', 'forms.forms_parent_id')
            ->where('forms.id', '=', $request->post('form_id'))
            ->update(['forms.status' => $request->post('status')])
        ) {
            return response(['success' => trans('providers.status_updated')]);
        } else {
            return response(['error' => trans('providers.status_update_error')], 500);
        }
    }

    public function notCompleted(Request $request)
    {
        $personal_id = [];
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/notCompleted');
        $current_user_expiry_object = $this->COMMON_SERVICE->getUnconfirmed();
        for ($i = 0; $i < $current_user_expiry_object->count(); $i++) {
            $lastest_updated = new Carbon($current_user_expiry_object[$i]->updated_at);
            $now = Carbon::now();
            $days = $lastest_updated->diff($now)->days;

            if ($days >= 5) {
                $personal_id[$i] = $current_user_expiry_object[$i]->personal_id;
            }
        }

        $notCompletedCases = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'forms.forms_parent_id AS forms_parent_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
                'pens.mobile',
                'pens.updated_at',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->whereIn('pens.personal_id', $personal_id)
            ->groupBy('pens.id');

        $cases = $notCompletedCases->paginate($request->input('count') ?? '10');
        $compact = ['cases' => $cases, 'current_url' => $current_url, 'filters' => []];
        $compact['notcompleted_ints'] = DB::table('forms')
            ->select(
                'forms.*',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
                'ints.*',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->whereIn('pens.personal_id', $personal_id)
            ->where('forms.status', '1')
            ->get();

        return view('tailAdmin.pages.development.notCompletedCases', $compact);
    }

    public function operationHangreasonDetails(Request $request)
    {
        $response = [];
        $response = DB::table('form_hang')->select('reason', 'notes', 'created_at')->where('form_id', '=', $request->id)->first();

        $date = $response->created_at;
        $response->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
        if ($response->reason == 'Approval') {
            $response->reason = 'الموافقه';
        } elseif ($response->reason == 'Execution') {
            $response->reason = 'التنفيذ';
        } elseif ($response->reason == 'Customer') {
            $response->reason = 'المستفيد';
        }

        return response((array) $response);
    }

    public function NotCompletedCasesModal(Request $request)
    {
        $answers_raw = DB::table('forms_parent AS fp', 'fp.pen_id', 'pens.id')
            ->leftJoin('forms AS form', 'form.forms_parent_id', 'fp.pen_id')
            ->leftJoin('ints', 'ints.id', 'form.int_id')
            ->where('form.status', '1')
            ->where('form.forms_parent_id', $request->id)
            ->select('ints.name_short')->get();

        foreach ($answers_raw as $one_answer) {
            $answers[] = $one_answer->name_short;
        }

        return $answers;
    }
}