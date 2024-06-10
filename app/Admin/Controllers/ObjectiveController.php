<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrphanAnswer;
use App\Models\Objective;

class ObjectiveController extends Controller
{
    protected  $ORPHANS_SERVICE;

    public function __construct()
    {
        $this->ORPHANS_SERVICE      = app('App\Admin\Services\OrphansService');
    }

    public function delete(Request $request)
    {
        if (OrphanAnswer::where('objective_id', $request->id)->exists()) {
            return back()->with('error', trans('orphan.objective_cannot_be_deleted'));
        } else {
            $objective = Objective::findOrfail($request->id);
            if ($objective->delete()) {
                return back()->with('success', trans('orphan.objective_deleted_successfuly'));
            }
        }
    }

    public function edit(Request $request)
    {
        return Objective::findOrfail($request->id);
    }

    public function index(Request $request)
    {
        $cases = Objective::with(['getOrphanRelatedObjectvies', 'getOrphanExtra'])->where('path_id', $this->ORPHANS_SERVICE->getCurrentPathid())->paginate($request->input('count') ?? '10');
        $compact                             = [];
        $objectives = Objective::with(['getOrphanRelatedObjectvies', 'getOrphanExtra'])->where('path_id', $this->ORPHANS_SERVICE->getCurrentPathid())->latest()->get();

        $current_url                           = url('admin/' . Admin::user()->roles[0]->slug . '/objectives');
        $compact                               = [
            'cases'                            => $cases,
            'path_title'                       => $this->ORPHANS_SERVICE->getCurrentPathTitle(),
            'objectives'                       => $objectives,
            'current_url'                      => $current_url,
            'page_title'                       => trans('orphan.objectives_menu'),
            'header_title'                     => trans('orphan.objectives_menu')
        ];
        return view('tailAdmin.pages.objectives.index', $compact);
    }

    public function store(Request $request)
    {
        if ($request->title) {
            $form_id = isset($request->form_id) ? $request->form_id : NULL;
            $active =  isset($request->active) ? $request->active : '0';

            $insertion = Objective::insert(
                [
                    'title' => $request->title,
                    'form_id' => $form_id,
                    'active' => $active,
                    'path_id' => $this->ORPHANS_SERVICE->getCurrentPathid(),
                    'created_at' => Carbon::now()
                ]
            );
            if ($insertion) {
                return back()->with('success', trans('orphan.objective_added_successfuly'));
            }
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }

    public function update(Request $request)
    {
        if ($request->title) {
            $active =  isset($request->active) ? $request->active : '0';
            if (empty($active) && OrphanAnswer::where('objective_id', $request->id)->exists()) {
                return back()->with('error', trans('orphan.objective_cannot_be_disabled'));
            }

            $update = Objective::where('id', $request->id)->where('path_id', $this->ORPHANS_SERVICE->getCurrentPathid())->update(['title' => $request->title, 'active' => $active]);
            if ($update) {
                return back()->with('success', trans('orphan.saved_successfuly'));
            }
        } else {
            return back()->with('error', 'error');
        }
    }
}
