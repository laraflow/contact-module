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
use Modules\Contact\Http\Requests\Setting\GenderRequest;
use Modules\Contact\Services\Setting\GenderService;
use Modules\Core\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;


/**
 * @class GenderController
 * @package Contact
 */
class GenderController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @var GenderService
     */
    private $genderService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param GenderService $genderService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                GenderService              $genderService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->genderService = $genderService;
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
        $genders = $this->genderService->genderPaginate($filters);

        return view('contact::setting.gender.index', [
            'genders' => $genders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::setting.gender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenderRequest $request
     * @return RedirectResponse
     * @throws Exception|Throwable
     */
    public function store(GenderRequest $request): RedirectResponse
    {
        $confirm = $this->genderService->storeGender($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.genders.index');
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
        if ($gender = $this->genderService->getGenderById($id)) {
            return view('contact::setting.gender.show', [
                'gender' => $gender,
                'timeline' => Utility::modelAudits($gender)
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
        if ($gender = $this->genderService->getGenderById($id)) {
            return view('contact::setting.gender.edit', [
                'gender' => $gender
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GenderRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(GenderRequest $request, $id): RedirectResponse
    {
        $confirm = $this->genderService->updateGender($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.genders.index');
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

            $confirm = $this->genderService->destroyGender($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.genders.index');
        }
        abort(403, 'Wrong user credentials');
    }

    /**
     * Restore a Soft Deleted Resource
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse|void
     * @throws Throwable
     */
    public function restore($id, Request $request)
    {
        if ($this->authenticatedSessionService->validate($request)) {

            $confirm = $this->genderService->restoreGender($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.genders.index');
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

        $genderExport = $this->genderService->exportGender($filters);

        $filename = 'Gender-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $genderExport->download($filename, function ($gender) use ($genderExport) {
            return $genderExport->map($gender);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::setting.gender.import');
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
        $genders = $this->genderService->getAllGenders($filters);

        return view('contact::setting.gender.index', [
            'genders' => $genders
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

        $genderExport = $this->genderService->exportGender($filters);

        $filename = 'Gender-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $genderExport->download($filename, function ($gender) use ($genderExport) {
            return $genderExport->map($gender);
        });

    }
}
