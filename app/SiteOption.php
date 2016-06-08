<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value'];
}
