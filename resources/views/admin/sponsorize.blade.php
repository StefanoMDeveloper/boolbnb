@extends('layouts.app')

@section('content')
<<<<<<< HEAD

<div class="container" id="dropin-container">
    @foreach ($sponsorships as $sponsorshippo)
        @if($loop->first)
            @if(count($apartment->active_sponsorships)<=0)
            
                <form action="{{route('api.make.payment')}}" method="post" id="payment-form">
                @csrf
                @method('POST')
                <h3><strong>Sceglie uno dei seguenti pacchetti promozionali:</strong></h3>
                    @foreach ($sponsorships as $sponsorship)
                    <div class="form-check col-10 pl-4">
                        <input class="form-check-input" type="radio" name="sponsorships[]" id="{{$sponsorship->id}}"
                        value="{{$sponsorship->id}}">
                        <label class="form-check-label" for="{{$sponsorship->id}}">
                            {{$sponsorship->name}}, {{$sponsorship->price}}, {{$sponsorship->duration}} ore
                        </label>  
                    </div>
                    @endforeach
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                    <input id="apartment" name="apartment" value="{{$apartment->id}}" type="hidden" />
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button type="submit">Sponsorizza</button>
                </form>
            @else
                <div class="container d-flex justify-content-center align-items-center">
                    Hai già una sponsorizzazione attiva!
                </div>
            @endif
=======
@dd($apartment->active_sponsorships)
@foreach ($sponsorships as $sponsorshippo)
    @if($loop->first)
        @if(count($apartment->active_sponsorships)<=0)
        <div class="container d-flex flex-column align-items-center" id="dropin-container">
            <form action="{{route('api.make.payment')}}" method="post" id="payment-form">
            @csrf
            @method('POST')
            <h3><strong>Scegliere uno dei seguenti pacchetti promozionali:</strong></h3>
                @foreach ($sponsorships as $sponsorship)
                  <div class="form-check col-10 pl-4">
                    <input class="form-check-input" type="radio" name="sponsorships[]" id="{{$sponsorship->id}}"
                    value="{{$sponsorship->id}}">
                    <label class="form-check-label" for="{{$sponsorship->id}}">
                        {{$sponsorship->name}}, {{$sponsorship->price}}, {{$sponsorship->duration}} ore
                    </label>  
                  </div>
                @endforeach
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
                <input id="apartment" name="apartment" value="{{$apartment->id}}" type="hidden" />
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button type="submit">Sponsorizza</button>
            </form>
        </div>
        @else
        @php
        $data = $apartment->active_sponsorships->getOriginal('start_date');
        dd($data);
        @endphp
        @dd($apartment->active_sponsorships)
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <div class="container d-flex flex-column justify-content-center align-items-center">
                <h1 class="sponsorAttivo">Hai già una sponsorizzazione attiva!</h1>
                <h2 class="sponsorDettagli">Tipologia: {{$sponsorshippo->name}}, iniziata il:{{$apartment->active_sponsorships->pivot_start_date}}, termina il:{{$apartment->active_sponsorships->pivot_end_date}}</h2>
                </div>
                <div class="container d-flex justify-content-center align-items-center">
                    <img class="tirchioMegalomane" src="{{asset('/storage/uploads/Zio-Paperone-e-i-soldi.jpg')}}">
                </div>
            </div>
>>>>>>> main
        @endif
    @endforeach

    <a href="{{ URL::previous() }}">
        <button type="button" class="btn backBtn m-1 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
            <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
            Torna indietro  
        </button>
    </a>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
<script>
    // $todayDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
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

