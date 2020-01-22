<?php


namespace Looxis\Gate;

use Auth;
use Redirect;
use Exception;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

trait LoginControllerTrait
{
    protected $redirectAfterLogout = '/login';

    public function showLoginForm()
    {
        if (\LooxisGate::enabled() && !request()->exists('local')) {
            return $this->redirectToProvider();
        }
        return view('auth.login');
    }

    public function loggedOut(Request $request)
    {
        if (\LooxisGate::enabled()) {
            return redirect($this->gate()->getLogoutUrl());
        }

        return redirect('/');
    }


    public function gate()
    {
        return Socialite::driver('gate');
    }


    /**
     * Redirect the user to the auth provider's authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return $this->gate()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = $this->gate()->user();
        } catch (Exception $e) {
            return Redirect::to('auth');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to($this->redirectTo);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $gateUser
     * @return User
     */
    private function findOrCreateUser($gateUser)
    {
        if ($authUser = User::where('gate_id', $gateUser->id)->first()) {
            return $authUser;
        }
        if ($authUser = User::where('email', $gateUser->email)->first()) {
            $authUser->update([
                'gate_id' => $gateUser->id
            ]);
            return $authUser;
        }

        return User::create([
            'name' => $gateUser->name,
            'email' => $gateUser->email,
            'gate_id' => $gateUser->id,
            'api_token' => Str::random(60),
            'password' => '',
        ]);
    }
}