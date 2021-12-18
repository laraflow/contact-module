<?php

namespace Modules\Contact\Services\Setting;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Contact\Exports\Setting\BloodGroupExport;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Setting\BloodGroup;
use Modules\Contact\Repositories\Eloquent\Setting\BloodGroupRepository;
use Throwable;

/**
 * @class BloodGroupService
 * @package Modules\Contact\Services\Setting
 */
class BloodGroupService extends Service
{
/**
     * @var BloodGroupRepository
     */
    private $bloodGroupRepository;

    /**
     * BloodGroupService constructor.
     * @param BloodGroupRepository $bloodGroupRepository
     */
    public function __construct(BloodGroupRepository $bloodGroupRepository)
    {
        $this->bloodGroupRepository = $bloodGroupRepository;
        $this->bloodGroupRepository->itemsPerPage = 10;
    }

    /**
     * Get All BloodGroup models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllBloodGroups(array $filters = [], array $eagerRelations = [])
    {
        return $this->bloodGroupRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create BloodGroup Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function bloodGroupPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->bloodGroupRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show BloodGroup Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getBloodGroupById($id, bool $purge = false)
    {
        return $this->bloodGroupRepository->show($id, $purge);
    }

    /**
     * Save BloodGroup Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeBloodGroup(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newBloodGroup = $this->bloodGroupRepository->create($inputs);
            if ($newBloodGroup instanceof BloodGroup) {
                DB::commit();
                return ['status' => true, 'message' => __('New BloodGroup Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New BloodGroup Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->bloodGroupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update BloodGroup Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateBloodGroup(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $bloodGroup = $this->bloodGroupRepository->show($id);
            if ($bloodGroup instanceof BloodGroup) {
                if ($this->bloodGroupRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('BloodGroup Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('BloodGroup Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('BloodGroup Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->bloodGroupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy BloodGroup Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyBloodGroup($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->bloodGroupRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('BloodGroup is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('BloodGroup is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->bloodGroupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore BloodGroup Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreBloodGroup($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->bloodGroupRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('BloodGroup is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('BloodGroup is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->bloodGroupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return BloodGroupExport
     * @throws Exception
     */
    public function exportBloodGroup(array $filters = []): BloodGroupExport
    {
        return (new BloodGroupExport($this->bloodGroupRepository->getWith($filters)));
    }
}
