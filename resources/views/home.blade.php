@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav flex-column">

    <li class="nav-item">
        <a class="nav-link" href="{{route('request')}}">Создать новую заявку</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('request-data')}}">Мои заявки</a>
    </li>
    
    </ul>

</div>
@endsection
