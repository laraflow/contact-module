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
use Modules\Contact\Services\Common\LabelService;
use Modules\Contact\Http\Requests\Common\LabelRequest;

/**
 * @class LabelController
 * @package $NAMESPACE$
 */
class LabelController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;
    
    /**
     * @var LabelService
     */
    private $labelService;

    /**
     * LabelController Constructor
     *
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param LabelService $labelService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                LabelService              $labelService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->labelService = $labelService;
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
        $labels = $this->labelService->labelPaginate($filters);

        return view('contact::common.label.index', [
            'labels' => $labels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::common.label.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LabelRequest $request
     * @return RedirectResponse
     * @throws Exception|\Throwable
     */
    public function store(LabelRequest $request): RedirectResponse
    {
        $confirm = $this->labelService->storeLabel($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.common.labels.index');
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
        if ($label = $this->labelService->getLabelById($id)) {
            return view('contact::common.label.show', [
                'label' => $label,
                'timeline' => Utility::modelAudits($label)
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
        if ($label = $this->labelService->getLabelById($id)) {
            return view('contact::common.label.edit', [
                'label' => $label
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LabelRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(LabelRequest $request, $id): RedirectResponse
    {
        $confirm = $this->labelService->updateLabel($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.common.labels.index');
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

            $confirm = $this->labelService->destroyLabel($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.common.labels.index');
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

            $confirm = $this->labelService->restoreLabel($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.common.labels.index');
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

        $labelExport = $this->labelService->exportLabel($filters);

        $filename = 'Label-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $labelExport->download($filename, function ($label) use ($labelExport) {
            return $labelExport->map($label);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::common.labelimport');
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
        $labels = $this->labelService->getAllLabels($filters);

        return view('contact::common.labelindex', [
            'labels' => $labels
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

        $labelExport = $this->labelService->exportLabel($filters);

        $filename = 'Label-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $labelExport->download($filename, function ($label) use ($labelExport) {
            return $labelExport->map($label);
        });

    }
}
