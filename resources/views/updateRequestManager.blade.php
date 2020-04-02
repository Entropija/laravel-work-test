@extends('layouts.app')

@section('content')
    <h1>Заявка №{{$data->id}}</h1>
    <div>
        <h3>{{ $data->title }}</h3>
        <p>{{ $data->message_user}}</p>
        @isset($data->url_file) 
            <a href="/storage/{{$data->url_file}}"> Загруженный файл </a>
        @endisset
        <p><small>{{$data->getstatus()}}</small></br>
        <small>Создано {{ $data->created_at}}</small></p>
    </div>
    <form action={{ route('request-update-manager-submit', $data->id) }} method="post" >
    @csrf
        <div class="form-group">
            <label for="message">Сообщение менеджера</label>
            <textarea class="form-control"  name="message" id="message" rows="3">{{$data->message_manager}}</textarea>
        </div>
        <button type="submit" name="button" class="btn btn-success">Сохранить</button>
        @if($data->status !== 3)
            <a href="{{route('accept', $data->id)}}" type="button"  class="btn btn-success">Принять</a>
        @endif  
       
    </form>
   

@endsection
