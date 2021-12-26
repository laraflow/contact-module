<?php

namespace Modules\Contact\Services\Common;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Common\Group;
use Modules\Contact\Repositories\Eloquent\Common\GroupRepository;
use Throwable;

/**
 * @class GroupService
 * @package Modules\Contact\Services\Common
 */
class GroupService extends Service
{
/**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * GroupService constructor.
     * @param GroupRepository $groupRepository
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->groupRepository->itemsPerPage = 10;
    }

    /**
     * Get All Group models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllGroups(array $filters = [], array $eagerRelations = [])
    {
        return $this->groupRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create Group Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function groupPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->groupRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Group Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getGroupById($id, bool $purge = false)
    {
        return $this->groupRepository->show($id, $purge);
    }

    /**
     * Save Group Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeGroup(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newGroup = $this->groupRepository->create($inputs);
            if ($newGroup instanceof Group) {
                DB::commit();
                return ['status' => true, 'message' => __('New Group Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New Group Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->groupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Group Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateGroup(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $group = $this->groupRepository->show($id);
            if ($group instanceof Group) {
                if ($this->groupRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('Group Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('Group Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Group Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->groupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Group Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyGroup($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->groupRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Group is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Group is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->groupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Group Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreGroup($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->groupRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Group is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Group is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->groupRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return GroupExport
     * @throws Exception
     */
    public function exportGroup(array $filters = []): GroupExport
    {
        return (new GroupExport($this->groupRepository->getWith($filters)));
    }
}
