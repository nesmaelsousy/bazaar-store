<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class Conversation extends Model
{
    protected $fillable = [
        'client_id',
        'craftsmen_id',
        'store_id',
        'status',
        'last_message_at',
    ];
    protected $casts = [
        'last_message_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    // Relationship with other model
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function craftsmen()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    // وصول لاخر رسالة 
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
    // دالة لعد الرسائل غير المقروءة 
    public function unread($userId)
    {
        return $this->messages()->where('sender_id', '!=', $userId)
        ->where('is_read', false)->count();
    }
    // لما يسكر المحادثة 
    public function closeChat(){
        $this->update(['status'=>'closed']) ;
    }
     public function obenChat(){
        $this->update(['status'=>'active']) ;
    }


}
