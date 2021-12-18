<?php

namespace Modules\Contact\Services\Setting;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Contact\Exports\Setting\ReligionExport;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Setting\Religion;
use Modules\Contact\Repositories\Eloquent\Setting\ReligionRepository;
use Throwable;

/**
 * @class ReligionService
 * @package Modules\Contact\Services\Setting
 */
class ReligionService extends Service
{
/**
     * @var ReligionRepository
     */
    private $religionRepository;

    /**
     * ReligionService constructor.
     * @param ReligionRepository $religionRepository
     */
    public function __construct(ReligionRepository $religionRepository)
    {
        $this->religionRepository = $religionRepository;
        $this->religionRepository->itemsPerPage = 10;
    }

    /**
     * Get All Religion models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllReligions(array $filters = [], array $eagerRelations = [])
    {
        return $this->religionRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create Religion Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function religionPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->religionRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Religion Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getReligionById($id, bool $purge = false)
    {
        return $this->religionRepository->show($id, $purge);
    }

    /**
     * Save Religion Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeReligion(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newReligion = $this->religionRepository->create($inputs);
            if ($newReligion instanceof Religion) {
                DB::commit();
                return ['status' => true, 'message' => __('New Religion Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New Religion Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->religionRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Religion Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateReligion(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $religion = $this->religionRepository->show($id);
            if ($religion instanceof Religion) {
                if ($this->religionRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('Religion Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('Religion Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Religion Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->religionRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Religion Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyReligion($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->religionRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Religion is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Religion is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->religionRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Religion Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreReligion($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->religionRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Religion is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Religion is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->religionRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return ReligionExport
     * @throws Exception
     */
    public function exportReligion(array $filters = []): ReligionExport
    {
        return (new ReligionExport($this->religionRepository->getWith($filters)));
    }
}
