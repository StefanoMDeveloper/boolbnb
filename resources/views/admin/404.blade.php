@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 class="card-body text-center">
            {{Auth::user()->name}}, non hai i permessi per accedere a questo appartamento!
            <br>
            <a href="{{route('admin.apartments.index')}}">Torna ai tuoi appartamenti</a>
        </h3>
    </div>
</div>
@endsection
