<?php

namespace Modules\Contact\Services\Common;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Modules\Contact\Models\Common\Label;
use Modules\Contact\Repositories\Eloquent\Common\LabelRepository;
use Throwable;

/**
 * @class LabelService
 * @package Modules\Contact\Services\Common
 */
class LabelService extends Service
{
/**
     * @var LabelRepository
     */
    private $labelRepository;

    /**
     * LabelService constructor.
     * @param LabelRepository $labelRepository
     */
    public function __construct(LabelRepository $labelRepository)
    {
        $this->labelRepository = $labelRepository;
        $this->labelRepository->itemsPerPage = 10;
    }

    /**
     * Get All Label models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllLabels(array $filters = [], array $eagerRelations = [])
    {
        return $this->labelRepository->getWith($filters, $eagerRelations, true);
    }

    /**
     * Create Label Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function labelPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->labelRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Label Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getLabelById($id, bool $purge = false)
    {
        return $this->labelRepository->show($id, $purge);
    }

    /**
     * Save Label Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeLabel(array $inputs): array
    {
        DB::beginTransaction();
        try {
            $newLabel = $this->labelRepository->create($inputs);
            if ($newLabel instanceof Label) {
                DB::commit();
                return ['status' => true, 'message' => __('New Label Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('New Label Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->labelRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Label Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateLabel(array $inputs, $id): array
    {
        DB::beginTransaction();
        try {
            $label = $this->labelRepository->show($id);
            if ($label instanceof Label) {
                if ($this->labelRepository->update($inputs, $id)) {
                    DB::commit();
                    return ['status' => true, 'message' => __('Label Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('Label Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Label Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->labelRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Label Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyLabel($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->labelRepository->delete($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Label is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Label is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->labelRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Label Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreLabel($id): array
    {
        DB::beginTransaction();
        try {
            if ($this->labelRepository->restore($id)) {
                DB::commit();
                return ['status' => true, 'message' => __('Label is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                DB::rollBack();
                return ['status' => false, 'message' => __('Label is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->labelRepository->handleException($exception);
            DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return LabelExport
     * @throws Exception
     */
    public function exportLabel(array $filters = []): LabelExport
    {
        return (new LabelExport($this->labelRepository->getWith($filters)));
    }
}
