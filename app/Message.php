<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject', 'content'];

    /**
     * Get the message details for the message.
     *
     * @return App\MessageDetail
     */
    public function details()
    {
        return $this->hasMany('App\MessageDetail');
    }

    /**
     * Get the users (senders) of the message.
     *
     * @return App\User
     */
    public function senders()
    {
        return $this->belongsToMany('App\User', 'message_details', 'sender_id', 'message_id');
    }

    /**
     * Get the users (receivers) of the message.
     *
     * @return App\User
     */
    public function receivers()
    {
        return $this->belongsToMany('App\User', 'message_details', 'receiver_id', 'message_id');
    }

}
