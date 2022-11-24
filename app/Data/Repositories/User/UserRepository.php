<?php

namespace App\Data\Repositories\User;

/**
 * Interface UserRepository
 * @package App\Data\Repositories\User
 */
interface UserRepository
{

    /**
     * Returns All User
     * @param $tenant_id
     */
    public function all();

    /**
     * Returns Specific User Object By Id
     * @param $tenant_id
     * @param $user_id
     */
    public function get($user_id);
    /**
     * Creates User & Returns User Object
     * @param $data - Array
     */
    public function create(array $data);

    /**
     * Update User & Returns User Object
     * @param $data - Array
     * @param $tenant_id
     * @param $user_id
     */
    public function update(array $data,  $user_id);
}
