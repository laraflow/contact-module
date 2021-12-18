<?php

namespace Modules\Contact\Http\Controllers\Setting;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Services\AuthenticatedSessionService;
use Modules\Contact\Http\Requests\Setting\BloodGroupRequest;
use Modules\Contact\Services\Setting\BloodGroupService;
use Modules\Core\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;


/**
 * @class BloodGroupController
 * @package Contact
 */
class BloodGroupController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;
    
    /**
     * @var BloodGroupService
     */
    private $bloodGroupService;


    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param BloodGroupService $bloodGroupService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
    BloodGroupService $bloodGroupService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->bloodGroupService = $bloodGroupService;
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
        $countries = $this->bloodGroupService->bloodGroupPaginate($filters);

        return view('contact::setting.blood-group.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::setting.blood-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BloodGroupRequest $request
     * @return RedirectResponse
     * @throws Exception|\Throwable
     */
    public function store(BloodGroupRequest $request): RedirectResponse
    {
        $confirm = $this->bloodGroupService->storeBloodGroup($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.blood-groups.index');
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
        if ($bloodGroup = $this->bloodGroupService->getBloodGroupById($id)) {
            return view('contact::setting.blood-group.show', [
                'bloodGroup' => $bloodGroup,
                'timeline' => Utility::modelAudits($bloodGroup)
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
        if ($bloodGroup = $this->bloodGroupService->getBloodGroupById($id)) {
            return view('contact::setting.blood-group.edit', [
                'bloodGroup' => $bloodGroup
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BloodGroupRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(BloodGroupRequest $request, $id): RedirectResponse
    {
        $confirm = $this->bloodGroupService->updateBloodGroup($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.blood-groups.index');
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

            $confirm = $this->bloodGroupService->destroyBloodGroup($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.blood-groups.index');
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

            $confirm = $this->bloodGroupService->restoreBloodGroup($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.blood-groups.index');
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

        $bloodGroupExport = $this->bloodGroupService->exportBloodGroup($filters);

        $filename = 'BloodGroup-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $bloodGroupExport->download($filename, function ($bloodGroup) use ($bloodGroupExport) {
            return $bloodGroupExport->map($bloodGroup);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::setting.blood-group.import');
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
        $bloodGroups = $this->bloodGroupService->getAllBloodGroups($filters);

        return view('contact::setting.blood-group.index', [
            'bloodGroups' => $bloodGroups
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

        $bloodGroupExport = $this->bloodGroupService->exportBloodGroup($filters);

        $filename = 'BloodGroup-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $bloodGroupExport->download($filename, function ($bloodGroup) use ($bloodGroupExport) {
            return $bloodGroupExport->map($bloodGroup);
        });

    }
}
