<?php

namespace App\Data\Repositories\User;

use App\Data\Models\User;

use Illuminate\Support\Facades\Hash;

/**
 * Class EloquentRepository
 * @package App\Data\Repositories\User
 */
class EloquentRepository implements UserRepository
{
    /**
     * Returns All User
     * @param $tenant_id
     */
    public function all()
    {
        return User::paginate(5);
    }


    /**
     * Returns Specific User Object By Id
     * @param $tenant_id
     * @param $user_id
     */
    public function get($user_id)
    {
        return User::where("id", $user_id)->first();
    }



    /**
     * Creates User & Returns User Object
     * @param $data - Array
     */
    public function create(array $data)
    {

        $user = User::create($data);

        return $user;
    }

    /**
     * Update Role & Returns Role Object
     * @param $data - Array
     * @param $tenant_id
     * @param $role_id
     */
    public function update(array $data,  $user_id)
    {
        $user = User::where("id", $user_id)->first();

        if (!is_null($user)) {
            $user->update($data);
        }

        return $user;
    }
}
