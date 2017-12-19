<?php

namespace Vibar\Account\Traits;


use Illuminate\Http\Request;

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
    }
}