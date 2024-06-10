<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('id') && $request->has('confirmation_code')) {
            $current_user_expiry_object     = DB::table('pens')
                ->select('pens.updated_at', 'pens.id', 'pens.personal_id')
                ->leftJoin('forms_parent', 'forms_parent.pen_id', 'pens.id')
                ->where('pens.personal_id', '=', $request->id)
                ->first();

            if ($current_user_expiry_object) {
                $lastest_updated                           = new Carbon($current_user_expiry_object->updated_at);
                $now                                             = Carbon::now();
                $days                                            = $lastest_updated->diff($now)->days;

                $current_user_expiry_object_with_reactivated    = DB::table('pens')
                    ->select('pens.updated_at', 'pens.id', 'pens.personal_id')
                    ->select('reactivated_urls.reactivated_to as Reactivated_to_Date', 'reactivated_urls.pen_id', 'pens.id')
                    ->leftJoin('forms_parent', 'forms_parent.pen_id', 'pens.id')
                    ->join('reactivated_urls', 'reactivated_urls.pen_id', 'pens.id')
                    ->where('pens.personal_id', '=', $request->id);

                if ($current_user_expiry_object_with_reactivated->count() > 0) {
                    $lastest_updated_reactivated      = new Carbon($current_user_expiry_object_with_reactivated->first()->Reactivated_to_Date);
                    $today   = Carbon::now()->toDateTimeString();
                    if ($today > $lastest_updated_reactivated) {
                        return redirect(url('fillForm'))->with('error', trans('home.link-expired-after_reactivated_url'));
                    }
                } else {
                    if ($days >= 5) {
                        return redirect(url('fillForm'))->with('error', trans('home.link-expired'));
                    }
                }
            }
        }
        return $next($request);
    }
}
