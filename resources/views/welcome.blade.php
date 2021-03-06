@extends ('layouts.app')

@section('content')

<div class="jumbotron text-center">
  <h1>Platzi Laravel</h1>
  <nav>
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
    </ul>
  </nav>
</div>

<div class="row">
    <form action="/messages/create" method="post" enctype="multipart/form-data">
        <div class="form-group @if ($errors->has('message')) is-invalid @endif">
            <input type="text" name="message" class="form-control @if ($errors->has('message')) is-invalid @endif" placeholder="Que estás pensando?">
            @if ($errors->has('message'))
                @foreach ($errors->get('message') as $error)
                    <div class="invalid-feedback">{{ $error }}</div>
                @endforeach
            @endif
            <br>
            <input type="file" class="form-control-file" name="image">
        </div>
        @csrf
    </form>
</div>

<div class="row">
  @forelse ($messages as $message)
    <div class="col-6 mt-5">
        @include('messages.message')
    </div>
  @empty
    <h3>No hay mensajes destacados...</h3>
  @endforelse
</div>

@if(count($messages))
    <div class="row">
        <div class="mt-5 mx-auto">
            {{ $messages }}
        </div>
    @endif
</div>

@endsection
