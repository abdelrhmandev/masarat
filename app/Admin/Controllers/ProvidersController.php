<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Models\Providers;

class ProvidersController extends Controller
{
    public function index(Request $request)
    {
        $current_url                        = url('admin/' . Admin::user()->roles[0]->slug . '/providers');
        $providers                          = Providers::paginate($request->input('count') ?? '50');
        $compact                            = ['current_url' => $current_url, 'providers' => $providers];
        return view('tailAdmin.pages.partners.providers', $compact);
    }

    public function addProvider(Request $request)
    {
        $insert                             = $request->post();
        unset($insert['_token']);
        if (Providers::insert($insert)) {
            return back()->with('success', trans('providers.provider.added'));
        }
    }

    public function providerDetails(Request $request)
    {
        return response(Providers::where('id', '=', $request->get('id'))->first());
    }

    public function editProvider(Request $request)
    {
        return Providers::where('id', '=', $request->get('id'))->first();
    }

    public function updateProvider(Request $request)
    {
        if (!empty($request->post('id'))) {
            DB::table('providers')->where('id', '=', $request->post('id'))->update([
                'person_name' => $request->post('person_name'),
                'phone' => $request->post('phone'),
                'email' => $request->post('email'),
                'full_address' => $request->post('full_address')
            ]);
            return back()->with('success', trans('providers.provider.updated'));
        }
        return back()->with('error', trans('providers.provider.error'));
    }

    public function deleteProvider(Request $request)
    {
        if (!empty($request->id) && $request->id > 0) {
            if(DB::table('form_providers')->select('id')->where('provider_id', '=', $request->id)->count() > 0) {
                return back()->with('error', trans('providers.provider.notallowed.delete'));
            } else {
                Providers::find($request->id)->delete($request->id);
                return back()->with('success', trans('providers.provider.deleted'));
            }
        }

        return back()->with('error', trans('providers.provider.error'));
    }

    public function attachProvider(Request $request)
    {
        $custom_provider                    = DB::table('providers')
            ->where('providers.id', '=', $request->post('provider'))
            ->where('providers.person_name', '=', $request->post('extra_person'))
            ->where('providers.phone', '=', $request->post('extra_phone'));
        // If custom_provider against the current providers is 0, then it's extra data
        if ($custom_provider->count() >= 1) {
            $form_provider_insertion        = [
                'form_id'                   => $request->post('form_id'),
                'provider_id'               => $request->post('provider'),
            ];
        } else {
            $form_provider_insertion        = [
                'form_id'                   => $request->post('form_id'),
                'provider_id'               => $request->post('provider'),
                'extra_person_name'         => $request->post('extra_person'),
                'extra_phone'               => $request->post('extra_phone'),
                'extra_notes'               => $request->post('extra_notes'),
            ];
        }

        if (DB::table('form_providers')->insert($form_provider_insertion)) {
            DB::table('forms')->where('forms.id', '=', $request->post('form_id'))->update(['status' => 6]);
            return back()->with('success', trans('interventions.cases.trasfered.to.role'));
        } else {
            return back()->with('error', trans('providers.provider.error'));
        }
    }
}
