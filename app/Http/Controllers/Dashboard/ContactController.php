<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(10);

        return view('dashboard.contacts.index', compact('messages'));
    }
    public function show(Contact $message)
    {
        // $message = Contact::findOrFail($id);
        $message->update([
            'read_at' => 'true'
        ]);
        return view('dashboard.contacts.show', compact('message'));
    }
    public function replay(Request $request, Contact $message)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        Mail::raw($request->reply, function ($mail) use ($message) {
            $mail->to($message->email)
                ->subject('Reply from Bazaar Support');
        });
        return back();
    }
}
