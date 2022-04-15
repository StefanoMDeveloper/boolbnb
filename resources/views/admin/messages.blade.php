@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('admin.home')}}">Torna alla tua Dashboard</a>
            <div class="card">
                <div class="card-header">{{ __('Messaggi') }}</div>

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Benvenuto, {{Auth::user()->name}}.
                    <h3>Messaggi:</h3>
                    
                    @foreach ($apartments as $apartment)                        
                        @foreach ($apartment->messages as $message)
                            <h4>{{ $apartment->name }}</h4>
                            <p><strong>{{ $message->object }}</strong></p>
                            <p>Da {{$message->name}} {{$message->lastname}} il {{$message->date}} < email:{{$message->email}} > </p>
                            <p>{{ $message->content }}</p>
                            
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
