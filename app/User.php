<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Str;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'name', 'email', 'password', 'profil_img',
        'address', 'phone', 'id_card_number', 'status', 'created_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_key', 'role_id'];

    /**
     * List value of user statuses.
     *
     * @var array
     */
    protected $statuses = ['Aktif', 'Non Aktif', 'Banned'];

    /**
     * Always set and make name attribute as Camel Case if not empty.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['name'] = ucwords($value);
        }
    }

    /**
     * Always set and hash the password attribute if not empty.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * Always get created_at attribute with the following format.
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        $date = Carbon::parse($this->attributes['created_at']);

        return $date->format('d F Y H:i:s');
    }

    /**
     * Always get updated_at attribute with the following format.
     *
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        $date = Carbon::parse($this->attributes['updated_at']);

        return $date->format('d F Y H:i:s');
    }

    /**
     * Get the roles record associated with the user.
     *
     * @return App\Role
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Get the savings for the user.
     *
     * @return App\Saving
     */
    public function savings()
    {
        return $this->hasMany('App\Saving');
    }

    /**
     * Get the images for the user.
     *
     * @return App\Image
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * Get the messages that belong to the user.
     *
     * @return App\Message
     */
    public function messages()
    {
        return $this->belongsToMany('App\Message', 'message_details', 'message_id', 'sender_id');
    }

    /**
     * Check is user has given role or not.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasRole($name)
    {
        return Str::upper($this->role->name) == Str::upper($name);
    }

    /**
     * Get user balance based on last balance in savings.
     *
     * @param  string  $created_at
     * @return int
     */
    public function balance($created_at = null)
    {
        if (null !== $created_at) {
            if ("" != $created_at) {
                $created_at = (new Carbon($created_at))->toDateTimeString();
            } else {
                $created_at = Carbon::now()->toDateTimeString();
            }
            $lastSaving = $this->savings()->where('created_at', '<=', $created_at)->orderBy('created_at', 'DESC')->first();
        } else {
            $lastSaving = $this->savings()->orderBy('created_at', 'DESC')->first();
        }

        return (null === $lastSaving) ? null : $lastSaving->balance;
    }

    /**
     * Get user items_amount total in savings.
     *
     * @return int
     */
    public function itemsAmountTotal()
    {
        return $this->savings()->sum('items_amount');
    }

    /**
     * Get list value of statuses.
     *
     * @return array
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Display user profil image.
     *
     * @return string
     */
    public function getProfilImg()
    {
        if (!empty($this->profil_img)) {
            $img = $this->profil_img;
        } else {
            $img = "assets/images/default-avatar.png";
        }
        return "<img src='" . asset($img) . "' width='20px' />";
    }

}
