<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Generalsettings;
use Route;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username() 
    {        
        return 'email';
    }

    protected function authenticated(Request $request, $user)
    {
        // General settings to session
        session(['mail.host'=> '']);
        session(['mail.port' => '']);
        session(['mail.username' => '']);
        session(['mail.password' => '']);
        
        $data = ['ok' => true, 'url' => Route::get("login")->uri];
        //$data = ['ok' => true, 'url' => $this->redirectPath()];
        
        if ($request->expectsJson()) {
            return response()->json($data, 200);
        }
    }
}
