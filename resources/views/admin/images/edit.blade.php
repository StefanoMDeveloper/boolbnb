@extends('layouts.app')
@section('content')    
    <!-- Sempre le immagini -->
    @forelse($apartment->images as $image)
      <div class="ml-3 d-flex my-4">
        <div class="imgContainer ml-3 mr-3">
          <img src="{{asset( 'storage/'.$image->url )}}" alt="">
        </div>
        <form class="col-5" action="{{route("admin.images.update", $image->id)}}" method="POST">
          @csrf
          <label class="d-flex mr-3" for="main_image">
            @if($image->main_image)
              Al momento questa è l'immagine principale del tuo appartamento.
            @else
              Vuoi che questa sia l'immagine principale del tuo appartamento?
              <button type="submit" class="saveBtn ml-2">Imposta come immagine principale</button>
            @endif
          </label>
        </form>
        
        <button data-toggle="modal" data-target="#modal-delete-{{$image->id}}" type="button" class="btn btn-secondary cancelBtn" style="height: 60px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
          <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
          Elimina
        </button>
        <div class="modal fade" id="modal-delete-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        Sicuro di voler eliminare questa immagine?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annulla</button>
                        <form  action="{{ route('admin.images.destroy', $image->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button  type="submit" class="btn btn-danger ml-1 text-white" >
                            Cancella
                            </button>                                            
                        </form>
                    </div>
                </div>
            </div>     
        </div>     
      </div>
    @empty
      Al momento non ci sono immagini.
    @endforelse  
@endsection