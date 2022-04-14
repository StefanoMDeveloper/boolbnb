@extends('layouts.admin')
@section('content')
<h1 class="text-center">update:{{$apartment->name}}</h1>
<form action="{{route("admin.apartments.update", $apartment->id)}}" method="POST">
  @csrf
  @method('PUT')

  <!-- title -->
  <div class="form-group col-md-12">
    <label for="title">Titolo</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" placeholder="aggiungi nome dell'appartamento" value="{{old("name")??$apartment->name}}">
    
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <!-- number of rooms -->
  <div class="form-group col-md-12">
    <label for="rooms">Numero di stanze</label>
    <input type="number" id="rooms" name="rooms"
            min="10" max="100"
            value="{{old("rooms")??$apartment->rooms}}"
            class="form-control @error('rooms') is-invalid @enderror">

    @error('rooms')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- number of beds -->
  <div class="form-group col-md-12">
    <label for="beds">Numero di letti</label>
    <input type="number" id="beds" name="beds"
            min="10" max="100"
            class="form-control @error('beds') is-invalid @enderror">

    @error('beds')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- number of bathrooms -->
  <div class="form-group col-md-12">
    <label for="bathrooms">Numero di bagni</label>
    <input type="number" id="bathrooms" name="bathrooms"
            min="10" max="100"
            class="form-control @error('bathrooms') is-invalid @enderror">

    @error('bathrooms')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- metri quadrati -->
  <div class="form-group col-md-12">
    <label for="bathrooms">Metri quadrati</label>
    <input type="number" id="square_meters" name="square_meters"
            min="10" max="100"
            class="form-control @error('square_meters') is-invalid @enderror">

    @error('square_meters')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- address -->
  <div class="form-group col-md-12">
    <label for="address">Indirizzo completo</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="aggiungi l'indirizzo completo" value="{{old("address")??$apartment->address}}">
    @error('address')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <!-- sevices -->
  <div class="from-group">
    <label>Servizi</label>
    @foreach ($sevices as $sevice)
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="{{$sevice->slug}}"
        name="sevices[]" value="{{$sevice->id}}"
        @if($errors->any())       
          {{ in_array($sevice->id, old('sevices', [])) ? "checked" : ""}}
        @else
          {{ $apartment->sevices->contains($sevice) ? "checked" : ""}}
        @endif
        >
        <label class="form-check-label" for="{{$sevice->slug}}">
          {{$sevice->name}}
        </label>  
      </div>
    @endforeach
  </div>


  
  <button type="submit" class="btn btn-primary my-5">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
      <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
    </svg>
    Save</button>
  </form>
@endsection