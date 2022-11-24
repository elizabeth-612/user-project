<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Data\Repositories\User\UserRepository;
use App\Data\Repositories\UserRole\UserRoleRepository;
use DB;

// use App\User;

class ApiController extends Controller
{
   
    private $userRepository;
    private $userRoleRepository;


    public function __construct(UserRepository $userRepository,UserRoleRepository $userRoleRepository ) {
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    public function userList(Request $request)
    {
        
        $users = $this->userRepository->all();
        foreach($users as $user)
        {
            $user->role = $this->userRoleRepository->get($user->id);
             
                $roles = array();
                foreach($user->role as $role)
                {
                $roles[] = $role->role_name;
                }
                $user->role = implode(',',$roles);
           
        }

        if (empty($users)) {
            return Response::json(['response' => 'failed','message' => 'No result found']);
        } else {
            return Response::json(['response' => 'success','users' => $users]);
        }
    }
    
}
