@extends('layouts.app')

@section('content')
    <h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>

    @foreach ($conversation->privateMessages as $message)
        <div class="card mb-4">
            <div class="card-header">
                <img src="{{ $message->user->avatar }}" alt="{{ $message->user->name }}" width="18">
                {{ $message->user->name }} dijo...
            </div>
            <div class="card-body">
                {{ $message->message }}
            </div>
            <div class="card-footer">
                El {{ date('Y-m-d H:i', strtotime($message->created_at)) }}
            </div>
        </div>
    @endforeach

@endsection
