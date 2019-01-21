@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>
    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">

    <div class="mt-5 mb-5">
        <form action="{{ url($user->username) }}/follow" method="post">
            @if (session('success'))
                <span class="text-success mt-5 mb-5">{{ session('success') }}</span>
            @endif

             @if (session('error'))
                <span class="text-danger mt-5 mb-5">{{ session('error') }}</span>
            @endif

            <button class="btn btn-primary">Follow</button>
            @csrf
        </form>
    </div>

    <h1>Mensajes</h1>
    <div class="row">
        @foreach ($user->messages as $message)
            <div class="col-6">
                @include('messages.message')
            </div>
        @endforeach
    </div>
@endsection
