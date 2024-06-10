<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Stage;

class StageController extends Controller
{
    public function index(Request $request)
    {
        $cases = Stage::paginate($request->input('count') ?? '10');
        $compact                             = [];
        $stages = Stage::get();
        $current_url                           = url('admin/' . Admin::user()->roles[0]->slug . '/stages');
        $compact                               = [
            'cases'                            => $cases,
            'stages'                           => $stages,
            'current_url'                      => $current_url,
            'page_title'                       => trans('orphan.stages'),
            'header_title'                     => trans('orphan.stages')
        ];

        return view('tailAdmin.pages.stages.index', $compact);
    }

    public function edit(Request $request)
    {
        return Stage::findOrfail($request->id);
    }

    public function update(Request $request)
    {
        if ($request->title && $request->start_date && $request->end_date) {
            $active =  isset($request->active) ? $request->active : 0;
            if ($active == 1 && Stage::where('active', 1)->where('id', $request->id)->count() <> 1 && Stage::where('active', 1)->count()) {
                return back()->with('error', trans('orphan.only_one_stage_active'));
            }
            if ($active == 1 && Stage::where('first_active', 1)->where('id', $request->id)->count() == 1) {
                return back()->with('error', trans('orphan.unable_active_stage'));
            }
            $update = Stage::where('id', $request->id)->update(['title' => $request->title, 'active' => $active, 'start_date' => $request->start_date, 'end_date' => $request->end_date]);
            if ($update) {
                return back()->with('success', trans('orphan.saved_successfuly'));
            }
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }

    public function store(Request $request)
    {
        if ($request->title && $request->start_date && $request->end_date) {
            $active =  isset($request->active) ? $request->active : 0;
            if ($active == 1 && Stage::where('active', 1)->count() == 1) {
                return back()->with('error', trans('orphan.only_one_stage_active'));
            }

            $first_active = $active == 1 ? 1 : 0;
            $insertion = Stage::insert(
                [
                    'first_active' => $first_active,
                    'title' => $request->title,
                    'active' => $active,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'created_at' => Carbon::now()
                ]
            );
            if ($insertion) {
                return back()->with('success', trans('orphan.stage_addded_successfuly'));
            }
        } else {
            return back()->with('error', trans('orphan.error'));
        }
    }
}
