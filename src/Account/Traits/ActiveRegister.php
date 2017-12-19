<?php

namespace Vibar\Account\Traits;


use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vibar\Account\Notifications\ActivationLinkNotification;

trait ActiveRegister {

    use ActiveRedirect;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $account = null;

        DB::transaction(function () use ($request, &$account) {

            $user = $this->create($request->all());

            $account = $user->account()->create();

            $user->notify(new ActivationLinkNotification($account->token));

            event(new Registered($user));

        });

        return $this->redirect(trans('account::activation.required'), false, $account->public_token);
    }
}