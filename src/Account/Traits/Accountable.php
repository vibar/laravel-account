<?php

namespace Vibar\Account\Traits;


use Vibar\Account\Account;

trait Accountable
{
    /**
     * Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function account()
    {
        return $this->hasOne(Account::class);
    }
}