<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use TG\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Session;
use Redirect;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override Login GET
     * @param  LoginRequest
     */

    public function showLoginForm()
    {
        dd(1);
        //session(['link' => url()->previous()]);
        return view('auth.login');
    }

    /**
     * Override Login Post
     * @param  LoginRequest
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();
        $data = HelperController::cleanArray($data);

        $remember = ($request->has('remember')) ? true : false;

        if (Auth::check()) {
            Auth::logout();
        }

        if (Auth::attempt(array('email' => $data["email"], 'password' => $data["password"], 'is_active' => 1), $remember)) {
            if(in_array(Auth::user()->role_id, [ 3, 4 ])) {
                Auth::logout();
                return redirect('/');
            }

            // FORGET SESSION
            Session::forget("member_id");
            Session::forget("member_name");

            // FORGET COOKIE
            setcookie("member_id", "", time() - 3600, "/");
            setcookie("member_name", "", time() - 3600, "/");

            if(strpos(session('link'), '/'.BACKEND_URL_PREFIX) !== false){
                return redirect(session('link'));
            } 
            return redirect(BACKEND_URL_PREFIX . '/home');
            
        } else {
            // Something went wrong.
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
