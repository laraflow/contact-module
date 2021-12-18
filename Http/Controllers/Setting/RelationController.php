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
use Modules\Contact\Http\Requests\Setting\RelationRequest;
use Modules\Contact\Services\Setting\RelationService;
use Modules\Core\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;


/**
 * @class RelationController
 * @package Contact
 */
class RelationController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @var RelationService
     */
    private $relationService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param RelationService $relationService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                RelationService              $relationService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->relationService = $relationService;
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
        $relations = $this->relationService->relationPaginate($filters);

        return view('contact::setting.relation.index', [
            'relations' => $relations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contact::setting.relation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RelationRequest $request
     * @return RedirectResponse
     * @throws Exception|Throwable
     */
    public function store(RelationRequest $request): RedirectResponse
    {
        $confirm = $this->relationService->storeRelation($request->except('_token'));
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.relations.index');
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
        if ($relation = $this->relationService->getRelationById($id)) {
            return view('contact::setting.relation.show', [
                'relation' => $relation,
                'timeline' => Utility::modelAudits($relation)
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
        if ($relation = $this->relationService->getRelationById($id)) {
            return view('contact::setting.relation.edit', [
                'relation' => $relation
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RelationRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(RelationRequest $request, $id): RedirectResponse
    {
        $confirm = $this->relationService->updateRelation($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('contact.settings.relations.index');
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

            $confirm = $this->relationService->destroyRelation($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.relations.index');
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

            $confirm = $this->relationService->restoreRelation($id);

            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('contact.settings.relations.index');
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

        $relationExport = $this->relationService->exportRelation($filters);

        $filename = 'Relation-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $relationExport->download($filename, function ($relation) use ($relationExport) {
            return $relationExport->map($relation);
        });

    }

    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('contact::setting.relation.import');
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
        $relations = $this->relationService->getAllRelations($filters);

        return view('contact::setting.relation.index', [
            'relations' => $relations
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

        $relationExport = $this->relationService->exportRelation($filters);

        $filename = 'Relation-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $relationExport->download($filename, function ($relation) use ($relationExport) {
            return $relationExport->map($relation);
        });

    }
}
