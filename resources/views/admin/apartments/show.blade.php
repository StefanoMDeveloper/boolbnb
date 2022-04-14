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

    @foreach ($image as $apartmentImage)
        @if ($apartmentImage->main_image==1)
            <img src="{{ $apartmentImage->url }}" alt="">
        @endif
    @endforeach

    <ul>
        @foreach ($service as $apartmentService)
            <li>{{ $apartmentService->name }}</li>
            <li>{{ $apartmentService->slug }}</li>
        @endforeach
    </ul>

    <a href="{{route('admin.apartments.index')}}">
        <button type="button" class="btn btn-primary">INDEX</button>
    </a>
@endsection