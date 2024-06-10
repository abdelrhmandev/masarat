<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Orphan;
use App\Models\OrphanAnswer;
use App\Models\Path;
use App\Models\OrphanAgeEquivalentDegree;
use App\Models\Stage;

class DevelopmentController extends Controller
{
    protected $CASES_SERVICE;
    protected $COMMON_SERVICE;
    protected $NAVIGATION_SERVICE;
    protected $ORPHANS_SERVICE;

    public function __construct()
    {
        $this->CASES_SERVICE = app('App\Admin\Services\CasesService');
        $this->COMMON_SERVICE = app('App\Admin\Services\CommonService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
        $this->ORPHANS_SERVICE = app('App\Admin\Services\OrphansService');
    }

    public function index()
    {
        $submittedCaseCount = $this->NAVIGATION_SERVICE->getSubmittedCases()->count();
        $transferedCaseCount = $this->CASES_SERVICE->getTransferredCases()->count();
        $supportedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([6])->count();
        $awaitExecuteCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([14])->count();
        $executedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([8])->count();
        $returnedCaseCount = $this->NAVIGATION_SERVICE->getCasesNo([12])->count();
        $notCompletedCaseCount = $this->NAVIGATION_SERVICE->getNotCompletedCase();
        $filteredCaseCount = $this->NAVIGATION_SERVICE->getFilteredCases()->count();

        // START Chart Calculation
        $executedCases_ratio = 0;
        $transferedCaseCount_ratio = 0;
        $waitExecuteCaseCount_ratio = 0;
        $notCompletedCaseCount_ratio = 0;
        $submittedCaseCount_ratio = 0;
        if ($filteredCaseCount > 0) {
            $transferedCaseCount_ratio = round(($transferedCaseCount / $filteredCaseCount), 2) * 100;
        }
        $filteredCaseCount_ratio = 100 - $transferedCaseCount_ratio;

        $total_completedcases_submitted_cases = $notCompletedCaseCount + $submittedCaseCount;
        if ($total_completedcases_submitted_cases > 0) {
            $notCompletedCaseCount_ratio = round(($notCompletedCaseCount / $total_completedcases_submitted_cases), 2) * 100;
            $submittedCaseCount_ratio = ($submittedCaseCount / $total_completedcases_submitted_cases) * 100;
        }

        $totalTransfered = $executedCaseCount + $awaitExecuteCaseCount;
        if ($totalTransfered > 0) {
            $executedCases_ratio = round($executedCaseCount / $totalTransfered, 2) * 100;
            $waitExecuteCaseCount_ratio = round($awaitExecuteCaseCount / $totalTransfered, 2) * 100;
        }
        // END Chart Calculation

        $compact = [
            'submittedCaseCount' => $submittedCaseCount,
            'transferedCaseCount' => $transferedCaseCount,
            'supportedCaseCount' => $supportedCaseCount,
            'returnedCaseCount' => $returnedCaseCount,
            'notCompletedCaseCount' => $notCompletedCaseCount,
            'filteredCaseCount_ratio' => $filteredCaseCount_ratio,
            'notCompletedCaseCount_ratio' => $notCompletedCaseCount_ratio,
            'submittedCaseCount_ratio' => $submittedCaseCount_ratio,
            'transferedCaseCount_ratio' => $transferedCaseCount_ratio,
            'executedCases_ratio' => $executedCases_ratio,
            'waitExecuteCaseCount_ratio' => $waitExecuteCaseCount_ratio,
        ];

        return view('tailAdmin.pages.development.dashboard', $compact);
    }

    public function transferCase(Request $request)
    {
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/transferCase');
        $cases = $this->CASES_SERVICE->getSubmittedCases($request)->orderBy('need', 'desc')->orderBy('updated', 'asc')->paginate($request->input('count') ?? '10');
        $family_count_options = [];
        for ($i = 1; $i <= 50; $i++) {
            $family_count_options[$i] = $i;
        }
        $need_options = [];
        for ($i = 1; $i <= 100; $i++) {
            $need_options[$i] = $i;
        }

        $genderOptions = ['ذكر', 'أنثى'];
        $socialStatusOptions = ['مزوج', 'أعزب', 'مطلق', 'أرمل'];
        $disabledOptions = ['يوجد', 'لا يوجد'];
        $filters = [
            'personal_id' => ['type' => 'id', 'width' => '10', 'label' => trans('development_interventions.intervention-maintenance.second.id')],
            'name' => ['type' => 'text', 'width' => '25', 'label' => trans('development_interventions.intervention-maintenance.second.individual')],
            'breadwinner_gender' => ['type' => 'dropdown', 'width' => '4', 'options' => $genderOptions, 'label' => trans('development_transferCase.first.breadwinnerGender')],
            'breadwinner_social_status' => ['type' => 'dropdown', 'width' => '4', 'options' => $socialStatusOptions, 'label' => trans('development_transferCase.first.breadwinnerSocialStatus')],
            'family_count' => ['type' => 'dropdown', 'width' => '5', 'options' => $family_count_options, 'label' => trans('development_transferCase.first.family-count')],
            'disabled' => ['type' => 'dropdown', 'width' => '10', 'options' => $disabledOptions, 'label' => trans('development_transferCase.first.disabled')],
            'able_to_work' => ['type' => 'dropdown', 'width' => '5', 'options' => $family_count_options, 'label' => trans('development_transferCase.first.workable')],
        ];
        $compact = ['cases' => $cases, 'current_url' => $current_url, 'filters' => $filters, 'request' => $request->all()];

        return view('tailAdmin.pages.development.transferCase', $compact);
    }

    public function doTransfer(Request $request)
    {
        if (! empty($request->input('ids')) && is_array($request->input('ids'))) {
            // Set submitted IDs as selected
            $pen_form_ids = DB::table('forms')
                ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
                ->select('forms.id')
                ->whereIn('fp.pen_id', $request->input('ids'))
                ->get();

            $ids = [];
            foreach ($pen_form_ids as $one) {
                $ids[] = $one->id;
            }

            $hangIds = DB::table('forms')->select('forms.id')
                ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
                ->where('forms.status', '=', 1)
                ->whereIn('fp.pen_id', $request->input('ids'))->get();

            foreach ($hangIds as $one) {
                $hang_forms_insertions = [
                    'form_id' => $one->id,
                    'reason' => trans('development_transferCase.second.individual'),
                    'notes' => trans('development_transferCase.second.becauseofindi'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                DB::table('form_hang')->insert($hang_forms_insertions);
            }

            // 2 -> Moved to the filtered cases
            DB::table('forms')->whereIn('id', $ids)->update(['status' => '3']);
            foreach ($ids as $logid) {
                $loginsertions[] = ['user_id' => Admin::user()->id, 'form_id' => $logid, 'status_id' => '3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            }

            DB::table('transactions_history')->insert($loginsertions);
            return back()->with('success', trans('messages.success.filter'));
        }

        return back()->with('error', trans('messages.error.no-one-chosen-transfer'));
    }

    public function ints(Request $request)
    {
        $already_transfered_ids = $this->CASES_SERVICE->getSelectedInts($request);
        $cases = $this->CASES_SERVICE->getInts($request)->whereNotIn('forms.id', $already_transfered_ids)->paginate($request->input('count') ?? '10');
        return view('tailAdmin.pages.intervention.interventionDetails', $this->CASES_SERVICE->getCasesAnswer($request, $cases));
    }

    public function reactiveUrl(Request $request)
    {
        $reactivated_from = DB::table('pens')->where('personal_id', '=', $request->post('personal_id'))->get();
        $reactivated_to = Carbon::now()->addDays((int) $request->post('reactiveDate'));
        if (! empty($request->post('personal_id'))) {
            DB::table('pens')->where('personal_id', '=', $request->post('personal_id'))->update([
                'updated_at' => $reactivated_to
            ]);

            $pen_query = DB::table('pens')->where('personal_id', $request->post('personal_id'))->first();
            $pen_id = $pen_query->id;
            $insertions = [
                [
                    'pen_id' => $pen_id,
                    'reactivated_from' => $reactivated_from[0]->updated_at,
                    'reactivated_to' => $reactivated_to
                ],
            ];

            DB::table('reactivated_urls')->insert($insertions);
            return back()->with('success', 'url has been activated successfully');
        }

        return back()->with('error', 'none');
    }

    public function intsTransfer(Request $request)
    {
        if (! empty($request->input('ids'))) {
            $ids = explode(',', $request->post('ids'));
            $form_status_id = 4;
            if ($request->post('role') == '7') {
                $form_status_id = 7;
            }
            if ($request->post('role') == '5') {
                $form_status_id = 5;
            }
            if ($request->post('role') == '8') {
                $form_status_id = 8;
            }
            if ($request->post('role') == '13') {
                $form_status_id = 13;
            }

            $transfer = DB::table('forms')
                ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')->whereIn('forms.id', $ids)
                ->update(['forms.status' => $form_status_id, 'forms.updated_at' => date('Y-m-d H:i:s')]);
            if ($transfer) {
                // Get forms attached to providers in order to generate reference number to only forms that's attached
                $ids_attached = [];
                $attached = DB::table('form_providers')->select('form_id')->groupBy('form_id')->whereIn('form_id', $ids)->get();
                foreach ($attached as $one_attached) {
                    $ids_attached[] = $one_attached->form_id;
                }
                // Generate reference number for each form separately
                if ($request->post('role') == '7') {
                    $approved_forms_insertions = [];
                    foreach ($ids as $one_id) {
                        if (in_array($one_id, $ids_attached)) {
                            $reference_number = $this->COMMON_SERVICE->generateReferenceNumber();
                            $approved_forms_insertions[] = [
                                'form_id' => $one_id,
                                'reference_number' => $reference_number,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ];
                            DB::table('form_approved')->insert($approved_forms_insertions);
                        }
                    }
                }
                return back()->with('success', trans('interventions.cases.trasfered.to.role'));
            }
        }
        return back()->with('error', trans('messages.error.no-one-chosen-approve'));
    }

    public function intsRejectTransfer(Request $request)
    {
        $form_id = $request->input('form_id');
        if (! empty($form_id)) {
            $form_status_id = 11;
            $transfer = DB::table('forms')
                ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
                ->where('forms.id', '=', $request->input('form_id'))
                ->update(['forms.status' => $form_status_id, 'forms.updated_at' => date('Y-m-d H:i:s')]);
            if ($transfer) {
                $rejected_forms_insertions = [];
                $rejected_forms_insertions[] = [
                    'form_id' => $form_id,
                    'reason' => $request->input('reject_notes'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('form_rejected')->insert($rejected_forms_insertions);
                return back()->with('success', trans('interventions.cases.trasfered.to.role'));
            }
        }
        return back()->with('error', trans('messages.error.no-one-chosen-approve'));
    }

    public function trackIntsExecution()
    {
        return view('tailAdmin.pages.development.trackIntsExecution.tracking');
    }

    public function tracking(Request $request)
    {
        $compact = [];
        $cases = DB::table('pens')->where('pens.personal_id', '=', $request->id);
        $cases = $this->COMMON_SERVICE->enhance($cases);
        if ($cases->count() == 0) {
            return back()->with('error', trans('messages.error.id-not-foundtrack'));
        }

        $compact['cases'] = $cases;
        return view('tailAdmin.pages.development.trackIntsExecution.ints', $compact);
    }

    public function oneTrack($id)
    {
        return view('tailAdmin.pages.development.trackIntsExecution.oneTracking', $this->COMMON_SERVICE->oneTrack($id));
    }

    /////////////////////////// Development Account handle Orpahns Case /////////
    public function loadorphans()
    {
        if ($this->ORPHANS_SERVICE->loadOrphans()) {
            return back()->with('success', trans('orphan.orphan_loaded_successfuly'));
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }

    public function orphans(Request $request)
    {
        $orphans = Orphan::select('pen_id', 'form_id')->with('getOrphanPen', 'getOrphanExtra')->whereDoesntHave('getOrphanAgeEquivalentDegree');
        $counter = $orphans->count();
        $cases = $orphans->paginate($request->input('count') ?? '10');
        $compact = [];
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/orphans');
        $current_stage_id = $this->ORPHANS_SERVICE->getCurrentStage()->first()->id ?? 0;
        $compact = [
            'cases' => $cases,
            'new_orphans_counter' => $this->ORPHANS_SERVICE->NewOrphans()->count(),
            'orphans' => $orphans,
            'counter' => $counter,
            'current_url' => $current_url,
            'current_stage_id' => $current_stage_id,
            'page_title' => trans('orphan.interventions_menu'),
            'header_title' => trans('orphan.interventions_menu')
        ];

        return view('tailAdmin.pages.development.orphans', $compact);
    }

    public function submit_orphan_age_equivalent_degree(Request $request)
    {
        if ($request->form_id && $request->orphan_age_equivalent_degree) {
            $insertion = OrphanAgeEquivalentDegree::insert(
                [
                    'stage_id' => $this->ORPHANS_SERVICE->getCurrentStage()->first()->id,
                    'form_id' => $request->form_id,
                    'value' => $request->orphan_age_equivalent_degree,
                    'created_at' => Carbon::now()
                ]
            );
            if ($insertion) {
                return back()->with('success', trans('orphan.age_equivalent_degree_added_successfuly'));
            }
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }

    // Handle Orphans history  Step (1)
    public function orphan_history_stages()
    {
        $stages = Stage::get();
        $compact = [
            'stages' => $stages,
            'page_title' => trans('orphan.history_records'),
            'header_title' => trans('orphan.history_records')
        ];
        return view('tailAdmin.pages.development.history-records-stages', $compact);
    }

    // Handle Orphans history Step (2)
    public function orphan_history_orphans(Request $request, $stage_id)
    {
        $orphans = Orphan::withCount([
            'answers' => function ($query) use ($stage_id) {
                $query->where('stage_id', $stage_id);
            }
        ]);
        $cases = $orphans->paginate($request->input('count') ?? '10');
        $counter = $orphans->count();
        $compact = [];
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/orphans/HistoryRecords/Orphans/Stage/' . $stage_id);
        $compact = [
            'cases' => $cases,
            'new_orphans_counter' => $this->ORPHANS_SERVICE->NewOrphans()->count(),
            'orphans' => $orphans->get(),
            'counter' => $counter,
            'current_url' => $current_url,
            'stage_id' => $stage_id,
            'page_title' => trans('orphan.interventions_menu'),
            'header_title' => trans('orphan.interventions_menu')
        ];
        return view('tailAdmin.pages.development.history-records-orphans', $compact);
    }

    public function orphan_history_orphan_pathes(Request $request, $stage_id, $form_id)
    {
        $pathes = Path::latest();
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/orphan/HistoryOrphan/' . $stage_id . '/' . $form_id);
        $compact = [
            'pathes' => $pathes->get(),
            'current_url' => $current_url,
            'cases' => $pathes->paginate($request->input('count') ?? '10'),
            'form_id' => $form_id,
            'stage_id' => $stage_id,
            'stage' => Stage::findOrfail($stage_id),
            'path_title' => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'page_title' => trans('orphan.orphan_history_records'),
            'header_title' => trans('orphan.pathes')
        ];
        return view('tailAdmin.pages.development.history-records-orphan-pathes', $compact);
    }

    public function orphan_history_orphan_details(Request $request, $stage_id, $form_id, $path_id)
    {
        $answers = OrphanAnswer::where(['form_id' => $form_id, 'stage_id' => $stage_id])->with('getObjective')
            ->whereHas('getObjective', function ($q) use ($stage_id, $path_id) {
                $q->where('stage_id', $stage_id);
                $q->where('path_id', $path_id);
            });

        $compact = [

            'answers' => $answers->get(),
            'form_id' => $form_id,
            'stage_id' => $stage_id,
            'page_title' => trans('orphan.orphan_history_records'),
            'header_title' => trans('orphan.pathes')
        ];
        return view('tailAdmin.pages.development.history-records-orphan-details', $compact);
    }
}