<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function makePayment(Request $request, Gateway $gateway){
        $data=$request->all();
        if(isset($data['sponsorships'])){
            $sponsorship = Sponsorship::find($data['sponsorships'][0]);
            $price = $sponsorship->price;
        } else {
            $data = [
                "message" => "Transazione fallita"
            ];
            return response()->json($data,401);
       }
        $apartment = Apartment::find($data['apartment']);

       $result = $gateway->transaction()->sale([
           'amount' => $price,
           'paymentMethodNonce' => $data['payment_method_nonce'],
           'options' => [
               'submitForSettlement' => true
           ]
       ]);

       if($result->success){
            $data = [
                "message" => "Transazione effettuata con successo!"
            ];
            return redirect()->route('admin.sponsorships.store', compact('apartment','sponsorship'));
       } else {
            $data = [
                "message" => "Transazione fallita"
            ];
            return response()->json($data,401);
       }
    }
}