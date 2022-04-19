@extends('layouts.app')

@section('content')
    <h1>{{ $apartment->name }}</h1>
    <ul>
        <li>{{ $apartment->slug }}</li>
        <li>{{ $apartment->description }}</li>
        <li>Stanze totali: {{ $apartment->rooms }}</li>
        <li>Camere da letto: {{ $apartment->beds }}</li>
        <li>Bagni: {{ $apartment->bathrooms }}</li>
        <li>Metri quadrati: {{ $apartment->square_meters }}</li>
        <li>{{ $apartment->address }}</li>
        <li>{{ $apartment->lat }}</li>
        <li>{{ $apartment->lon }}</li>
    </ul>

    @foreach ($apartment->images as $image)
        <img src="{{asset( 'storage/'.$image->url )}}" alt="">
    @endforeach

    <h3>Servizi</h3>
    <ul>
        @foreach ($apartment->services as $service)
            <li>{{ $service->name }}</li>
        @endforeach
    </ul>

    <h3>Messaggi</h3>
    @forelse ($apartment->messages as $message)
        <p><strong>{{ $message->object }}</strong></p>
        <p>Da {{$message->name}} {{$message->lastname}} il {{$message->date}} < email: {{$message->email}} > </p>
        <p>{{ $message->content }}</p>
    @empty
        Non si sono messaggi!
    @endforelse

    <h3>Visualizzazioni</h3>
    @forelse ($apartment->views as $view)
        <p>{{$view->ip}} il {{$view->date}}</p>
    @empty
        <p>Non ci sono visualizzazioni!</p>
    @endforelse


    <a href="{{route('admin.apartments.index')}}">
        <button type="button" class="btn btn-primary">Torna indietro</button>
    </a>
    <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
        @csrf
        @method("DELETE")
        <button onclick="return confirm('Sicuro di voler cancellare questo post?');" type="submit" class="btn btn-danger my-1">Cancella</button>
    </form>
@endsection