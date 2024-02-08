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
				if ($customer['is_active'] == 1) {
					JsonWebToken::customerSignatureEncode($customer);
					return $this->loadingPreview();
				} else {
					session()->setFlashdata('warning', '<b><i class="fas fa-exclamation-triangle"></i> Akun Belum diverifikasi!</b> <br>  Silahkan Cek Email Anda Untuk Verifikasi Akun.');
					return redirect()->to(base_url('login'));
				}
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Password yang Anda masukkan salah! ');
				return redirect()->to(base_url('login'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Email tidak ditemukan!  ');
			return redirect()->to(base_url('login'));
		}
	}
	public function loadingPreview()
	{
		$decode = JsonWebToken::signatureDecode();
		if (!$decode) {
			return view('account/login/loginLoading');
		} else {
			$agent = $this->request->getUserAgent();
			if ($agent->isBrowser()) {
				$currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
			} elseif ($agent->isRobot()) {
				$currentAgent = $agent->getRobot();
			} elseif ($agent->isMobile()) {
				$currentAgent = $agent->getMobile();
			} else {
				$currentAgent = 'Unidentified User Agent';
			}
			$this->customerModel->customerLogin(base64_decode($decode->CID), $agent->getPlatform(),  $currentAgent);
			$this->session->set([
				'CustName'	=> base64_decode($decode->CustName),
				'CID' 		=> base64_decode($decode->CID),
				'email' 	=> base64_decode($decode->email),
				'isLoggedIn' => TRUE
			]);
			$lastSales = $this->SalesModel->getLastSalesOrderByCustomerID(base64_decode($decode->CID));
			if ($lastSales) {
				return redirect()->to(base_url('agree?inv=' . base64_encode($lastSales['order_uuid'])));
			} else {
				return redirect()->to(base_url(''));
			}
		}
	}
	public function logout()
	{
		$ipAddress		= $this->request->getIPAddress();
		$this->customerModel->customerActivity(session()->get('CID'), 'logout',  session()->get('CustName'), $ipAddress);
		setcookie('KARNIVOR', 'LOGOUT');
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
	public function inputOTP()
	{
		$data = array_merge($this->data, [
			'title'         => 'Pengisian OTP Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
		]);
		return view('account/login/otp', $data);
	}

	public function checkOtp()
	{
		$dataOtp = $this->request->getPost(null);
		$dataOtp = $dataOtp[1] . $dataOtp[2] .  $dataOtp[3] .  $dataOtp[4] .  $dataOtp[5] .  $dataOtp[6];
		$customer = $this->customerModel->getCustomerByEmail(session()->get('email'));
		if ($dataOtp == base64_decode(session()->get('otp'))) {
			$this->email->setFrom(getenv('configEmail.setting'), getenv('configName.setting'));
			$this->email->setTo(session()->get('email'));
			$this->email->setSubject('Reset Password');
			$this->email->setMessage(view('email/successResetPassword', ['email' => session()->get('email'), 'fullname' => $customer['customer_fullname']]));
			if ($this->email->send()) {
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Kode Otp benar!</b> <br> Silahkan isikan password baru anda! ');
				return redirect()->to(base_url('recover'));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-check-circle"></i> Kode Otp yang anda masukan salah');
				return redirect()->to(base_url('otp'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-check-circle"></i> Kode Otp yang anda masukan salah</b> <br> ');
			return redirect()->to(base_url('otp'));
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
