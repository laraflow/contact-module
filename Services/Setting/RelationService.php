<?php

namespace Modules\Contact\Services\Setting;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Contact\Exports\Setting\RelationExport;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Setting\Relation;
use Modules\Contact\Repositories\Eloquent\Setting\RelationRepository;
use Throwable;

/**
 * @class RelationService
 * @package Modules\Contact\Services\Setting
 */
class RelationService extends Service
{
/**
     * @var RelationRepository
     */
    private $relationRepository;

    /**
     * RelationService constructor.
     * @param RelationRepository $relationRepository
     */
    public function __construct(RelationRepository $relationRepository)
    {
        $this->relationRepository = $relationRepository;
        $this->relationRepository->itemsPerPage = 10;
    }

    /**
     * Get All Relation models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllRelations(array $filters = [], array $eagerRelations = [])
    {
        return $this->relationRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create Relation Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function relationPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->relationRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Relation Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getRelationById($id, bool $purge = false)
    {
        return $this->relationRepository->show($id, $purge);
    }

    /**
     * Save Relation Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeRelation(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newRelation = $this->relationRepository->create($inputs);
            if ($newRelation instanceof Relation) {
                DB::commit();
                return ['status' => true, 'message' => __('New Relation Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New Relation Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->relationRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Relation Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateRelation(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $relation = $this->relationRepository->show($id);
            if ($relation instanceof Relation) {
                if ($this->relationRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('Relation Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('Relation Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Relation Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->relationRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Relation Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyRelation($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->relationRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Relation is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Relation is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->relationRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Relation Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreRelation($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->relationRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Relation is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Relation is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->relationRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return RelationExport
     * @throws Exception
     */
    public function exportRelation(array $filters = []): RelationExport
    {
        return (new RelationExport($this->relationRepository->getWith($filters)));
    }
}
