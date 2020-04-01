@extends('layouts.app')

@section('content')
<h1>Создание заявки</h1>
    <form action={{ route('request-form') }} method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="title">Тема сообщения</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="message">Сообщение</label>
            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="file">Файл</label>
            <input type="file" name="file" class="form-control-file" id="file">
        </div>
        
        <button type="submit" name="button" class="btn btn-success">Отправить</button>
       
    </form>
@endsection
