<?php

namespace app\Admin\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;
use App\Models\Provider;
use Carbon\Carbon;

class CasesService
{
    public function getExcludedPenIds()
    {
        $excluded_pen_ids = [];
        $input_related_ints_raw = DB::table('input_related_ints')->select('int_id')->get();
        $input_related_ints = [];
        foreach ($input_related_ints_raw as $one) {
            $input_related_ints[] = $one->int_id;
        }

        $compilation = DB::table('forms')
            ->select(DB::raw('COUNT(forms.id) as count_forms'), DB::raw('COUNT(form_submission.id) as count_submissions'), 'fp.pen_id')
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_submission', 'form_submission.form_id', '=', DB::raw('forms.id AND forms.status = 2'))
            ->whereIn('forms.int_id', $input_related_ints)
            ->groupBy('fp.pen_id')
            ->get();

        foreach ($compilation as $one) {
            if ($one->count_submissions != $one->count_forms) {
                $excluded_pen_ids[] = $one->pen_id;
            }
        }

        return $excluded_pen_ids;
    }

    public function getTransferredCases() // الحالات المحوله
    {
        return DB::table('forms')
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->select('forms.id')
            ->whereIn('status', ['4', '7'])->get();
    }

    public function getUncompletedCasesByStatus($get_status)
    {
        /* OLD one
                return DB::table('forms')
            ->select(
                'forms.int_id as int_id',
                'ints.name_short AS name',
                'ints.image',
                DB::raw('0 AS sum'),
                DB::raw('COUNT(ints.name_short) AS count'),
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->whereIn('forms.status', $get_status);
            */
        return DB::table('forms')
            ->select(
                'forms.int_id as int_id',
                'ints.name_short AS name',
                'ints.image',
                DB::raw('SUM(form_submission_answers.answer) AS sum'),
                DB::raw('COUNT(form_submission_answers.answer) AS count'),
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_submission', 'forms.id', 'form_submission.form_id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'int_questions.int_id')
            ->where('int_questions.summable', '1')
            ->whereIn('forms.status', $get_status)
            ->groupBy('int_questions.int_id');
    }

    public function getCasesByStatus($get_status)
    {
        return DB::table('forms')
            ->select(
                'int_questions.int_id',
                'ints.name_short AS name',
                'ints.image',
                DB::raw('SUM(form_submission_answers.answer) AS sum'),
                DB::raw('COUNT(form_submission_answers.answer) AS count'),
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_submission', 'forms.id', 'form_submission.form_id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'int_questions.int_id')
            ->where('int_questions.summable', '1')
            ->whereIn('forms.status', $get_status)
            ->groupBy('int_questions.int_id');
    }

    public function getApprovedCases()
    {
        return DB::table('forms')
            ->select(
                'int_questions.int_id',
                'ints.name_short AS name',
                'ints.image',
                DB::raw('SUM(form_submission_answers.answer) AS sum'),
                DB::raw('COUNT(form_submission_answers.answer) AS count'),
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_submission', 'forms.id', 'form_submission.form_id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'int_questions.int_id')
            ->leftJoin('transactions_history as th', 'th.form_id', 'forms.id')
            ->where('int_questions.summable', '1')
            ->where('th.status_id', '13')
            ->groupBy('int_questions.int_id')
            ->get();
    }

