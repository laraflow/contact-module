<?php

namespace Modules\Contact\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Auth\Services\AuthenticatedSessionService;
use Modules\Core\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Modules\Contact\Services\Common\GroupService;
use Modules\Contact\Http\Requests\Common\GroupRequest;

/**
 * @class GroupController
 * @package $NAMESPACE$
 */
class GroupController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;
    
    /**
     * @var GroupService
     */
    private $groupService;

    /**
     * GroupController Constructor
     *
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param GroupService $groupService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                GroupService              $groupService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->groupService = $groupService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $filters = $request->except('page');
        $groups = $this->groupService->groupPaginate($filters);

        return view('contact::common.group.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::common.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupRequest $request
     * @return RedirectResponse
     * @throws Exception|\Throwable
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        $confirm = $this->groupService->storeGroup($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.common.groups.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show($id)
    {
        if ($group = $this->groupService->getGroupById($id)) {
            return view('contact::common.group.show', [
                'group' => $group,
                'timeline' => Utility::modelAudits($group)
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function edit($id)
    {
        if ($group = $this->groupService->getGroupById($id)) {
            return view('contact::common.group.edit', [
                'group' => $group
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(GroupRequest $request, $id): RedirectResponse
    {
        $confirm = $this->groupService->updateGroup($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.common.groups.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy($id, Request $request)
    {
        if ($this->authenticatedSessionService->validate($request)) {

            $confirm = $this->groupService->destroyGroup($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.common.groups.index');
        }
        abort(403, 'Wrong user credentials');
    }

    /**
     * Restore a Soft Deleted Resource
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse|void
     * @throws \Throwable
     */
    public function restore($id, Request $request)
    {
        if ($this->authenticatedSessionService->validate($request)) {

            $confirm = $this->groupService->restoreGroup($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.common.groups.index');
        }
        abort(403, 'Wrong user credentials');
    }

    /**
     * Display a listing of the resource.
     *
     * @return string|StreamedResponse
     * @throws Exception
     */
    public function export(Request $request)
    {
        $filters = $request->except('page');

        $groupExport = $this->groupService->exportGroup($filters);

        $filename = 'Group-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $groupExport->download($filename, function ($group) use ($groupExport) {
            return $groupExport->map($group);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::common.groupimport');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function importBulk(Request $request)
    {
        $filters = $request->except('page');
        $groups = $this->groupService->getAllGroups($filters);

        return view('contact::common.groupindex', [
            'groups' => $groups
        ]);
    }

    /**
     * Display a detail of the resource.
     *
     * @return StreamedResponse|string
     * @throws Exception
     */
    public function print(Request $request)
    {
        $filters = $request->except('page');

        $groupExport = $this->groupService->exportGroup($filters);

        $filename = 'Group-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $groupExport->download($filename, function ($group) use ($groupExport) {
            return $groupExport->map($group);
        });

    }
}
