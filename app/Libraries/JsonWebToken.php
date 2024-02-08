<?php

namespace App\Libraries;

use App\Models\Account\CustomerModel;
use DateTimeImmutable;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JsonWebToken
{
    public static function customerSignatureEncode($customer)
    {
        $SECRET_KEY = getenv('app.secretkey');
        $sessionID  = password_hash($customer['customer_email'], PASSWORD_BCRYPT);
        $customerModel = new CustomerModel();
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+60 minutes')->getTimestamp();
        $payload = [
            "jti"           => $sessionID, // JWT ID
            "iat"           => time(), //Issued At
            'CustName'      => base64_encode($customer['customer_fullname']),
            'CID'           => base64_encode($customer['customer_id']),
            "email"         => base64_encode($customer['customer_email']),
            'isLoggedIn'    => TRUE,
            "exp"           => $expire
        ];
        $token = JWT::encode($payload, $SECRET_KEY, 'HS256');
        $customerModel->setSession($customer['customer_email'], $sessionID);
        $cookie = setcookie("KARNIVOR", $token);
        return $cookie;
    }
    public static function signatureDecode()
    {
        try {
            $jwt = $_COOKIE['KARNIVOR'];
            $decoded = JWT::decode($jwt, new Key(getenv('app.secretkey'), 'HS256'));
            return $decoded;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
