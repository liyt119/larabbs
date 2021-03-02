<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use MustVerifyEmailTrait;
    use Traits\ActiveUserHelper;
    use Traits\LastActivedAtHelper;
    use HasRoles;
    use Notifiable{
      notify as protected laravelNotify;
    }

    public function setAvatarAttribute($path)
    {
      if(! \Str::startsWith($path,'http'))
      {
        $path = config('app.url') . "/uploads/images/avatars/$path";
      }
      $this->attributes['avatar'] = $path;
    }


    public function setPasswordAttribute($value)
    {
      if(strlen($value)!=60)
      {
        $value=bcrypt($value);
      }

      $this ->attributes['password'] = $value;
    }

    public function markAsRead()
    {
      $this->notification_count = 0;
      $this->save();
      $this->unreadNotifications->markAsRead();
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    public function replies()
    {
      return $this->hasMany(Reply::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
      return $this->id == $model->user_id;
    }
}
