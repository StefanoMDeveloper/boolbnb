@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex mb-3">
                <a href="{{route('admin.home')}}">
                    <button type="button" class="btn backBtn m-1 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                        <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                        Torna alla tua Dashboard  
                    </button>
                </a>
                <a href="{{ URL::previous() }}">
                    <button type="button" class="btn backBtn m-1 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                        <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                        Torna indietro  
                    </button>
                </a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Messaggi') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Benvenuto, {{Auth::user()->name}}.</h2>
                    <h3>Messaggi:</h3>
                    
                    @foreach ($messages as $message)
                    {{-- @dd($message->) --}}
                        <a href="{{ route('admin.apartments.show', $message->apartment->id) }}"><h4>{{ $message->apartment->name }}</h4></a>
                            <p><strong>{{ $message->object }}</strong></p>
                            <p>Da {{$message->name}} {{$message->lastname}} il {{$message->date->format('d/m/Y')}} < email: {{$message->email}} > </p>
                            <p>{{ $message->content }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
