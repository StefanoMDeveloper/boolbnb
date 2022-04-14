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

    @foreach ($images as $apartmentImage)
        @if ($apartmentImage->apartment_id==$apartment->id)
            <img src="{{ $apartmentImage->url }}" class="img-thumbnail" alt="">
        @endif
    @endforeach

    <ul>
        @foreach ($apartment->services as $service)
            <li>{{ $service->name }}</li>
        @endforeach
    </ul>

    <a href="{{route('admin.apartments.index')}}">
        <button type="button" class="btn btn-primary">INDEX</button>
    </a>
@endsection