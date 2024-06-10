<?php

namespace app\Admin\Services;

use Illuminate\Support\Facades\DB;

class NavigationService
{
    protected  $CASES_SERVICE;
    protected  $COMMON_SERVICE;

    public function __construct()
    {
        $this->CASES_SERVICE             = app('App\Admin\Services\CasesService');
        $this->COMMON_SERVICE            = app('App\Admin\Services\CommonService');
    }

    public function getSubmittedCases()
    {
        return $this->CASES_SERVICE->getSubmittedCases();
    }

    public function getFilteredCases()
    {
        return DB::table('forms')
            ->select(
                'forms.id AS form_id'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->whereIn('forms.status', [3, 16, 17]);
    }

    public function getHanggedCases($get_status)
    {
        return $this->CASES_SERVICE->getUncompletedCasesByStatus($get_status)->groupBy('fp.id');
    }

    public function getCasesNo($get_status)
    {
        return DB::table('forms')->select('forms.id')->whereIn('status', $get_status);
    }

    public function getApproveCases()
    {
        return $this->CASES_SERVICE->getApprovedCases();
    }

    public function getApproveRejectCases($get_status)
    {
        return DB::table('forms')
            ->select(
                'int_questions.int_id'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_submission', 'forms.id', 'form_submission.form_id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'int_questions.int_id')
            ->where('int_questions.summable', '1')
            ->whereIn('forms.status', $get_status);
    }

    public function getNotCompletedCase()
    {
        return $this->COMMON_SERVICE->getNotCompletedCases();
    }
}
