<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Saving extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'savings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'user_id', 'type_id', 'items_amount',
        'debit', 'credit', 'balance', 'note', 'type'
    ];

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
     * Get the user that owns the saving.
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the category that owns the saving.
     *
     * @return App\Category
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the type that owns the saving.
     *
     * @return App\Type
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

}
