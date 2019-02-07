@extends('layouts.app')

@section('content')
    <div class="row">
        @forelse ($messages as $message)
            <div class="col-4 mt-5">
                @include('messages.message')
            </div>
        @empty
            <h3>No se encontraron mensajes...</h3>
        @endforelse
    </div>

    @if(count($messages))
        <div class="row">
            <div class="mt-5 mx-auto">
                {{ $messages }}
            </div>
        </div>
    @endif
@endsection
