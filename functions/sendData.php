<?php

function sendData(string $name, string $phone, string $test):string
{
    $url = 'https://order.drcash.sh/v1/order';
    $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer NWJLZGEWOWETNTGZMS00MZK4LWFIZJUTNJVMOTG0NJQXOTI3',
            ];
    $data = [
            'stream_code'   => 'iu244',
            'client'        => [
                'name'      => $name,
                'phone'     => $phone,
            ],
            'sub1'      => $test
        ];
        $data_json = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $http_code;
}