

{{-- <div data-step="1" data-intro="Content 1">Feature #1</div>
<div data-step="2" data-intro="Contetn 2" data-position='right'>Feature #2</div>
<div data-step="3" data-intro="Contetn 3" data-position='left'>Feature #3</div>
<a href="javascript:void(0);" onclick="javascript:introJs().start();">Show me how</a> --}}

<ul class="list-reset">
    <li id="textIcon" class="absolute top-[3.8rem] right-[0.75rem]">
        <div class="flex justify-center flex-wrap">
            <h2 class="font-medium text-center text-teal-500 w-full inline-block font-bold">{{ Admin::user()->name }}</h2>
            <p class="text-xs text-gray-500 text-center">{{ Admin::user()->department_ar }}</p>
        </div>
    </li>
    <li class="absolute top-2 right-0">
        <a href={{ getcwd() }} class="block align-top">
            <span href={{ url('admin/') }}><img src="{{ url('img/masarat_logo_text_2.svg') }}" class="h-10 w-32" alt="workflow" /></a>
        </a>
    </li>
    <li class="my-2 md:my-0" id="dashboard">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/dashboard') }}" id="dashboard" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-home fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.dashboard') }}</span>
        </a>
    </li>

    @if (Admin::user()->inRoles(['orphan']))
    <li class="my-2 md:my-0" id="orphans"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/?count=10') }}" id="orphansCaseCount" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-user-plus fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.interventions_menu') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $orphansCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="objectives"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/objectives/?count=10') }}" id="orphansCaseCount" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-atom fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.objectives') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $objectivesCaseCount  }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="HistoryRecords"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/HistoryRecords/?count=10') }}" id="HistoryRecords" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-align-justify fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.history_records') }}</span>
        </a>
    </li>
    @endif    

    @if (Admin::user()->inRoles(['development']))
    <li class="my-2 md:my-0" id="transferCase">        
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/transferCase?count=10') }}" id="transferCase" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-filter fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.transfer-case') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $transferCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="interventions">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/interventions') }}" id="interventions" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-clipboard-list fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.intervention-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $devIntsCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="supported">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/supported') }}" id="supported" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-ticket-alt fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.supported-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $supportedCaseCount }}</span>
        </a>
    </li>
    <li class="pb-6 my-2 md:my-0" id="notCompleted">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/notCompleted?count=10') }}" id="notCompleted" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-exclamation-triangle fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.notCompleted') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $notCompletedCaseCount }}</span>
        </a>
    </li>
    <hr>
    <li class="md:my-0 divide-y-4" id="executed">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/executed') }}" id="executed" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-check fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.executed') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $executedCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0 " id="returned">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/returned') }}" id="returned" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-undo-alt fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.returned') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $returnedCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="trackIntsExecution">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/trackIntsExecution') }}" id="trackIntsExecution" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-box-open fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.track-intervention-execution') }}</span>
        </a>
    </li>
    <hr>
    <li class="pt-6 my-2 md:my-0" id="stages"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/stages/?count=10') }}" id="stagesCaseCount" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-calendar-minus fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.stages') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $stagesCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="orphans"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/orphans/?count=10') }}" id="orphansCaseCount" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-user-plus fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.interventions_menu') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $orphansCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="HistoryStages"> 
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/orphan/HistoryStages/?count=10') }}" id="HistoryRecords" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-align-justify fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('orphan.history_records') }}</span>
        </a>
    </li>
    @endif

    @if (Admin::user()->inRoles(['partners']))
    <li class="my-2 md:my-0" id="interventions">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/interventions') }}" id="interventions" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-clipboard-list fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.intervention-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $partIntsCaseCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="approvedSupport">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/approvedSupport') }}" id="approvedSupport" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-thumbs-up fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.approved-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $partApprovedCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="rejectedSupport">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/rejectedSupport') }}" id="rejectedSupport" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-thumbs-down fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.rejected-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $partRejectedCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="providers">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/providers?count=10') }}" id="providers" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-users fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.providers-list') }}</span>
        </a>
    </li>
    @endif

    @if (Admin::user()->inRoles(['operation']))
    <li class="my-2 md:my-0" id="interventions">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/interventions') }}" id="interventions" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-clipboard-list fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.intervention-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $partTransferApprovedCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0 " id="hangged">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/hangged') }}" id="hangged" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-pause-circle fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.hangged-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $hanggedIntsCaseCount }}</span>
        </a>
    </li>
    @endif

    @if (Admin::user()->inRoles(['director']))
    <li class="my-2 md:my-0" id="interventions">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/interventions') }}" id="interventions" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-clipboard-list fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.intervention-list') }}</span>
            <span class="absolute left-[0.26rem] items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-300 rounded-full">{{ $directorTransferCount }}</span>
        </a>
    </li>
    <li class="my-2 md:my-0" id="users">
        <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/users?count=10') }}" id="users" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
            <span class="fas fa-users fa-fw mx-2"></span><span id="textIcon" class="w-full inline-block pb-1 md:pb-0 text-sm">{{ trans('navigation.users-list') }}</span>
        </a>
    </li>
    @endif
</ul>