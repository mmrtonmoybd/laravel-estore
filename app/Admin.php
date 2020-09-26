<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPassword;
use Actuallymab\LaravelComment\CanComment;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, CanComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //protected $guarded = ['isAdmin'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isAdmin' => 'boolean',
    ];
    
    public function sendPasswordResetNotification($token) {
        $this->notify(new AdminResetPassword($token));
    }
    
    public function adminInfo() {
        return $this->hasOne('App\AdminInfo', 'admin_id', 'id');
    }
}