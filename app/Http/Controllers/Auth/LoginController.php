<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Desa;
use App\User;
use Auth;

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
     * Define username as login field.
     *
     * @return string
     */
    public function username () {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $desa = Desa::where('kode_desa', $request->kode_desa)->first();
        
        if ($desa === null) {
            return false;
        }
        $request->merge(['desa_id' => $desa->id]);
        return $this->guard()->attempt(
            $request->only('username', 'password', 'desa_id'),
            $request->filled('remember')
        );
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $user = User::where('username', $request->username)
            ->first();

        return !is_null($user) && \Hash::check($request->password, $user->password);
    }
}
