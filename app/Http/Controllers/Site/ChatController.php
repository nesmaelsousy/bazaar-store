<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show($artisanId)
    {
        $artisan = User::findOrFail($artisanId);

        // هنا لاحقًا تجيب الرسائل بين الاثنين
        return view('chat.show', compact('artisan'));
    }
}
