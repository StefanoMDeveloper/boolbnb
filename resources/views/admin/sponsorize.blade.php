@extends('layouts.app')

@section('content')

@foreach ($sponsorships as $sponsorshippo)
    @if($loop->first)
        @if(count($apartment->active_sponsorships)<=0)
        <div class="container" id="dropin-container">
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
        </div>
        @else
            <div class="container d-flex justify-content-center align-items-center">
                Hai già una sponsorizzazione attiva!
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

