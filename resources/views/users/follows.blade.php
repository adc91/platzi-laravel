@extends('layouts.app')

@section('content')
<h4>Personas a las que sigue {{ $user->name }}</h3>
<div class="row">
    @foreach($follows as $follow)
        <li>
            <img src="{{ $follow->avatar }}" alt="{{ $follow->name }}" height="18"> <a href="{{ url($follow->username) }}">{{ $follow->username }}</a>
        </li>
    @endforeach
</div>
@endsection

<style>
ul, li {
    width: 100%;
    list-style: none;
    margin: 5px;
}
</style>
