<img src="{{ $message->image }}" class="img-thumbnail">
<p class="card-text">
    <div class="text-muted">
        <img src="{{ $message->user->avatar }}" width="20px" alt="{{ $message->user->name }}"> Escrito por <strong><a href="{{ url($message->user->username) }}" title="Ir al perfil">{{ $message->user->name }}</a></strong></div>
    {{ $message->content }}
    <a href="/messages/{{ $message->id }}">Leer más</a>
</p>
<div class="card-text text-muted float-right">
    {{ $message->created_at }}
</div>
