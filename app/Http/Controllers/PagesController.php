<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class PagesController extends Controller
{
  public function home()
  {
    $messages = Message::latest()
        ->paginate(6);

    return view('welcome', compact('messages'));
  }

  public function language(Request $request)
  {
    session()->put('locale', $request->input('lang'));

    return back();
  }
}
