<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the categories that belong to the type.
     *
     * @return App\Category
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'savings');
    }

    /**
     * Get the users that belong to the type.
     *
     * @return App\User
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'savings');
    }
}
