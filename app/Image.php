<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url', 'slug', 'type', 'user_id', 'note', 'wMoreH', 'status'];

    /**
     * Get the user that owns the image.
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user_category that owns the image.
     *
     * @return App\UserCategory
     */
    public function user_category()
    {
        return $this->belongsTo('App\UserCategory');
    }

}