    public function getSubmittedCases($filter = null)
    {
        // Rule 1:: show cases if it has reactivated_to DB Field record and reactivated_to (Date is Gone)
        // Example :: If reactivated_to (Date) is 14/4/2022 and Today is 15/4/2022
        // so this case will be listed

        // Rule 2 :: show normal cases with it's interventions
        $excluded_pen_ids = $this->getExcludedPenIds();
        $normalFamilyCase = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'pens.name AS name',
                'pens.id AS pen_id',
                'fp.updated_at AS updated',
                'pens.personal_id'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->where('forms.status', '=', '2')
            ->whereNotIn('fp.pen_id', $excluded_pen_ids)->groupBy('pens.id');

        $extendedFamilyCase = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'pens.name AS name',
                'pens.id AS pen_id',
                'fp.updated_at AS updated',
                'pens.personal_id'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('reactivated_urls', 'reactivated_urls.pen_id', 'pens.id')
            ->where('forms.status', '=', '2')
            ->whereNotNull('reactivated_urls.reactivated_to')
            ->where('reactivated_urls.reactivated_to', '<', Carbon::now()->toDateTimeString())->groupBy('pens.id');



        if ($filter && $filter->input('filter') == 'filter') {
            switch (true) {
                case ($filter->input('personal_id') != null):
                    $normalFamilyCase->where('pens.personal_id', '=', $filter->input('personal_id'));
                    $extendedFamilyCase->where('pens.personal_id', '=', $filter->input('personal_id'));
                    break;
                case ($filter->input('name') != null):
                    $normalFamilyCase->where('pens.name', 'like', '%' . $filter->input('name') . '%');
                    $extendedFamilyCase->where('pens.name', 'like', '%' . $filter->input('name') . '%');
                    break;
                case ($filter->input('breadwinner_gender') != null):
                    $normalFamilyCase->where('fp.breadwinner_gender', '=', $filter->input('breadwinner_gender'));
                    $extendedFamilyCase->where('fp.breadwinner_gender', '=', $filter->input('breadwinner_gender'));
                    break;
                case ($filter->input('breadwinner_social_status') != null):
                    $normalFamilyCase->where('fp.breadwinner_social_status', '=', $filter->input('breadwinner_social_status'));
                    $extendedFamilyCase->where('fp.breadwinner_social_status', '=', $filter->input('breadwinner_social_status'));
                    break;
                case ($filter->input('family_count') != null):
                    $normalFamilyCase->where('fp.family_count', '=', $filter->input('family_count'));
                    $extendedFamilyCase->where('fp.family_count', '=', $filter->input('family_count'));
                    break;
                case ($filter->input('disabled') != null):
                    $normalFamilyCase->where('fp.disabled', '=', $filter->input('disabled'));
                    $extendedFamilyCase->where('fp.disabled', '=', $filter->input('disabled'));
                    break;
                case ($filter->input('able_to_work') != null):
                    $normalFamilyCase->where('fp.able_to_work', '=', $filter->input('able_to_work'));
                    $extendedFamilyCase->where('fp.able_to_work', '=', $filter->input('able_to_work'));
                    break;
            }
        }


        return $extendedFamilyCase->unionAll($normalFamilyCase);
    }

    public function getSubmittedCasesCount()
    {
        return count($this->getSubmittedCases()->get());
    }

    public function getFilteredCases() // الحالات المفروزة
    {
        return DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->where('forms.status', '=', '3')
            ->groupBy('pens.id');
    }


