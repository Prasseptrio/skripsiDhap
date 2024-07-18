<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;
use App\Libraries\JsonWebToken;

class Auth extends BaseController
{
	public function index()
	{
		setcookie("_karnivor", 'null');
		if (session()->get('isLoggedIn')) return redirect()->to(base_url());
		$data = array_merge($this->data, [
			'title'         => 'Masuk Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
		]);
		return view('account/login/login', $data);
	}

	public function login()
	{
		$email 			= strtolower($this->request->getPost('inputEmail', FILTER_SANITIZE_EMAIL));
		$customer 		= $this->customerModel->getCustomerByEmail($email);
		if ($customer) {
			$salt		= $customer['salt'];
			$password 	= sha1($salt . sha1($salt . sha1($this->request->getPost('inputPassword'))));
			if ($password == $customer['password']) {
				$this->session->set([
					'CustName'	=> $customer['customer_fullname'],
					'CID' 		=> $customer['customer_id'],
					'email' 	=> $customer['customer_email'],
					'isLoggedIn' => TRUE
				]);
				return redirect()->to(base_url(''));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Password yang Anda masukkan salah! ');
				return redirect()->to(base_url('login'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Email tidak ditemukan!  ');
			return redirect()->to(base_url('login'));
		}
	}

	public function logout()
	{
		$this->cart->destroy();
		$this->session->destroy();
		return redirect()->to(base_url('login'));
	}

	public function forgotPassword()
	{
		$data = array_merge($this->data, [
			'title'         => 'Lupa Password Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
		]);
		return view('account/login/forgotPassword', $data);
	}
	public function resetPassword()
	{
		if (!$this->validate([
			'inputEmail' => [
				'rules'     => 'required|valid_email',
				'errors'    => [
					'valid_email' 	=> 'Format email salah!',
				]
			]
		])) {
			return redirect()->to(base_url('forgotPassword'))->withInput();
		}
		$email 			= strtolower($this->request->getPost('inputEmail', FILTER_SANITIZE_EMAIL));
		$token 			= base64_encode(random_bytes(32));
		$customer 		= $this->customerModel->getForgot($email);

		if ($customer) {
			$otp = random_string('numeric', 6);
			$this->session->set(['otp' => base64_encode($otp), 'email' => $customer['customer_email'], 'token' => $token]);
			$this->customerModel->resetToken($email, $token);
			$this->email->setFrom(getenv('configEmail.setting'), getenv('configName.setting'));
			$this->email->setTo($email);
			$this->email->setSubject('Reset Password');
			$this->email->setMessage(view('email/requestOtp', ['otp' => $otp]));
			if ($this->email->send()) {
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Kode OTP Berhasil Dikirim!</b> <br> Silahkan Cek Email Untuk Reset Password. ');
				return redirect()->to(base_url('otp'));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-check-circle"></i> Registrasi Gagal! Pastikan alamat email valid ');
				return redirect()->to(base_url('login'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-check-circle"></i>Email tidak terdaftar atau belum diaktivasi</b> <br> ');
			return redirect()->to(base_url('forgotPassword'));
		}
	}

	public function recover()
	{
		$email = session()->get('email');
		$token = session()->get('token');
		$data = array_merge($this->data, [
			'title'         => 'Lupa Password Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
			'email'			=> $email,
			'token'			=> $token
		]);
		return view('account/login/resetPassword', $data);
	}

	public function changePasswordForgot()
	{
		if (!$this->validate([
			'inputPassword'     	=> 'required',
			'inputRetypePassword' 	=> 'required|matches[inputPassword]',
		])) {
			return redirect()->to(base_url('/register'))->withInput();
		}
		$token 			= session()->get('token');
		$ipAddress		= $this->request->getIPAddress();
		$changePassword 	= $this->customerModel->changePassword($this->request->getPost(), $token, $ipAddress);
		if ($changePassword) {
			$ipAddress		= $this->request->getIPAddress();
			$customer = $this->customerModel->getCustomerByEmail($this->request->getPost('inputEmail'));
			$this->customerModel->customerActivity($customer['customer_id'], 'change Password, forgoten',  $customer['customer_fullname'], $ipAddress);
			$this->session->destroy();
			session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Berhasil mengganti password!</b> <br> ');
			return redirect()->to(base_url('login'));
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Registrasi Gagal!  Pastikan alamat email valid. ');
			return redirect()->to(base_url('login'));
		}
	}
}
