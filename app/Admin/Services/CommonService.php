<?php

namespace app\Admin\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommonService
{
    protected  $CASES_SERVICE;

    public function __construct()
    {
        $this->CASES_SERVICE            = app('App\Admin\Services\CasesService');
    }

    public function extractUrlStatus(Request $request)
    {
        $get_status     = [];
        if (strpos($request, 'development')) {
            $get_status = [3, 16, 17];
        } else if (strpos($request, 'partners')) {
            $get_status = [4, 5];
        } else if (strpos($request, 'operation')) {
            $get_status = [14, 15];
        } else if (strpos($request, 'director')) {
            $get_status = [7, 13];
        }

        return $get_status;
    }

    public function generateReferenceNumber()
    {
        $number = mt_rand(1000000, 9999999);
        if ($this->referenceNumberExists($number)) {
            return $this->generateReferenceNumber();
        }
        return $number;
    }

    public function referenceNumberExists($number)
    {
        $count           = DB::table('form_approved')->select('reference_number')->where('reference_number', '=', $number)->count();
        if ($count >= 1) {
            return true;
        }
        
        return false;
    }

    public function statusOfIntsApprovedRejected(Request $request, $get_status, $current_url, $ints_status_url)
    {
   
        $cases                       = $this->CASES_SERVICE->getFilteredCasesWithAnswersByIntIdApprovedRejected($request, $request->details_id, $get_status)->paginate($request->input('count') ?? '10');
        $columnsAnswers              = $this->CASES_SERVICE->getColumnsAnswers($request);
        $answers                     = $this->CASES_SERVICE->getCasesAnswersFromObject($cases);
        $imagesCases                 = $this->CASES_SERVICE->getImgesCases($cases);
        $viewTitles                  = $this->getViewsTitles($request);

        return [
            'current_url'            => $current_url,
            'cases'                  => $cases,
            'providers'              => $columnsAnswers['providers'],
            'answers'                => $answers,
            'details_id'             => $request->details_id,
            'columns'                => $columnsAnswers['columns'],
            'colum_type_by_id'       => $columnsAnswers['colum_type_by_id'],
            'page_title'             => trans($viewTitles['page_title']),
            'header_title'           => trans($viewTitles['header_title']),
            'imagesCases'            => $imagesCases,
            'ints_status_url'        => $ints_status_url
        ];
    }

    public function statusOfInts(Request $request, $get_status, $current_url, $ints_status_url)
    {
        $cases                       = $this->CASES_SERVICE->getFilteredCasesWithAnswersByIntId($request, $request->details_id, $get_status)->paginate($request->input('count') ?? '10');
        $columnsAnswers              = $this->CASES_SERVICE->getColumnsAnswers($request);
        $answers                     = $this->CASES_SERVICE->getCasesAnswersFromObject($cases);
        $imagesCases                 = $this->CASES_SERVICE->getImgesCases($cases);
        $viewTitles                  = $this->getViewsTitles($request);

        return [
            'current_url'            => $current_url,
            'cases'                  => $cases,
            'providers'              => $columnsAnswers['providers'],
            'answers'                => $answers,
            'details_id'             => $request->details_id,
            'columns'                => $columnsAnswers['columns'],
            'colum_type_by_id'       => $columnsAnswers['colum_type_by_id'],
            'page_title'             => trans($viewTitles['page_title']),
            'header_title'           => trans($viewTitles['header_title']),
            'imagesCases'            => $imagesCases,
            'ints_status_url'        => $ints_status_url
        ];
    }

    public function statusOfSupport(Request $request, $get_status, $current_url, $ints_status_url, $page_title, $header_title)
    {
        $cases                                 = null;
        if ($ints_status_url == 'approvedSupports') {
            $cases                             = $this->CASES_SERVICE->getApprovedCases($get_status);
        } else {
            $cases                             = $this->CASES_SERVICE->getCasesByStatus($get_status)->get();
        }

        $all_intervention_details     = DB::table('ints')->whereIn('parent', [1, 2, 3, 4, 5])->where('active', '=', '1')->orderBy('id')->get();

        return [
            'current_url'               => $current_url,
            'cases'                     => $cases,
            'all_intervention_details'  => $all_intervention_details,
            'details_id'                => $request->details_id,
            'ints_status_url'           => $ints_status_url,
            'page_title'                => $page_title,
            'header_title'              => $header_title
        ];
    }

    public function extractIntsData($data)
    {
        $data_raw                                        = $data->get();
        $data                                               = [];
        foreach ($data_raw as $one_object) {
            @$data[$one_object->intervention_details_id]['sum']                 += $one_object->sum;
            @$data[$one_object->intervention_details_id]['count']               += $one_object->count;
            @$data[$one_object->intervention_details_id]['intervention_details_id'] = $one_object->intervention_details_id;
            @$data[$one_object->intervention_details_id]['name']                = $one_object->name;
        }

        return $data;
    }

    public function getUnconfirmed()
    {
        return DB::table('pens')
            ->select('pens.personal_id', 'pens.updated_at')
            ->leftJoin('forms_parent', 'forms_parent.pen_id', 'pens.id')
            ->leftJoin('forms', 'forms.forms_parent_id', 'forms_parent.id')
            ->where('forms.status', '=', '1')
            ->groupBy('pens.id')
            ->get();
    }

