@extends('layouts.app')

@section('content')

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
        @endif
    @endif
@endforeach

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

