<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Conversation;
use App\PrivateMessage;

class UsersController extends Controller
{
    public function show($username = null)
    {
        $user = $this->findByUsername($username);

        return view('users.show', [
            'user' => $user
        ]);
    }

    public function follows($username = null)
    {
        $user = $this->findByUsername($username);

        return view('users.follows', [
            'user' => $user,
            'follows' => $user->follows
        ]);
    }

    public function followers($username = null)
    {
        $user = $this->findByUsername($username);

        return view('users.follows', [
            'user' => $user,
            'follows' => $user->followers
        ]);
    }

    public function follow($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        try {
            $me->follows()->attach($user);
        } catch (\Exception $err) {
            return redirect(url($username))->withError('No se ha podido seguir a este usaurio!');
        }

        return redirect(url($username))->withSuccess('Estás siguiendo a este usuario!');
    }

    public function unfollow($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        try {
            $me->follows()->detach($user);
        } catch (\Exception $err) {
            return redirect(url($username))->withError('No se ha podido dejar de seguir a este usaurio!');
        }

        return redirect(url($username))->withSuccess('Has dejado de seguir a este usuario!');
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();
        $message = $request->input('message');

        $conversation = Conversation::beetween($me, $user);

        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message
        ]);

        return redirect("/conversations/{$conversation->id}");
    }

    public function showConversation(Conversation $conversation)
    {
        $conversation->load('users', 'privateMessages');

        return view('users.conversation', [
            'conversation' => $conversation,
            'user' => auth()->user()
        ]);
    }

    private function findByUsername($username)
    {
        return User::where('username', $username)->first();
    }
}
