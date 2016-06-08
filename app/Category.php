<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'price'];

    /**
     * Get the users that belong to the category.
     *
     * @return App\User
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'savings');
    }

    /**
     * Get the types that belong to the category.
     *
     * @return App\Type
     */
    public function types()
    {
        return $this->belongsToMany('App\Type', 'savings');
    }

}
