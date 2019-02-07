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
        // $message = Message::findOrFail($id);

        return view('messages.show', compact('message'));
    }
}
