<?php

defined('ABSPATH') || exit; 

class GTPaymentHandler {
    private static $stripe; 
    
    public static function init() {
        /** Change this to .env variable. */
        self::$stripe = new \Stripe\StripeClient('sk_test_51HY24tJeh0ZH5mdeZ8qS4WTI4lIR7jVJXRbKRVHvdG4tgRKQBZ8yeHrpOXLQ7r6aA51kynaZOnq5i2HoC45vMbAy00C9QVIDuw');

    }


    public static function gt_create_stripe_customer(array $customer_details)
    {
       $customer = self::$stripe->customers->create($customer_details);
       return $customer;
    }

    /** 
     * Generates a Stripe Payment Link 
     * @param int|string - amount | booking_details 
     * @return URL 
     * @todo - Introduce Rate Limiting so user can only generate 5 links per hour. 
     */
    public static function gt_create_payment_link($amount, $booking_details = '')
    {
        try{
            $url = self::$stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'AED',
                            'unit_amount' => $amount,
                            'product_data' => [
                                'name' => $booking_details,
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'metadata' => array('talent_id' => get_current_user_id(), 'booking_id' => 1, 'talent_id' => 10),
                'success_url' => 'https://stripelink.free.beeceptor.com',
                'cancel_url' => 'https://stripelink.free.beeceptor.com',
            ]);
            return $url->url;
        }catch(Error $error){
            return new WP_Error('generate_payment_link', $error->getMessage(), array('status' => 400));
        }
    }

}

GTPaymentHandler::init();