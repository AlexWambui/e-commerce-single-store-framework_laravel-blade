<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class GeneralPageController extends Controller
{
    public function index()
    {
        return view('general-pages.index');
    }

    public function about()
    {
        return view('general-pages.about');
    }

    public function shop()
    {
        return view('general-pages.shop');
    }

    public function contact()
    {
        return view('general-pages.contact');
    }

    public function storeMessage(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|string|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string|min:4',
        ]);

        Message::create($validated_data);

        return redirect()->back()->with('success', 'Your message has been sent');
    }

    public function listMessages()
    {
        $messages = Message::latest()->get();
        $count_all_messages = $messages->count();
        $count_unread_messages = $messages->where('viewed', 0)->count();

        return view('messages.index', compact('count_all_messages', 'count_unread_messages', 'messages'));
    }

    public function showMessage(Message $message)
    {
        if($message->viewed == 0) {
            $message->update(['viewed' => 1]);
        }

        return view('messages.show', compact('message'));
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message has been deleted');
    }
}
