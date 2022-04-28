@extends('layouts.app')

@section('content')

<div class="container" id="dropin-container">
@foreach ($sponsorships as $sponsorshippo)
    @if($loop->first)
        @if(count($apartment->active_sponsorships)<=0)
        <div class="container d-flex flex-column align-items-center" id="dropin-container">
            <form action="{{route('api.make.payment')}}" method="post" id="payment-form">
            @csrf
            @method('POST')
                <div class="container-title-sponsor">
                    <h1 class="text-center my-3">{{$apartment->name}}</h1>
                    @forelse ($apartment->images as $image)
                        @if($image->main_image)
                            <div class="title-image">
                                <img src="{{asset( 'storage/'.$image->url )}}" alt="">
                            </div>
                        @endif
                        @empty
                        Non c'è immagine
                    @endforelse            
                    <h3 class="">Scegliere uno dei seguenti pacchetti promozionali:</h3>
                </div>
                <div class="container-sponsor">
                    @foreach ($sponsorships as $sponsorship)
                    <div class="pacchettiSponsor">
                        <!--input class="form-check-input" type="radio" name="sponsorships[]" id="{{$sponsorship->id}}"
                        value="{{$sponsorship->id}}"-->
                        <label class="form-check-label labl" for="{{$sponsorship->id}}">
                        <input type="radio" name="sponsorships[]" value="{{$sponsorship->id}}" id="{{$sponsorship->id}}"/>
                        <div class="typeSponsor">
                            <span>Tipologia: {{$sponsorship->name}}</span>
                            <span>Prezzo: {{$sponsorship->price}}</span>
                            <span>Durata: {{$sponsorship->duration}} ore</span>           
                        </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
                <input id="apartment" name="apartment" value="{{$apartment->id}}" type="hidden" />
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <a class="d-inline-block mx-2" href="{{route('admin.apartments.index')}}">
                    <button type="button" class="btn btn-primary backBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                        <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                        Torna indietro
                    </button>
                </a>
                <button class="sponsorBtn" type="submit">Sponsorizza</button>
            </form>
        </div>
        @else
        @php
            $start_date = $apartment->active_sponsorships[0]->getOriginal('pivot_start_date');
            $end_date = $apartment->active_sponsorships[0]->getOriginal('pivot_end_date');
        @endphp
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <div class="container d-flex flex-column justify-content-center align-items-center">
                    <h1 class="sponsorAttivo">Hai già una sponsorizzazione attiva!</h1>
                    <h2 class="sponsorDettagli">Tipologia: {{$sponsorshippo->name}}, iniziata il: {{$start_date}}, termina il: {{$end_date}}</h2>
                </div>
                <div class="container d-flex justify-content-center align-items-center">
                    <img class="tirchioMegalomane" src="{{asset('/storage/uploads/Zio-Paperone-e-i-soldi.jpg')}}">
                </div>
            </div>
            <a href="{{route('admin.apartments.index')}}">
                <button type="button" class="btn btn-primary backBtn2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                    <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                    Torna indietro
                </button>
            </a>
            @endif
        @endif
    @endforeach
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
<script>
    // $todayDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        locale: "it_IT",
    }, function (createErr, instance) {
        if (createErr) {
        console.log('Create Error', createErr);
        return;
        }
        form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
            console.log('Request Payment Method Error', err);
            return;
            }
            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
        });
        });
    });
</script>
@endsection