    public function getNotCompletedCases()
    {
        $idCount                    = [];
        $current_user_expiry_object = $this->getUnconfirmed();
        for ($i = 0; $i < $current_user_expiry_object->count(); $i++) {
            $lastest_updated                             = new Carbon($current_user_expiry_object[$i]->updated_at);
            $now                                         = Carbon::now();
            $days                                        = $lastest_updated->diff($now)->days;

            if ($days >= 5) {
                $idCount[$i] = $current_user_expiry_object[$i]->personal_id;
            }
        }

        return count($idCount);
    }

    public function oneTrack($id)
    {
        $track_data = DB::table('transactions_history')
        ->leftJoin('forms AS fom', 'fom.id', 'transactions_history.form_id')
        ->leftJoin('ints AS int', 'int.id', 'fom.int_id')
        ->leftJoin('admin_users', 'admin_users.id', 'transactions_history.user_id')
        ->leftJoin('form_status AS status', 'status.id', 'transactions_history.status_id')
        ->where('form_id', '=', $id)
        ->orderBy('transactions_history.updated_at', 'ASC')
        ->select('status.comment', 'transactions_history.updated_at', 'transactions_history.status_id', 'admin_users.username', 'int.name_ar')
        ->get();

        $pen_name = DB::table('forms_parent AS fp', 'fp.pen_id', 'pens.id')
        ->leftJoin('forms AS form', 'form.forms_parent_id', 'fp.id')
        ->leftJoin('ints', 'ints.id', 'form.int_id')
        ->leftJoin('pens AS pen', 'pen.id', 'fp.pen_id')
        ->Join('transactions_history', 'transactions_history.form_id', 'form.id')
        ->where('transactions_history.form_id', '=', $id)
        ->select('pen.name as pen_name')
        ->groupBy('transactions_history.form_id')
        ->get();

        $compact['pen_name'] = $pen_name;
        $compact['trackdata'] = $track_data;
        return $compact;
    }

    public function enhance($query)
    {
        return $query->leftJoin('forms_parent AS fp', 'fp.pen_id', 'pens.id')
            ->leftJoin('forms AS form', 'form.forms_parent_id', 'fp.id')
            ->leftJoin('ints', 'ints.id', 'form.int_id')
            ->leftJoin('form_submission AS fs', 'fs.pen_id', '=', DB::raw('pens.id AND fs.form_id = form.id'))
            ->leftJoin('form_submission_answers AS fsa', 'fsa.submission_id', 'fs.id')
            ->Join('transactions_history', 'transactions_history.form_id', 'form.id')
            ->select('form.id', 'ints.image', 'ints.name_ar', 'form.int_id', 'fp.pen_id', 'ints.parent', 'fsa.answer', 'transactions_history.form_id')
            ->groupBy('transactions_history.form_id')
            ->get();
    }

    public function getViewsTitles(Request $request)
    {
        $header_title                       = '';
        if ($request->details_id == 1) {
            $header_title                   = 'development_interventions.intervention-maintenance.first.title';
        } else if ($request->details_id == 2) {
            $header_title                   = 'development_interventions.intervention-rent.first.title';
        } else if ($request->details_id == 3) {
            $header_title                   = 'development_interventions.intervention-replace.first.title';
        } else if ($request->details_id == 4) {
            $header_title                   = 'development_interventions.intervention-vehcile-repair.first.title';
        } else if ($request->details_id == 5) {
            $header_title                   = 'development_interventions.intervention-transportation-support.first.title';
        } else if ($request->details_id == 6) {
            $header_title                   = 'development_interventions.intervention-vehcile-supply.first.title';
        } else if ($request->details_id == 7) {
            $header_title                   = 'development_interventions.intervention-debt.first.title';
        } else if ($request->details_id == 8) {
            $header_title                   = 'development_interventions.intervention-stumble-resechdule.first.title';
        } else if ($request->details_id == 9) {
            $header_title                   = 'development_interventions.intervention-supply-support.first.title';
        } else if ($request->details_id == 10) {
            $header_title                   = 'development_interventions.intervention-monthly-support.first.title';
        } else if ($request->details_id == 11) {
            $header_title                   = 'development_interventions.intervention-medicine.first.title';
        } else if ($request->details_id == 12) {
            $header_title                   = 'development_interventions.intervention-equipment.first.title';
        } else if ($request->details_id == 13) {
            $header_title                   = 'development_interventions.intervention-surgery.first.title';
        } else if ($request->details_id == 14) {
            $header_title                   = 'development_interventions.intervention-rehabilitation.first.title';
        } else if ($request->details_id == 15) {
            $header_title                   = 'development_interventions.intervention-health-travel.first.title';
        } else if ($request->details_id == 16) {
            $header_title                   = 'development_interventions.intervention-job.first.title';
        } else if ($request->details_id == 17) {
            $header_title                   = 'development_interventions.intervention-project.first.title';
        } else if ($request->details_id == 18) {
            $header_title                   = 'development_interventions.intervention-rehabilitation-program.first.title';
        } else if ($request->details_id == 19) {
            $header_title                   = 'development_interventions.intervention-social-protection.first.title';
        } else if ($request->details_id == 20) {
            $header_title                   = 'development_interventions.intervention-lifting-restriction-expenses.first.title';
        } else if ($request->details_id == 21) {
            $header_title                   = 'development_interventions.intervention-lifting-restriction.first.title';
        } else if ($request->details_id == 22) {
            $header_title                   = 'development_interventions.intervention-obtain-id.first.title';
        } else if ($request->details_id == 23) {
            $header_title                   = 'development_interventions.intervention-debt-resechdule.first.title';
        }

        $page_title                          = 'title.interventions';
        return ['page_title' => $page_title, 'header_title' => $header_title];
    }
}
