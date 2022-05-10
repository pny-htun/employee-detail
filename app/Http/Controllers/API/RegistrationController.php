<?php

namespace App\Http\Controllers\API;

use App\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\UserUpdateValidationRequest;
use App\Http\Requests\UserRegisterValidationRequest;

class RegistrationController extends BaseController
{
    private UserRepositoryInterface $userRepo;

    /**
     * Constructor to assign interface to variable
     *
     * @param   interface, class
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterValidationRequest $request)
    {
        # save employee
        $save = $this->userRepo->saveEmployee($request);
        # check save process is success or not
        if ($save) {
            return $this->sendSuccess(trans('messages.SS001'));
        } else {
            return $this->sendError(trans('messages.SE001'), 200);
        }
    }

    /**
     * Show employee data
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        # get all employee data from `users` table
        $employees = $this->userRepo->getAllEmployees();

        if ($employees->isNotEmpty()) {
            return $this->sendResponse($employees);
        } else {
            return $this->sendError(trans('messages.SE005'), 200);
        }
    }

    /**
     * Update employee data
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidationRequest $request)
    {
        # check user selected employee is already exists in system or not
        $isExistEmp = $this->userRepo->isExistEmployee($request->employee_id);

        if ($isExistEmp) {
           # update employee
            $update = $this->userRepo->updateEmployee($request);

            # check update process is success or not
            if ($update) {
                return $this->sendSuccess(trans('messages.SS003'));
            } else {
                return $this->sendError(trans('messages.SE003'), 200);
            }

        } else {
            return $this->sendError(trans('messages.SE004'), 200);
        }
    }

    /**
     * Delete employee data
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # check user selected employee is already deleted in system or not
        $isAlreadyDeleted = $this->userRepo->isExistEmployee($id);

        if ($isAlreadyDeleted) {
           # delete employee
            $delete = $this->userRepo->deleteEmployee($id);

            # check delete process is success or not
            if ($delete) {
                return $this->sendSuccess(trans('messages.SS004'));
            } else {
                return $this->sendError(trans('messages.SE005'), 200);
            }

        } else {
            return $this->sendError(trans('messages.SE004'), 200);
        }
    }
}
