<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Data\Repositories\User\UserRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $users = $this->userRepository->all();
        $data = '';
        if ($request->ajax()) {
            foreach ($users as $user) {
                $data .= '<tr><td>' . $user->name . ' </td>'
                    . '<td>' . $user->gender . '</td>  '
                    . '<td>' . $user->location . '</td>  '
                    . '<td>' . $user->email . '</td>  '
                    . '<td>' . $user->phone . '</td>  '
                    . '<td><img src="' . $user->picture . '" /></td>'
                    . '<td><a href="' . route('user.edit', $user->id) . '" class="btn btn-success btn-sm rounded-0" title="Edit"><i class="fa fa-edit"></i></a></tr>';
            }
            return $data;
        }
        return view('user.index')
            ->with("users", $users);
    }

    /**
     * Edit the user object
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepository->get($id);
            return view('user.edit', compact(
                'user'
            ));
        } catch (\Exception $exe) {
            return redirect()->back()->withErrors($exe->getMessage());
        }
    }
    /**
     * Update user data.
     *
     * @param Request $request,$id
     *
     * @return Renderable
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $save = $this->userRepository->update($data, $id);
            if ($save) {
                return redirect()->route('index');
            }
        } catch (\Exception $exe) {
            return redirect()->back()->withInput()->withErrors($exe->getMessage());
        }
    }

    public function userExport()
    {
        return Excel::download(new UserExport, 'user.xlsx');
    }

    public function fetchUser()
    {
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://randomuser.me/api/', ['verify' => false]);
            $values = json_decode($response->getBody(), true);
            if ($response->getStatusCode() === 200) {
                // dd($data['results'][0]);
                $data['name'] = $values['results'][0]['name']['title'] . " " . $values['results'][0]['name']['first'] . " " . $values['results'][0]['name']['last'];
                $data['phone'] = $values['results'][0]['phone'];
                $data['email'] = $values['results'][0]['email'];
                $data['gender'] = $values['results'][0]['gender'];
                $data['location'] = $values['results'][0]['location']['street']['name'] . "," . $values['results'][0]['location']['city'] . "," . $values['results'][0]['location']['state'] .
                    "," . $values['results'][0]['location']['country'] . "," . $values['results'][0]['location']['postcode'];
                $data['picture'] = $values['results'][0]['picture']['large'];
                $this->userRepository->create($data);
                // Session::flash("success", "User Saved Successfully");
                return redirect()->route('index')->with('success', "User Saved Successfully.");
            } else {
                return redirect()->route('index')->with('success', "Opps... Something went wrong.");
            }
        } catch (\Exception $exe) {
            return false;
        }
    }
}
