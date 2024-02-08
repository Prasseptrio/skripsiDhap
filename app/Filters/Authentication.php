<?php

namespace App\Filters;

use App\Models\Account\CustomerModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Authentication implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn') == TRUE) {

            if (!isset($_COOKIE['AX_karnivorTECHNOLOGY'])) {
                return redirect()->to(base_url('logout'));
            } else {
                try {
                    $jwt = $_COOKIE['AX_karnivorTECHNOLOGY'];
                    $decoded = JWT::decode($jwt, new Key(getenv('app.secretkey'), 'HS256'));
                    $customerModel = new CustomerModel();
                    $checkSession =   $customerModel->checkSession($decoded->jti, $decoded->email);
                    if (!$checkSession) {
                        return redirect()->to(base_url('logout'));
                    }
                    if (time() >= $decoded->exp) {
                        return redirect()->to(base_url('logout'));
                    }
                } catch (\Throwable $th) {
                    return redirect()->to(base_url('logout'));
                }
            }
        } else {
            return redirect()->to(base_url('login'));
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
