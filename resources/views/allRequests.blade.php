@extends('layouts.app')

@section('content')
<h1>Все заявки</h1>
    @foreach($data as $el)
    <div class="alert alert-info">
        <h3>{{ $el->title }}</h3>
        <p>{{ $el->message_user}}</p>
        <p><small>{{ $el->created_at}}</small></p>
        <a href="{{route('request-update', $el->id)}}"><button class="btn btn-warning">Изменить</button></a>
    </div>
    @endforeach
@endsection