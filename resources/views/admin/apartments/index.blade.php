@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('admin.home')}}">
        <button type="button" class="btn btn-success backBtn m-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
            <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
            Torna alla tua Dashboard
        </button>
    </a>
    <a href="{{ route('admin.apartments.create') }}">
        <button type="button" class="btn btn-success addBtn m-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
            <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/></svg>
            Aggiungi appartamento
        </button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Immagine Principale</th>
                <th scope="col">Nome dell'Host</th>
                <th scope="col">Numero stanze</th>
                <th scope="col">Numero di letti</th>
                <th scope="col">Numero di bagni</th>
                <th scope="col">Metri Quadrati</th>
                <th scope="col">Indirizzo Completo</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apartments as $apartment)
                @if (Auth::user()->id == $apartment->user_id)
                    <tr>
                        <th scope="row">{{ $apartment->id }}</td>
                        <td>{{ $apartment->name }}</td>
                        @forelse ($apartment->images as $image)
                            @if ($image->main_image)
                            <td class="w-100">
                                <img class="w-100" src="{{asset( 'storage/'.$image->url )}}" alt="">
                            </td>
                            @endif
                        @empty
                            <td class="w-100">
                                -
                            </td>
                        @endforelse
                        <td>
                            {{Auth::user()->name}}{{Auth::user()->lastname}}                          
                        </td>
                        <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->bathrooms }}</td>
                        <td>{{ $apartment->square_meters }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>
                            <a href="{{ route('admin.apartments.show', $apartment->id) }}">
                                <button type="button" class="btn btn-primary my-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 576 512">
                                    <path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>
                                    Mostra
                                </button></a>
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}">
                                <button type="button" class="btn btn-warning my-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                                    Modifica
                                </button></a>
                                <button data-toggle="modal" data-target="#modal-delete-{{$apartment->id}}" type="button" class="btn btn-danger p-2 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
                                    <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                                    Elimina 
                                </button>
                                <div class="modal fade" id="modal-delete-{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete2" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Sicuro di voler cancellare questo post? 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annulla</button>
                                                <form  action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button  type="submit" class="btn btn-danger ml-1 text-white" >
                                                       Cancella
                                                    </button>                                            
                                                </div>
                                            </form>
                                        </div>
                                    </div>     
                                </div>     
                        </td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
</div>
@endsection