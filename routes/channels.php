<?php
use Illuminate\Support\Facades\Route;
use App\Models\Conversation;

Broadcast::channel('conversation.{conversation_id}', function ($user, $conversation_id) {
    $conversation = Conversation::find($conversation_id);
    
    if ($conversation && 
        ($conversation->client_id == $user->id || $conversation->craftsmen_id == $user->id)) {
        return ['id' => $user->id, 'name' => $user->name];
    }
    
    return false;
});