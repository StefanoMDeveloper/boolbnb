@extends('layouts.app')

@section('content')
<div class="container showContainer">
    <div class="row container-profile">
        <h3 class="text-center">
            {{Auth::user()->name}}, eccoti nel tuo profilo personale!
        </h3>
        <div class="profile">
            <div class="profileBox">
                <a href="{{route('admin.infoprofile')}}">Informazioni personali</a>
            </div>
            <div class="profileBox">
                <a href="{{route('admin.apartments.index')}}">Appartamenti</a>
            </div>
            <div class="profileBox">
                <a href="{{route('admin.messages')}}">Messaggi</a>
            </div>
            <div class="profileBox">
                <a href="{{route('password.update')}}">Statistiche</a>
            </div>
            <div class="profileBox">
                <a href="{{route('password.update')}}">Ripristina la password</a>
            </div>
            <div>
                <a href="{{route('admin.home') }}">Torna alla Dashboard</a>                                        
            </div>
        </div>
    </div>
</div>
@endsection

