<?php

namespace App\Logic;


use App\Models\User;

class PushNotification
{

    private function sendNotification($tokens, $title, $body)
    {
        // TODO: Add from firebase
        $SERVER_API_KEY = '';

        $data = [
            "registration_ids" => $tokens,

            "notification" => [
                "title" => $title,
                "body" => $body,
                "sound" => "default" // required for sound on ios
            ],
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    }


    public function sendFCM($title, $body)
    {
        $tokens = User::pluck("device_token")->all();
        $this->sendNotification($tokens, $title, $body);
    }


    public function sendToSelect($tokens, $title, $body)
    {
        $this->sendNotification($tokens, $title, $body);
    }
}
