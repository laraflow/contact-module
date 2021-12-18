<?php

namespace Modules\Contact\Services\Setting;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Contact\Exports\Setting\GenderExport;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Setting\Gender;
use Modules\Contact\Repositories\Eloquent\Setting\GenderRepository;
use Throwable;

/**
 * @class GenderService
 * @package Modules\Contact\Services\Setting
 */
class GenderService extends Service
{
/**
     * @var GenderRepository
     */
    private $genderRepository;

    /**
     * GenderService constructor.
     * @param GenderRepository $genderRepository
     */
    public function __construct(GenderRepository $genderRepository)
    {
        $this->genderRepository = $genderRepository;
        $this->genderRepository->itemsPerPage = 10;
    }

    /**
     * Get All Gender models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllGenders(array $filters = [], array $eagerRelations = [])
    {
        return $this->genderRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create Gender Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function genderPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->genderRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Gender Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getGenderById($id, bool $purge = false)
    {
        return $this->genderRepository->show($id, $purge);
    }

    /**
     * Save Gender Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeGender(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newGender = $this->genderRepository->create($inputs);
            if ($newGender instanceof Gender) {
                DB::commit();
                return ['status' => true, 'message' => __('New Gender Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New Gender Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->genderRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Gender Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateGender(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $gender = $this->genderRepository->show($id);
            if ($gender instanceof Gender) {
                if ($this->genderRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('Gender Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('Gender Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Gender Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->genderRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Gender Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyGender($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->genderRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Gender is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Gender is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->genderRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Gender Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreGender($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->genderRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Gender is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Gender is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->genderRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return GenderExport
     * @throws Exception
     */
    public function exportGender(array $filters = []): GenderExport
    {
        return (new GenderExport($this->genderRepository->getWith($filters)));
    }
}
