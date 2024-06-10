<?php

namespace app\Admin\Services;

use Encore\Admin\Facades\Admin;
use App\Models\FormExtra;
use App\Models\OrphanPen;
use App\Models\Path;
use App\Models\Orphan;
use App\Models\OrphanExtra;
use App\Models\Stage;

class OrphansService
{
    public function NewOrphans()
    {
        $orphan_extra_form_ids = OrphanExtra::pluck('form_id')->toArray();
        return FormExtra::with('getPenInfo')->Where('int_id', 24)->groupBy('pen_id')->whereNotIn('form_id', $orphan_extra_form_ids);
    }

    public function loadOrphans()
    {
        $pens_ids = [];
        $orphan_pen_data_arr = [];
        $orphan_data_arr = [];
        $orphan_extra_arr = [];

        // INSERT ORPHAN PEN DATA    
        if ($this->NewOrphans()->count() > 0) {
            $pens_ids = [];
            $orphan_pen_data_arr = [];
            $orphan_data_arr = [];
            $orphan_extra_arr = [];

            // INSERT ORPHAN PEN DATA            
            foreach ($this->NewOrphans()->get() as $orphan_pen) {
                $pens_ids[] = $orphan_pen->pen_id;
                $orphan_pen_data_arr[] =
                    [
                        'pen_id'             => $orphan_pen->pen_id,
                        'personal_id'        => $orphan_pen->getPenInfo->personal_id,
                        'name'               => $orphan_pen->getPenInfo->name,
                        'mobile'             => $orphan_pen->getPenInfo->mobile,
                        'confirmation_code'  => $orphan_pen->getPenInfo->confirmation_code,
                        'created_at'         => $orphan_pen->created_at,
                    ];
            }

            // (1) Load Orphan Pens
            if (!OrphanPen::whereIn('pen_id', $pens_ids)->exists()) {
                OrphanPen::insert($orphan_pen_data_arr);
            }

            // (2) Load Orphans
            $orphans = FormExtra::where('int_id', 24)->whereIn('pen_id', $pens_ids)->groupBy('form_id')->get();
            foreach ($orphans as $orphan) {
                $orphan_data_arr[] = ([
                    'pen_id' => $orphan->pen_id,
                    'form_id' => $orphan->form_id,
                    'created_at' => $orphan->created_at,
                ]);
            }

            // (3) Load Orphans Extra Data
            $orphan_extra = FormExtra::Where('int_id', 24)->whereIn('pen_id', $pens_ids)->get();
            foreach ($orphan_extra as $value) {
                $orphan_extra_arr[] = ([
                    'pen_id' => $value->pen_id,
                    'form_id' => $value->form_id,
                    'key' => $value->key,
                    'int_id' => $value->int_id,
                    'label' => $value->label,
                    'value' => $value->value,
                    'created_at' => $value->created_at,
                ]);
            }

            $add_orphans = Orphan::insert($orphan_data_arr);
            $add_orphan_extra_data = OrphanExtra::insert($orphan_extra_arr);

            if ($add_orphans && $add_orphan_extra_data) {
                return true;
            }
        }
    }

    public function getCurrentPathid()
    {
        $current_path_id = 0;
        if (Admin::user()->id == 6) {
            $current_path_id = 1;
        } elseif (Admin::user()->id == 7) {
            $current_path_id = 2;
        } elseif (Admin::user()->id == 8) {
            $current_path_id = 3;
        } elseif (Admin::user()->id == 9) {
            $current_path_id = 4;
        } elseif (Admin::user()->id == 10) {
            $current_path_id = 5;
        }

        return $current_path_id;
    }

    public function getCurrentPathTitle()
    {
        return Path::where('id', $this->getCurrentPathid())->where('active', 1)->value('title');
    }

    public function getCurrentStage()
    {
        return Stage::select('id', 'title', 'active', 'start_date', 'end_date')->where('active', 1);
    }
}
