<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'debit', 'credit', 'balance', 'note', 'type', 'status'
    ];

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
