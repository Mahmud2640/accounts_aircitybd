<?php

//brilliant
function brilliantSMS($message, $number) {
    if (substr($number,0,2) !== '88') {
        $number = '88'.$number;
    }



    $url = "http://premium.mdlsms.com/smsapimany";
    $data = [
      "api_key" => "C2001138616d5d82b130c2.47279553",
      "senderid" => "8809612441948",
      "messages" => json_encode( [
        [
            "to" => $number,
            "message" => $message
        ]
      ])
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    
    curl_close($ch);
    return $response;
}



?>
