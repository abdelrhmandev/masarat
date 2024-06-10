<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    protected  $COMMON_SERVICE;

    public function __construct()
    {
        $this->COMMON_SERVICE     = app('App\Admin\Services\CommonService');
    }

    public function index(Request $request)
    {
        $compact                                        = [];
        $cases                                    = DB::table('pens')
            ->where('pens.personal_id', '=', $request->id)
            ->where('pens.confirmation_code', '=', $request->confirmation_code);
        $cases = $this->COMMON_SERVICE->enhance($cases);

        if ($cases->count() == 0) {
            return back()->with('error', trans('messages.error.id-not-foundtrack'));
        }

        $compact['cases'] = $cases;
        $compact['personal_id'] = $request->id;
        $compact['confirmation_code'] = $request->confirmation_code;
        return view('forms.trackingHome', $compact);
    }

    public function tracking()
    {
        return view('forms.tracking');
    }

    public function oneTrack(Request $request)
    {
        $cases = DB::table('pens')
            ->leftJoin('forms_parent AS parent', 'parent.pen_id', 'pens.id')
            ->leftJoin('forms', 'forms.forms_parent_id', 'parent.id')
            ->where('pens.personal_id', '=', $request->personal_id)
            ->where('pens.confirmation_code', '=', $request->confirmation_code)
            ->where('forms.id', '=', $request->form_id);

        if ($cases->get()->count() == 0) {
            return back()->with('error', trans('messages.error.not-auth'));
        }

        return view('forms.oneTracking', $this->COMMON_SERVICE->oneTrack($request->form_id));
    }
}
