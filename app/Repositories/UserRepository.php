<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function saveEmployee($request)
    {
        DB::beginTransaction();
        try {
            $empData = [ 
                'name'              => $request->name, 
                'email'             => $request->email,
                'phone'             => $request->phone,
                'password'          => bcrypt($request->password),
                'email_verified_at' => null,
                'deleted_at'        => null,
                'created_at'        => now(),
                'updated_at'        => now()
            ];
            # insert employee into 'users' table
            $save = User::create($empData);
            $token = $save->createToken('PersonalAccessToken')->accessToken;
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage().' in file '.__FILE__.' at line '.__LINE__);
            return false;
        }
    }

    /**
     * Get all employees
     *
     * @return  object
     */
    public function getAllEmployees()
    {
        # get all emoloyees data from `users` table
        return User::whereNull('deleted_at')->paginate(15);
    }

    /**
     * Check employee is exits or not
     *
     * @param   $id
     * @return  boolean
     */
    public function isExistEmployee($id)
    {
        # check employee is exists or not
        return User::where('id', $id)->whereNull('deleted_at')->exists();
    }

    /**
     * Update employee data
     *
     * @param   $request
     * @return  boolean
     */
    public function updateEmployee($request)
    {
        DB::beginTransaction();
        try {
            # update employee data
            User::where('id', $request->id)->whereNull('deleted_at')
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'updated_at' => now()
                ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage().' in file '.__FILE__.' at line '.__LINE__);
            return false;
        }
    }

    /**
     * Delete employee data
     *
     * @param   $id
     * @return  boolean
     */
    public function deleteEmployee($id)
    {
        DB::beginTransaction();
        try {
            # delete employee data
            User::where('id', $id)->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage().' in file '.__FILE__.' at line '.__LINE__);
            return false;
        }
    }
}
