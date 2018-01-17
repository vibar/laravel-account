<?php

namespace Vibar\Account\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait ActiveLogin {

    use ActiveRedirect;

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $accountActivated = $user->account()->activated()->exists();

        if (! $accountActivated) {

            $token = $user->account->public_token;

            $this->guard()->logout();

            return $this->redirect(trans('account::activation.required'), false, $token);
        }

        $session = $user->account->session_id;

        if ($session) {
            Session::getHandler()->destroy($session);
        }

        $user->account->session_id = session()->getId();
        $user->account->save();

        return redirect()->intended($this->redirectPath());
    }
}