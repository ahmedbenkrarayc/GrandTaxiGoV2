<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Reservation;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        // Validate for a single product
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);

        session(['reservation' => $request->name]);

        $lineItem = [
            'price_data' => [
                'currency' => 'mad',
                'product_data' => [
                    'name' => $request->name,
                ],
                'unit_amount' => $request->price*100,
            ],
            'quantity' => 1
        ];

        // Create the session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItem], // Only one product
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $res = Reservation::find(session('reservation'));
        $res->is_paid = 1;
        $res->save();
        return "Payment Successful!";
    }

    public function cancel()
    {
        return "Payment Canceled!";
    }
}
