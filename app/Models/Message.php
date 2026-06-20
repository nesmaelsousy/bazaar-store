<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'read_at',
        'is_read',
    ];
    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    // Relationship 
    public function Conversation()
    {
        return $this->belongsTo(Message::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    // تحديث قراءة المحادثة 
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }

    }
    // Accessor لتنسيق الوقت
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('H:i');
    }

    // اسم المرسل
    public function getSenderNameAttribute(): string
    {
        return $this->sender?->name ?? 'Unknown';
    }
}
