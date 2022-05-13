<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'matricule' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->matricule, FILTER_VALIDATE_EMAIL) ? 'email' : 'matricule';
        if(auth()->attempt(array($fieldType => $input['matricule'], 'password' => $input['password'])))
        {
            return redirect('/admin');
        }else{
            return redirect('/login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }
}
