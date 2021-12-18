<?php

namespace Modules\Contact\Http\Controllers\Setting;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Services\AuthenticatedSessionService;
use Modules\Contact\Http\Requests\Setting\ReligionRequest;
use Modules\Contact\Services\Setting\ReligionService;
use Modules\Core\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;


/**
 * @class ReligionController
 * @package Contact
 */
class ReligionController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @var ReligionService
     */
    private $religionService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param ReligionService $religionService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                ReligionService              $religionService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->religionService = $religionService;
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
        $religions = $this->religionService->religionPaginate($filters);

        return view('contact::setting.religion.index', [
            'religions' => $religions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::setting.religion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReligionRequest $request
     * @return RedirectResponse
     * @throws Exception|Throwable
     */
    public function store(ReligionRequest $request): RedirectResponse
    {
        $confirm = $this->religionService->storeReligion($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.religions.index');
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
        if ($religion = $this->religionService->getReligionById($id)) {
            return view('contact::setting.religion.show', [
                'religion' => $religion,
                'timeline' => Utility::modelAudits($religion)
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
        if ($religion = $this->religionService->getReligionById($id)) {
            return view('contact::setting.religion.edit', [
                'religion' => $religion
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReligionRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(ReligionRequest $request, $id): RedirectResponse
    {
        $confirm = $this->religionService->updateReligion($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.religions.index');
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
     * @throws Throwable
     */
    public function destroy($id, Request $request)
    {
        if ($this->authenticatedSessionService->validate($request)) {

            $confirm = $this->religionService->destroyReligion($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.religions.index');
        }
        abort(403, 'Wrong user credentials');
    }

    /**
     * Restore a Soft Deleted Resource
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse|void
     * @throws Throwable|\Throwable
     */
    public function restore($id, Request $request)
    {
        if ($this->authenticatedSessionService->validate($request)) {

            $confirm = $this->religionService->restoreReligion($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.religions.index');
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

        $religionExport = $this->religionService->exportReligion($filters);

        $filename = 'Religion-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $religionExport->download($filename, function ($religion) use ($religionExport) {
            return $religionExport->map($religion);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::setting.religion.import');
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
        $religions = $this->religionService->getAllReligions($filters);

        return view('contact::setting.religion.index', [
            'religions' => $religions
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

        $religionExport = $this->religionService->exportReligion($filters);

        $filename = 'Religion-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $religionExport->download($filename, function ($religion) use ($religionExport) {
            return $religionExport->map($religion);
        });

    }
}
