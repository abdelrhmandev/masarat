<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Orphan;
use App\Models\OrphanExtra;
use App\Models\OrphanPath;
use App\Models\OrphanAgeEquivalentDegree;
use App\Models\Objective;

class OrphanController extends Controller
{
    protected $ORPHANS_SERVICE;

    public function __construct()
    {
        $this->ORPHANS_SERVICE = app('App\Admin\Services\OrphansService');
    }

    public function dashboard()
    {
        $compact = [
            'path_title' => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'page_title' => trans('orphan.interventions_menu'),
            'header_title' => trans('orphan.interventions_menu')
        ];
        return view('tailAdmin.pages.orphans.dashboard', $compact);
    }

    public function index(Request $request)
    {
        $orphans = Orphan::has('getOrphanAgeEquivalentDegree')->with('getOrphanPathCategory', 'getOrphanExtra', 'getOrphanPen');
        $counter = $orphans->count();
        $cases = $orphans->paginate($request->input('count') ?? '10');
        $compact = [];
        $current_url = url('admin/' . Admin::user()->roles[0]->slug . '/orphans');
        $compact = [
            'cases' => $cases,
            'counter' => $counter,
            'new_orphans_counter' => $this->ORPHANS_SERVICE->NewOrphans()->count(),
            'orphans' => $orphans->get(),
            'current_url' => $current_url,
            'current_path_title' => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'current_stage_id' => $this->ORPHANS_SERVICE->getCurrentStage()->first()->id ?? 0,
            'page_title' => trans('orphan.interventions_menu'),
            'header_title' => trans('orphan.interventions_menu')
        ];
        return view('tailAdmin.pages.orphans.index', $compact);
    }

    public function details($form_id)
    {
        $compact = [];
        $current_stage_id = $this->ORPHANS_SERVICE->getCurrentStage()->first()->id ?? 0;
        $current_path_id = $this->ORPHANS_SERVICE->getCurrentPathid() ?? 0;
        $objectives = Objective::where(['active' => 1, 'path_id' => $current_path_id])
            ->whereNull('form_id')
            ->orWhere('form_id', $form_id)
            ->where('path_id', $current_path_id)
            ->with('getOrphanRelatedObjectvies')
            ->with(['getOrphanObjectiveAnswers' => function ($query) use ($form_id, $current_stage_id) {
                $query->where('stage_id', $current_stage_id);
                $query->where('form_id', $form_id);
            }])->latest()->get();

        $orphan_name = OrphanExtra::where('form_id', $form_id)->where('key', 'name')->value('value');
        //// check if objectives answers by this orphan in current path and current stage
        $compact = [
            'form_id' => $form_id,
            'current_path_title' => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'orphan_name' => $orphan_name,
            'objectives' => $objectives,
            'current_stage_id' => $current_stage_id,
            'page_title' => trans('orphan.objectives_menu'),
            'header_title' => trans('orphan.objectives_menu')
        ];

        return view('tailAdmin.pages.orphans.details', $compact);
    }

    public function submit_orphan_path_category(Request $request)
    {
        if ($request->form_id && $request->path_category) {
            $insertion = OrphanPath::insert(
                [
                    'stage_id' => $this->ORPHANS_SERVICE->getCurrentStage()->first()->id,
                    'form_id' => $request->form_id,
                    'path_id' => $this->ORPHANS_SERVICE->getCurrentPathid(),
                    'path_category' => $request->path_category,
                    'created_at' => Carbon::now()
                ]
            );
            if ($insertion) {
                return back()->with('success', trans('orphan.path_category_added_successfuly'));
            }
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }

    public function get_degree_history(Request $request)
    {
        $form_id = $request->id;
        $answers = [];
        $age = OrphanAgeEquivalentDegree::where('form_id', $form_id)->where('stage_id', $this->ORPHANS_SERVICE->getCurrentStage()->first()->id)->first();
        if (! empty($age)) {

            $created_at = \Carbon\Carbon::parse($age->created_at)->format('Y/m/d') . ' | ' . $age->created_at->diffForHumans();
            $answers[] =
                [
                    'value' => $age->value,
                    'created_at' => $created_at
                ];
        }
        return $answers;
    }

    public function submit_orphan_answers(Request $request)
    {
        $this->ORPHANS_SERVICE->getCurrentStage()->first()->id;
        $array = [];
        if (! (empty($request->objectives))) {
            foreach ($request->objectives as $k => $v) {
                if (! (empty($request->notes[$v])) || ! (empty($request->completed_case[$v]))) {
                    $array[$k] = [
                        'stage_id' => $this->ORPHANS_SERVICE->getCurrentStage()->first()->id,
                        'objective_id' => $v,
                        'form_id' => $request->form_id,
                        'notes' => $request->notes[$v],
                        'completed_case' => $request->completed_case[$v] ?? NULL,
                        'created_at' => Carbon::now()
                    ];
                }
            }
            $insertion = DB::table('orphan_answers')->insert($array);
            if (! (empty($array)) && $insertion) {
                return back()->with('success', trans('orphan.saved_successfuly'));
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    public function get_answers($form_id)
    {
        $compact = [];
        $path_id = $this->ORPHANS_SERVICE->getCurrentPathid();
        $answers = OrphanAnswer::with('getObjective')->where(function ($query) use ($form_id) {
            $query->where('form_id', $form_id);
        })->latest()->get();

        $objectives = Objective::doesnthave('getObjectiveAnswers')->where(function ($query) use ($path_id, $form_id) {
            $query->where('path_id', $path_id)
                ->orWhere('form_id', $form_id);
        })->latest()->get();

        $compact = [
            'form_id' => $form_id,
            'answers' => $answers,
            'objectives' => $objectives,
        ];
        return view('tailAdmin.pages.orphans.answers', $compact);
    }
}