<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Models\Orphan;
use App\Models\Stage;
use App\Models\OrphanAnswer;

class OrphanHistoryController extends Controller
{
    protected  $ORPHANS_SERVICE;

    public function __construct()
    {
        $this->ORPHANS_SERVICE      = app('App\Admin\Services\OrphansService');
    }

    public function index()
    {
        $stages                               = Stage::get();
        $compact                               = [
            'stages'                           => $stages,
            'page_title'                       => trans('orphan.history_records'),
            'header_title'                     => trans('orphan.history_records')
        ];
        return view('tailAdmin.pages.orphans.history-records-stages', $compact);
    }

    public function orphans(Request $request, $stage_id)
    {
        $orphans = Orphan::with('getOrphanExtra', 'getOrphanPen');
        $cases = $orphans->paginate($request->input('count') ?? '10');
        $counter = $orphans->count();
        $compact                             = [];
        $current_url                           = url('admin/' . Admin::user()->roles[0]->slug . '/orphans/HistoryRecords/Orphans/' . $stage_id);
        $compact                               = [
            'cases'                            => $cases,
            'new_orphans_counter'              => $this->ORPHANS_SERVICE->NewOrphans()->count(),
            'orphans'                          => $orphans->get(),
            'counter'                          => $counter,
            'current_url'                      => $current_url,
            'stage_id'                         => $stage_id,
            'page_title'                       => trans('orphan.interventions_menu'),
            'header_title'                     => trans('orphan.interventions_menu')
        ];
        return view('tailAdmin.pages.orphans.history-records-orphans', $compact);
    }

    public function orphan($stage_id, $form_id)
    {
        $orphan = Orphan::where('form_id', '=', $form_id)->with('getOrphanPathCategory', 'getOrphanAgeEquivalentDegree')
            ->whereHas('getOrphanPathCategory', function ($q) use ($stage_id, $form_id) {
                $q->where('stage_id', $stage_id);
                $q->where('form_id', $form_id);
            })
            ->whereHas('getOrphanAgeEquivalentDegree', function ($q) use ($stage_id, $form_id) {
                $q->where('stage_id', $stage_id);
                $q->where('form_id', $form_id);
            })->first();

        $orphan_answers = OrphanAnswer::with('getObjective')->where('stage_id', $stage_id)->where('form_id', $form_id)->get();
        $orphan_info = Orphan::with('getOrphanExtra', 'getOrphanPen')->where('form_id', $form_id)->get();
        $compact                               = [
            'orphan_answers'                   => $orphan_answers,
            'orphan'                           => $orphan,
            'orphan_info'                      => $orphan_info,
            'stage'                            => Stage::findOrfail($stage_id),
            'path_title'                       => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'page_title'                       => trans('orphan.orphan_history_records'),
            'header_title'                     => trans('orphan.orphan_history_records')
        ];

        return view('tailAdmin.pages.orphans.history-records-orphan-details', $compact);
    }
}