    public function getFilteredCasesWithAnswersByIntIdApprovedRejected(Request $request, $int_id = NULL, $get_status = [])
    {

        if (empty($get_status)) {
            $get_status = app('App\Admin\Services\CommonService')->extractUrlStatus($request);
        }

        return DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'forms.status AS status_id',
                'form_status.name_en AS status_name',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
                'form_submission_answers.question_id',
                'form_submission_answers.answer',
                'int_questions.question_type',
                'int_parent.name_en as intervention_name',
                'ints.name_short as intervention__detail_name',
                'form_hang.reason',
                'form_hang.notes',
                'fpv.provider_id',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_providers AS fpv', 'fpv.form_id', 'forms.id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('form_submission', 'form_submission.form_id', 'forms.id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('form_status', 'form_status.id', 'forms.status')
            ->leftJoin('form_hang', 'form_hang.form_id', 'forms.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->leftJoin('int_parent', 'int_parent.id', 'ints.parent')
            ->leftJoin('transactions_history as th', 'th.form_id', 'forms.id')
            ->whereIn('th.status_id', $get_status)
            ->where('forms.int_id', $int_id)
            ->groupBy('forms.id');
    }

    public function getFilteredCasesWithAnswersByIntId(Request $request, $int_id = NULL, $get_status = [])
    {
        if (empty($get_status)) {
            $get_status = app('App\Admin\Services\CommonService')->extractUrlStatus($request);
        }

        return DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'forms.status AS status_id',
                'form_status.name_en AS status_name',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
                'form_submission_answers.question_id',
                'form_submission_answers.answer',
                'int_questions.question_type',
                'int_parent.name_en as intervention_name',
                'ints.name_short as intervention__detail_name',
                'form_hang.reason',
                'form_hang.notes',
                'fpv.provider_id',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('form_providers AS fpv', 'fpv.form_id', 'forms.id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('form_submission', 'form_submission.form_id', 'forms.id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('form_status', 'form_status.id', 'forms.status')
            ->leftJoin('form_hang', 'form_hang.form_id', 'forms.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->leftJoin('int_parent', 'int_parent.id', 'ints.parent')
            ->whereIn('forms.status', $get_status)
            ->where('forms.int_id', $int_id)
            ->groupBy('forms.id');
    }

    public function getFilteredCasesWithAnswersByIntId_Export(Request $request, $int_id = NULL, $get_status = [])
    {
        if (empty($get_status)) {
            $get_status = app('App\Admin\Services\CommonService')->extractUrlStatus($request);
        }

        $ids = (explode(',', $request->ids));
        return DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'forms.status AS status_id',
                'form_status.name_en AS status_name',
                'pens.name AS name',
                'pens.id AS pen_id',
                'pens.personal_id',
                'form_submission_answers.question_id',
                'form_submission_answers.answer',
                'int_questions.question_type',
                'int_parent.name_en as intervention_name',
                'ints.name_short as intervention__detail_name',
                'form_hang.reason',
                'form_hang.notes',
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('form_submission', 'form_submission.form_id', 'forms.id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('form_status', 'form_status.id', 'forms.status')
            ->leftJoin('form_hang', 'form_hang.form_id', 'forms.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->leftJoin('int_parent', 'int_parent.id', 'ints.parent')
            ->whereIn('forms.status', $get_status)
            ->where('forms.int_id', $int_id)
            ->whereIn('forms.id', $ids)
            ->groupBy('forms.id');
    }

    public function getCasesAnswersFromObject($cases)
    {
        $form_ids = [];
        foreach ($cases as $case) {
            $form_ids[] = $case->form_id;
        }

        $answers = [];
        $answers_raw = DB::table('form_submission_answers')
            ->leftJoin('form_submission', 'form_submission.id', 'form_submission_answers.submission_id')
            ->whereIn('form_submission.form_id', $form_ids)
            ->get();

        foreach ($answers_raw as $one_answer) {
            $answers[$one_answer->form_id][$one_answer->question_id] = $one_answer->answer;
        }
        return $answers;
    }

    public function getImgesCases($form_id)
    {
        $answers = [];
        $answers_raw = DB::table('form_submission_answers')
            ->leftJoin('form_submission', 'form_submission.id', 'form_submission_answers.submission_id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->where('form_submission.form_id', '=', $form_id)
            ->where('int_questions.question_type', 'file')
            ->get();

        foreach ($answers_raw as $one_answer) {
            $answers[] = $one_answer->answer;
        }
        return $answers;
    }

    public function getSelectedInts(Request $request)
    {
        // All cases related to the selected $request->details_id intervention details
        $already_transfered_ids_raw = DB::table('form_role')->select('form_id')->where('details_id', '=', $request->details_id)->groupBy('form_id')->get();
        $already_transfered_ids = [];
        foreach ($already_transfered_ids_raw as $one) {
            $already_transfered_ids[] = $one->form_id;
        }

        return $already_transfered_ids;
    }

    public function getInts(Request $request)
    {
        return DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.pen_id AS user_id',
                'pens.name',
                'fp.family_count',
                'fp.able_to_work',
                'fp.need',
                'fp.development',
                'forms.created_at',
            )
            ->leftJoin('pens', 'fp.pen_id', 'pens.id')
            ->leftJoin('form_required_details', 'form_required_details.form_id', 'forms.id')
            ->leftJoin('answers', 'answers.form_id', 'forms.id')
            ->leftJoin('form_role', 'form_role.form_id', 'forms.id')
            ->where('answers.intervention_details_id', '=', $request->details_id)
            ->where('forms.form_status', '=', '1')
            ->groupBy('forms.id');
    }

    public function getCasesAnswer(Request $request, $cases)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/ints/' . $request->details_id);
        if (! empty($cases)) {
            // Cases Answers as array (Generic Logic)
            $forms_ids_array = [];
            foreach ($cases as $one_case) {
                $forms_ids_array[] = $one_case->form_id;
            }

            $answers = [];
            $answers_raw = DB::table('answers')
                ->select(
                    'answers.id',
                    'answers.form_id',
                    'answers.question_id',
                    'answers.answer_type',
                    'answers.answer'
                )
                ->whereIn('answers.form_id', $forms_ids_array)
                ->get();
            if (! empty($answers_raw)) {
                foreach ($answers_raw as $one_answer) {
                    @$answers[$one_answer->form_id][$one_answer->question_id] = $one_answer->answer;
                }
            }
        }

        // Intervention detail all info
        $details_info = DB::table('interventions_details')
            ->select(
                'interventions_details.name_en AS name',
                'interventions.name_en AS intervention_name'
            )
            ->leftJoin('interventions', 'interventions.id', 'interventions_details.intervention_id')
            ->where('interventions_details.id', '=', $request->details_id)
            ->first();

        $columns_raw = DB::table('questions_block')->select('id', 'question_type', 'text_ar AS text')->where('intervention_details_id', '=', $request->details_id)->get();
        $columns = [];
        $colum_type_by_id = [];
        foreach ($columns_raw as $one) {
            $columns[$one->id] = $one->text;
            $colum_type_by_id[$one->id] = $one->question_type;
        }

        return ['details_id' => $request->details_id, 'colum_type_by_id' => $colum_type_by_id, 'answers' => $answers, 'columns' => $columns, 'cases' => $cases, 'current_url' => $current_url, 'details_info' => $details_info];
    }

    public function getSumAnswers()
    {
        return DB::table('answers')
            ->select(
                DB::raw('SUM(answer) as sum'),
                DB::raw('COUNT(answers.form_id) as count'),
                'answers.form_id',
                'answers.intervention_id',
                'answers.intervention_details_id',
                'interventions_details.name_en AS name',
                DB::raw('CONCAT(answers.form_id,"-",answers.intervention_details_id) as concat_id'),
            )
            ->leftJoin('questions_block', 'questions_block.id', 'answers.question_id')
            ->leftJoin('interventions_details', 'interventions_details.id', 'answers.intervention_details_id')
            ->leftJoin('forms', 'forms.id', 'answers.form_id')
            ->where('summable', '=', '1')
            ->where('forms.form_status', '=', '1')
            ->groupBy('concat_id')
            ->orderBy('interventions_details.id');
    }

    public function getSupportedCases($get_status)
    {
        return DB::table('forms')
            ->select(
                'int_questions.int_id',
                'ints.name_short AS name',
                'ints.image',
                DB::raw('SUM(form_submission_answers.answer) AS sum'),
                DB::raw('COUNT(form_submission_answers.answer) AS count'),
            )
            ->leftJoin('form_submission', 'forms.id', 'form_submission.form_id')
            ->leftJoin('form_submission_answers', 'form_submission_answers.submission_id', 'form_submission.id')
            ->leftJoin('int_questions', 'int_questions.id', 'form_submission_answers.question_id')
            ->leftJoin('ints', 'ints.id', 'int_questions.int_id')
            ->where('int_questions.summable', '1')
            ->whereIn('forms.status', $get_status);
    }

    public function getColumnsAnswers(Request $request)
    {
        $providers = Provider::get();
        $columns_raw = DB::table('int_questions')->where('int_id', '=', $request->details_id)->get();
        $colum_type_by_id = [];
        $columns = [];
        foreach ($columns_raw as $one) {
            $colum_type_by_id[$one->id] = $one->question_type;
            $columns[$one->id] = $one->name_en;
        }

        return ['colum_type_by_id' => $colum_type_by_id, 'columns' => $columns, 'providers' => $providers];
    }
}