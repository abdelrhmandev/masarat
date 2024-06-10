<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Encore\Admin\Facades\Admin;

class AppServiceProvider extends ServiceProvider
{
    protected $NAVIGATION_SERVICE;
    public function __construct()
    {
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('tailAdmin.includes.navigation', function ($view) {
            $view->with("transferCaseCount", $this->NAVIGATION_SERVICE->getSubmittedCases()->count());
            $view->with("devIntsCaseCount", $this->NAVIGATION_SERVICE->getFilteredCases()->count());
            $view->with("supportedCaseCount", $this->NAVIGATION_SERVICE->getCasesNo([6])->count());
            $view->with("partIntsCaseCount", $this->NAVIGATION_SERVICE->getCasesNo([4, 5])->count());
            $view->with("executedCaseCount", $this->NAVIGATION_SERVICE->getCasesNo([8])->count());
            $view->with("returnedCaseCount", $this->NAVIGATION_SERVICE->getCasesNo([12])->count());
            $view->with("partTransferApprovedCount", $this->NAVIGATION_SERVICE->getApproveRejectCases([14, 15])->count());
            $view->with("directorTransferCount", $this->NAVIGATION_SERVICE->getApproveRejectCases([7, 13])->count());
            $view->with("partApprovedCount", $this->NAVIGATION_SERVICE->getApproveCases()->sum('count'));
            $view->with("partRejectedCount", $this->NAVIGATION_SERVICE->getApproveRejectCases([11])->count());
            $view->with("hanggedIntsCaseCount", $this->NAVIGATION_SERVICE->getHanggedCases([10])->get()->sum('count'));
            $view->with("notCompletedCaseCount", $this->NAVIGATION_SERVICE->getNotCompletedCase());

            // Orphans
            if (Admin::user()->inRoles(['development'])) {
                $orphan_counter = \App\Models\Orphan::whereDoesntHave('getOrphanAgeEquivalentDegree')->count();
            } else if (Admin::user()->inRoles(['orphan'])) {
                $orphan_counter = \App\Models\Orphan::has('getOrphanAgeEquivalentDegree')->with('getOrphanPathCategory')->count();
            }
            if (Admin::user()->inRoles(['development']) || Admin::user()->inRoles(['orphan'])) {
                $view->with("orphansCaseCount", $orphan_counter);
                $view->with("stagesCaseCount", \App\Models\Stage::count());
            }

            $path_id = app('App\Admin\Services\OrphansService')->getCurrentPathid();
            $view->with("objectivesCaseCount", \App\Models\Objective::where('path_id', $path_id)->count());
        });
    }
}