@extends('layouts.app')

@section('content')
<div
    class="container showContainer">
    <div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Nome:</h1>  
            <h3 class="mt-1" class="mt-1">{{Auth::user()->name}}</h3>     
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Cognome:</h1>  
            <h3 class="mt-1">{{Auth::user()->last_name}}</h3>
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Data di nascita:</h1>  
            <h3 class="mt-1">{{Auth::user()->birth_date->format('d/m/Y')}}</h3>
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Telefono:</h1>  
            <h3 class="mt-1">{{Auth::user()->phone}}</h3>
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Email:</h1>  
            <h3 class="mt-1">{{Auth::user()->email}}</h3>     
        </div>
        <a href="{{route('admin.profile')}}">Torna al tuo profilo</a>                                  
    </div>
</div>
@endsection