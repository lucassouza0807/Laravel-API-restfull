<?php 

namespace App\Helpers;

header('Content-Type: text/html; charset=utf-8');

class JWTDecoder
{

    public static function handle($token, $secret = null) 
    {
        $splitted_token = explode(".", $token);

        $decoded_token = [
            "secret" => $splitted_token[0],
            "payload" => json_decode(base64_decode($splitted_token[1])),
            "headers" => json_decode(base64_decode($splitted_token[0]))
        ];

        return $decoded_token;

    }
}
