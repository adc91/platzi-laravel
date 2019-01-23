@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>
    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">

    <p class="mt-2">
        <a class="btn btn-link" href="{{ url($user->username) }}/follows">
            Sigue a <span class="badge badge-secondary">{{ $user->follows->count() }}</span>
        </a>
        &nbsp;
        <a class="btn btn-link" href="{{ url($user->username) }}/followers">
            Seguidores <span class="badge badge-secondary">{{ $user->followers->count() }}</span>
        </a>
    </p>

    @if (Auth::check())
        @if (Gate::allows('dms', $user))
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Contactar</h4>
                    <form action="{{ url($user->username) }}/dms" method="post">
                        <input type="text" name="message" class="form-control" placeholder="Escriba su mensaje...">
                        <button type="submit" class="btn btn-primary mt-4">Enviar DM</button>
                        @csrf
                    </form>
                </div>
            </div>
        @endif

        @if (!Auth::user()->isFollowing($user))
            @if (Auth::id() !== $user->id)
                <div class="mt-3 mb-3">
                    <form action="{{ url($user->username) }}/follow" method="post">
                        @if (session('success'))
                            <div class="text-success mt-1 mb-1">{{ session('success') }}</div>
                        @endif

                         @if (session('error'))
                            <div class="text-danger mt-1 mb-1">{{ session('error') }}</div>
                        @endif

                        <button class="btn btn-primary">Seguir</button>
                        @csrf
                    </form>
                </div>
            @endif
        @else
            <div class="mt-3 mb-3">
                <form action="{{ url($user->username) }}/unfollow" method="post">
                    @if (session('success'))
                        <div class="text-success mt-1 mb-1">{{ session('success') }}</div>
                    @endif

                     @if (session('error'))
                        <div class="text-danger mt-1 mb-1">{{ session('error') }}</div>
                    @endif

                    <button class="btn btn-danger">Dejar de seguir</button>
                    @csrf
                </form>
            </div>
        @endif
    @endif

    <h1>Mensajes</h1>
    <div class="row">
        @foreach ($user->messages as $message)
            <div class="col-6">
                @include('messages.message')
            </div>
        @endforeach
    </div>
@endsection
