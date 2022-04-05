<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function getSession(Request $request){

        $stripe = new StripeClient(env('STRIPE_API_KEY'));
          $checkout_session = $stripe->checkout->sessions->create([
            'success_url' => 'http://127.0.0.1:8000/success',
            'cancel_url' => 'http://127.0.0.1:8000/cancel',
            'line_items' => [
              [
                'price_data' => [
                    'product_data'=>[
                        'name'=>'LLC-Registration'
                    ],
                    'unit_amount'=>'2000',
                    'currency'=>'USD',
                ],
                'quantity'=>1,
                
               
              ],
            ],
            'mode' => 'payment',
          ]);
          
        return $checkout_session;
    }

    public function webhook(Request $request){
      $endpoint_secret = env('WEBHOOK_KEY');
      
      $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
      $payload = @file_get_contents('php://input');
      
      $event = null;

      try {
          $event = \Stripe\Webhook::constructEvent(
              $payload, $sig_header, $endpoint_secret
          );
      } catch(\UnexpectedValueException $e) {
          // Invalid payload
          http_response_code(400);
          exit();
      } catch(\Stripe\Exception\SignatureVerificationException $e) {
          // Invalid signature
          http_response_code(400);
          exit();
      }
      if($request->type=='checkout.session.completed'){
        Log::info("it,s all done");
        echo 'Payment it done';
      }

      return response()->json(["status"=>'success']);
    }
}
