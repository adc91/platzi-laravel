@extends('layouts.app')

@section('content')
<form action="{{ url('/auth/facebook/register') }}" method="post">
    <div class="card">
        <div class="card-body">
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar">
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
    </div>
    @csrf
</form>

<style type="text/css">
.avatar {
    display: table;
    margin: 0 auto;
}
</style>

@endsection
