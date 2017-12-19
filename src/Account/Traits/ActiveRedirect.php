<?php

namespace Vibar\Account\Traits;


trait ActiveRedirect {

    /**
     * @param string $message
     * @param bool|null $activated
     * @param string|null $link
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect(string $message, bool $activated = null, string $link = null)
    {
        $response = redirect()
            ->route(config('account.activation.route'))
            ->with('account_message', $message);

        if ($activated !== null) {
            $response->with('account_status', $activated);
        }

        if ($link) {
            $response->with('account_link', route('activation.notify', $link));
        }

        return $response;
    }
}