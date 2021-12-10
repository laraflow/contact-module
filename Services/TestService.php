<?php

namespace Modules\Contact\Services;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Abstracts\Service\Service;
use Modules\Core\Supports\Constant;
use Throwable;

/**
 * @class TestService
 * @package Modules\Contact\Services
 */
class TestService extends Service
{
/**
     * @var TestRepository
     */
    private $testRepository;

    /**
     * TestService constructor.
     * @param TestRepository $testRepository
     */
    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
        $this->testRepository->itemsPerPage = 10;
    }

    /**
     * Get All Test models as collection
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllTests(array $filters = [], array $eagerRelations = [])
    {
        return $this->testRepository->getAllTestWith($filters, $eagerRelations, true);
    }

    /**
     * Create Test Model Pagination
     * 
     * @param array $filters
     * @param array $eagerRelations
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function testPaginate(array $filters = [], array $eagerRelations = [])
    {
        return $this->testRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * Show Test Model
     * 
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws Exception
     */
    public function getTestById($id, bool $purge = false)
    {
        return $this->testRepository->show($id, $purge);
    }

    /**
     * Save Test Model
     * 
     * @param array $inputs
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function storeTest(array $inputs): array
    {
        \DB::beginTransaction();
        try {
            $newTest = $this->testRepository->create($inputs);
            if ($newTest instanceof Test) {
                \DB::commit();
                return ['status' => true, 'message' => __('New Test Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('New Test Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->testRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Update Test Model
     * 
     * @param array $inputs
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function updateTest(array $inputs, $id): array
    {
        \DB::beginTransaction();
        try {
            $test = $this->testRepository->show($id);
            if ($test instanceof Test) {
                if ($this->testRepository->update($inputs, $id)) {
                    \DB::commit();
                    return ['status' => true, 'message' => __('Test Info Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    \DB::rollBack();
                    return ['status' => false, 'message' => __('Test Info Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                return ['status' => false, 'message' => __('Test Model Not Found'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->testRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Destroy Test Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function destroyTest($id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->testRepository->delete($id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('Test is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('Test is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->testRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Restore Test Model
     * 
     * @param $id
     * @return array
     * @throws Throwable
     */
    public function restoreTest($id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->testRepository->restore($id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('Test is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('Test is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->testRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return TestExport
     * @throws Exception
     */
    public function exportTest(array $filters = []): TestExport
    {
        return (new TestExport($this->testRepository->getAllTestWith($filters)));
    }
}
