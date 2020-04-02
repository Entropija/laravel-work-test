@extends('layouts.app')

@section('content')
<h1>Все заявки</h1>
<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Показать все</button>
  <button class="btn" onclick="filterSelection('status-0')"> Непросмотреные</button>
  <button class="btn" onclick="filterSelection('status-1')"> Просмотреные</button>
  <button class="btn" onclick="filterSelection('status-2')"> Принятые</button>
  <button class="btn" onclick="filterSelection('status-3')"> Закрытые</button>
</div>

    @foreach($data as $el)
    <div class="alert alert-info filterDiv status-{{$el->status}}">
        <h3>{{ $el->title }}</h3>
        <p>{{ $el->message_user}}</p>
        <p><small>{{$el->getstatus()}}</small></br>
        <small>Создано {{ $el->created_at}}</small></p>
        <a href="{{route('request-update', $el->id)}}"><button class="btn btn-warning">Изменить</button></a>
        @if($el->status !== 3)
        <a href="{{route('close', $el->id)}}"><button class="btn btn-danger">Закрыть</button></a>
        @endif
    </div>
    @endforeach
@endsection