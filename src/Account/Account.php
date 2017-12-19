<?php

namespace Vibar\Account;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    /**
     * {@inherit}
     */
    protected $fillable = ['user_id', 'token', 'public_token'];

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Scope activated accounts.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActivated($query)
    {
        return $query->whereNotNull('activated_at');
    }

    /**
     * Scope not activated accounts.
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotActivated($query)
    {
        return $query->whereNull('activated_at');
    }

    /**
     * Get account by token.
     *
     * @param string $token
     * @return mixed
     */
    public static function getByToken(string $token)
    {
        return static::where('token', $token)
            ->notActivated()
            ->first();
    }

    /**
     * Get account by public token.
     *
     * @param string $token
     * @return mixed
     */
    public static function getByPublicToken(string $token)
    {
        return static::where('public_token', $token)
            ->notActivated()
            ->first();
    }

    /**
     * Activate user account.
     */
    public function activate()
    {
        $this->activated_at = Carbon::now();
        $this->save();
    }

    /**
     * Reset public token.
     */
    public function resetPublicToken()
    {
        $this->public_token = Str::random(60);
        $this->save();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            $account->token = Str::random(60);
            $account->public_token = Str::random(60);
        });
    }

}
