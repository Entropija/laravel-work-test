@extends('layouts.app')

@section('content')



<div class="container">
  
@if(session()->has('warning'))
<div class="message">
    <p class="alert alert-warning">{{session()->get('warning')}}</p>
</div>
@endif

@if(session()->has('success'))
<div class="message">
    <p class="alert alert-success">{{session()->get('success')}}</p>
</div>
@endif


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
