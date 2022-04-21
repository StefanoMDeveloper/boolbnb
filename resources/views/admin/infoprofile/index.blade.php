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
            
            {{-- <h3 class="mt-1">{{(Auth::user()->birth_date)->format('d/m/Y')}}</h3> --}}
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Telefono:</h1>  
            <h3 class="mt-1">{{Auth::user()->phone}}</h3>
        </div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-4">Email:</h1>  
            <h3 class="mt-1">{{Auth::user()->email}}</h3>     
        </div>
        <a href="{{ URL::previous() }}">
            <button type="button" class="btn backBtn m-1 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                Torna indietro  
            </button>
        </a>                              
    </div>
</div>
@endsection