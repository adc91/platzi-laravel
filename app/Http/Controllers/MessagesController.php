<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMessageRequest;

use App\Message;

class MessagesController extends Controller
{
    public function create(CreateMessageRequest $request)
    {
        $user = $request->user();
        $image = $request->file('image');

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('message'),
            'image' => $image->store('messages', 'public')
        ]);

        return redirect('/messages/' . $message->id);
    }

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $messages = Message::search($query)->get();
        $messages->load('user');

        return view('messages.index', [
            'messages' => $messages
        ]);
    }

    public function toSearchableArray()
    {
        $this->load('user');

        return $this->toArray();
    }
}
