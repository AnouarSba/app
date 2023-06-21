<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class FCMService
{ 
    public static function send($token, $notification, $data)
    {
        $fields = [
            "to" => $token,
            "priority" => 10,
            'notification' => $notification,
            'data' => $data,
            'vibrate' => 1,
            'sound' => 1
        ];

        $headers = [
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=AAAATIfgLWY:APA91bHEc9_zjozMjTeJaIqpjfjfQbjxzo-T-1ECeT_nNFoeTu3TFGSaFHx6E4nR39dJ0Q8IeoKPgxVGTeKNToBhVuqYe12MX9JMdLaY62avzdDoQ1dZwEtnpUBQbsZAb6G07cUapCL5'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}