@extends('layouts.app')

@section('content')
<div class="container showContainer">
    <p>Nome: {{Auth::user()->name}}</p>
    <p>Cognome: {{Auth::user()->last_name}}</p>
    <p>Data di nascita: {{Auth::user()->birth_date}}</p>
    <p>Telefono: {{Auth::user()->phone}}</p>
    <p>Email: {{Auth::user()->email}}</p>
</div>
@endsection