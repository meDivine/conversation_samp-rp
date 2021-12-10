<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'vk_id',
        'avatar',
        'nickname',
        'capture_info',
        'notify_conversation',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function createOrRegister($email, $name, $avatar, $id) {
        return self::firstOrCreate(
            [
                'vk_id' => $id
            ],
            [
                'vk_id' => $id,
                'email' => $email,
                'name' => $name,
                'avatar' => $avatar,
                'nickname' => null
            ]);
    }

    public function updateUser($id, $avatar, $name, $email) {
        return self::where('vk_id', $id)
            ->update([
                'avatar' => $avatar,
                'name' => $name,
                'email' => $email
            ]);
    }

    public function getEnabledNotifyVK(): Collection {
        return self::select('vk_id')
            ->where('capture_info', true)->get();
    }

    public function getEnabledNotifyConversation(): Collection {
        return self::select('vk_id')
            ->where('notify_conversation', true)->get();
    }

    public function updateNotifyState(bool $war, bool $convers) {
        return self::find(Auth::id())->update([
            'capture_info' => $war,
            'notify_conversation' => $convers
        ]);
    }

    public function getNotifyState() {
        return self::select('notify_conversation', 'capture_info')
            ->where('id', Auth::id())
            ->first();
    }
}
