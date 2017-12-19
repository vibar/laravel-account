<?php

namespace Vibar\Account\Controllers;


use App\Http\Controllers\Controller;
use Vibar\Account\Account;
use Vibar\Account\Notifications\ActivationLinkNotification;
use Vibar\Account\Traits\ActiveRedirect;

class ActivationController extends Controller
{
    use ActiveRedirect;

    /**
     * Resend activation link notification.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notify(string $token) {

        $account = Account::getByPublicToken($token);

        if (!$account) {
            return redirect()->route(config('account.activation.route'));
        }

        $account->user->notify(new ActivationLinkNotification($account->token));

        $account->resetPublicToken();

        return $this->redirect(trans('account::activation.required'), false);
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(string $token)
    {
        $account = Account::getByToken($token);

        if (!$account) {
            return redirect()->route(config('account.activation.route'));
        }

        $account->activate();

        return $this->redirect(trans('account::activation.performed'), true);
    }
}