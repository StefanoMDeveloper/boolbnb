@extends('layouts.admin')

@section('content')
<h1 class="text-center">Inserire un nuovo appartamento </h1>
<form action="{{route("admin.apartments.store")}}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- title -->
  <div class="form-group col-md-12">
    <label for="title">Titolo</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" placeholder="aggiungi nome dell'appartamento" value="{{old("name")}}">
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

   <!-- number of rooms -->
   <div class="form-group col-md-12">
    <label for="rooms">Numero di stanze</label>
    <input type="number" id="rooms" name="rooms"
            min="10" max="100"
            value="{{old("rooms")}}"
            class="form-control @error('rooms') is-invalid @enderror">

    @error('rooms')
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

 
  <!-- sevice -->
   <div class="form-group">
    <label>Servizi</label>
    @foreach ($sevices as $sevice)
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="sevices[]" id="{{$sevice->id}}"
        value="{{$sevice->id}}"
        {{old("sevices") && in_array($sevice->id, old('sevices')) ? "checked" : ""}}
        >
        <label class="form-check-label" for="{{$sevice->id}}">
          {{$sevice->name}}
        </label>  
      </div>
    @endforeach
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>

 
@endsection