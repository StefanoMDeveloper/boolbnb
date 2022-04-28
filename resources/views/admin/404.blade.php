@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-404">
        <h1 class="title-404">Attenzione {{Auth::user()->name}}!</h1>
        <div class="error-404">
            <h3> Non hai i permessi per accedere a questo appartamento.</h3>
            <p>
                <a class="404-back" href="{{route('admin.apartments.index')}}">
                    <button type="button" class="btn backBtn m-1 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                        <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                        Torna ai tuoi appartamenti
                    </button>
                </a>                              
            </p>
        </div>
    </div>
</div>
@endsection
