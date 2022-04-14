@extends('layouts.app')

@section('content')
    <h1>{{ $apartment->name }}</h1>
    <ul>
        <li>{{ $apartment->slug }}</li>
        <li>{{ $apartment->description }}</li>
        <li>{{ $apartment->rooms }}</li>
        <li>{{ $apartment->beds }}</li>
        <li>{{ $apartment->bathrooms }}</li>
        <li>{{ $apartment->square_meters }}</li>
        <li>{{ $apartment->address }}</li>
        <li>{{ $apartment->lat }}</li>
        <li>{{ $apartment->lon }}</li>
    </ul>

    @foreach ($images as $apartmentImage)
        @if ($apartmentImage->apartment_id==$apartment->id)
            <img src="{{ $apartmentImage->url }}" alt="">
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